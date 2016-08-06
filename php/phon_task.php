<?php
// displays phonology task
    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $_SESSION['user']->setCurrentTower(1);
    
    include_once 'db.php';
    
    // initialize counters when the task is started
    if((!isset($_SESSION['counter_all'])) || isset($_POST['reset_task'])) { // called only first time user accesses this page or via reset
    	$_SESSION['counter_all'] = 10; 
    	$_SESSION['threshold'] = 7;
    	$_SESSION['correct_answers'] = 0;
    	$_SESSION['counter_seen_items'] = 0;
    	$items_query = 'SELECT * FROM phon_words WHERE challenge_id = 0'; // get only the words that do not belong to the final challenge
	    $items_result = $my_db_object->query($items_query);
	    $items = [];
	    if ($items_result !== false) {
	    	$items_num_rows = $items_result->num_rows;
	        for ($i = 0; $i < $items_num_rows; $i++) {
	        	$items[] = $items_result->fetch_array();
	        } // for
	    }
    	$items_result->free();
    	$_SESSION['original_items'] = $items;
        $_SESSION['items'] = [];
        // get the items the user has not seen yet for display
        foreach ($items as $my_item) {
            if (!(in_array($my_item['word_id'], $_SESSION['user']->getSeenItems('phon')))) { // user has not seen the item
                $_SESSION['items'][] = $my_item;
            }
        } // foreach
        $_SESSION['seen_ids'] = []; // to keep track of what user has seen already during this run of the task

    	// get all IPA symbols from database (for randomly display of extra symbols)
        $symbols_query = 'SELECT * FROM phon_word_transcription';
        $symbols_result = $my_db_object->query($symbols_query);
        $_SESSION['all_symbols'] = [];
        if ($symbols_result !== false) {
            $_SESSION['nr_symbols'] = $symbols_result->num_rows;
            for ($i = 0; $i < $_SESSION['nr_symbols']; $i++) {
                $_SESSION['all_symbols'][] = $symbols_result->fetch_array();
            } // for
        }
    }
    
    /**************************************************************************************************************************************************************/

    // a transcription has been submitted for evaluation
    if (isset($_POST['submit_transcription_form'])) { 
        $i = 1;
        $mistake = false;
        $submitted_solution = []; // record the solution submitted by the user, so that it can be displayed after submission
        $submitted_solution_frames = []; // to mark correct/incorrect symbols with the correct colors (stores name of class)
        while (isset($_POST[$i])) { // loop through posted values
            $submitted_solution[$i] = $_POST['path' . $i]; // store the path of each symbol the user has selected to display his solution after submission
            if (isset($_SESSION['solution_ids'][$i]) && ($_POST[$i] != $_SESSION['solution_ids'][$i])) { // not the correct symbol in the correct position
                $mistake = true;
                $submitted_solution_frames[$i] = 'red_border';
            }
            else if (!isset($_SESSION['solution_ids'][$i])) { // account for user providing a solution longer than the correct solution
                $mistake = true;
                $submitted_solution_frames[$i] = 'red_border';
            }
            else {
                $submitted_solution_frames[$i] = 'green_border';
            }
            $i++;
        } // while isset POST
        if (sizeof($submitted_solution) !== sizeof($_SESSION['solution_ids'])) {
            $mistake = true;
        }

        if ($mistake) {
            $message = 'Incorrect!';
        }
        else {
            $_SESSION['correct_answers']++;
            $message = 'Correct!';
        }    
        $_SESSION['counter_seen_items']++; // increase counter
    } // if transcription submitted

    /**************************************************************************************************************************************************************/

    // a new item is to be displayed
    else {
        
        if($_SESSION['counter_seen_items'] == $_SESSION['counter_all']) { // user has seen enough items
            unset($_SESSION['counter_all']);
        	if($_SESSION['correct_answers'] >= $_SESSION['threshold']) { // user succeeded
        		$_SESSION['user']->setLinguisticPower('phon', true); // user gains the linguistic power
                header('Location: success.php'); // take user to success page
			} 
			else { // user failed
				header('Location: failure.php'); // take user to failure page
        	}
        	die;
        }
        
        // radom selection of task
        if(sizeof($_SESSION['items']) == 0) { // if he has seen everything -> start with all items again
            foreach ($_SESSION['original_items'] as $temp_item) {
                if (!(in_array($temp_item['word_id'], $_SESSION['seen_ids']))) { // user has not seen item during this run of the task
                    $_SESSION['items'][] = $temp_item;
                } // if
            } // foreach
            $_SESSION['user']->resetSeenItems('phon'); // take everything as 'unseen' again
            if (sizeof($_SESSION['items']) == 0) { // user has seen all items during this run
                $_SESSION['items'] = $_SESSION['original_items']; // start with all items again
            }
        }
        
    	$counter = sizeof($_SESSION['items']);
    	$my_index = rand(0, $counter - 1); // get random integer between 0 and $counter - 1 (last remaining list index)
    	$random_item = array_splice($_SESSION['items'], $my_index, 1)[0]; // remove answer from items list, store it in variable
        
        $_SESSION['help_id'] = $random_item['h_id'];
        
        //get task from DB
        $task_id = $random_item['word_id'];
        $_SESSION['user']->setSeenItem('phon', $task_id); // remember item as seen
        $_SESSION['seen_ids'][] = $task_id;
        $word = $random_item['word'];
        
        $solution_query =   "SELECT pa.position, pa.tr_id, pt.img_path " .
                            "FROM phon_answers AS pa, phon_word_transcription AS pt " .
                            "WHERE pa.wd_id = " . $task_id . " AND pa.tr_id = pt.trans_id";
        $solution_result = $my_db_object->query($solution_query);
        $solution = []; // store all ipa symbols of the solution
    	$solution_ids = []; // store order of IDs of correct transcription of the target word
        if ($solution_result !== false) {
            $solution_num_rows = $solution_result->num_rows;
            for ($i = 0; $i < $solution_num_rows; $i++) {
                $solution_data = $solution_result->fetch_array();
                $solution[$i]['position'] = intval($solution_data['position']); // store as number
                $solution[$i]['tr_id'] = intval($solution_data['tr_id']); // store as number
                $solution[$i]['img_path'] = $solution_data['img_path'];
    			$solution_ids[$solution[$i]['position']] = $solution[$i]['tr_id'];        
            } // for solution_result
        } // if query successful
    	
    	$_SESSION['solution_ids'] = $solution_ids;
        $j = sizeof($solution);
        while (sizeof($solution) < (13 + $_SESSION['counter_seen_items'])) { // fill with random IPA symbols that will be displayed along with the solution symbols, one more per turn
            $index_symbol = rand(0, $_SESSION['nr_symbols'] - 1); // get a random index of an IPA symbol
            $solution[$j]['position'] = 0;
            $solution[$j]['tr_id'] = intval($_SESSION['all_symbols'][$index_symbol]['trans_id']); // store as number
            $solution[$j]['img_path'] = $_SESSION['all_symbols'][$index_symbol]['img_path'];
            $j++;
        } // while
    	
    	// shuffle the ipa symbols for display
    	$symbols_random = array();
    	$counter = sizeof($solution);
    	for ($i = $counter; $i > 0; $i--){
    		$my_index = rand(0, $i - 1); // get random integer between 0 and $i - 1 (last remaining list index)
    		$symbols_random[] = array_splice($solution, $my_index, 1)[0]; // remove answer from options list, add it to random_list
    	}
    	
        $solution_result->free();
    } // else show new item 

	$my_db_object->close();

    // set the variable which determines whether back-to-main-map button is shown
    if ($_SESSION['counter_seen_items'] > 4) {
        $back_to_map = false;
    }
    else {
        $confirm_back_to_map = true;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Phonetics Task</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				var position = 1; // counter for symbols that have been added to transcription
                
				$(document).on('click', '.ipa_symbol', function() { // add hidden input per added symbol
					$('#transcription_form').append('<input type="hidden" class="hidden_input_id" name="' + position + '" value="' + $(this).data('tr_id') + '" />');
                    $('#transcription_form').append('<input type="hidden" class="hidden_input_path" name="path' + position + '" value="' + $(this).attr('src') + '" />');
					position++;
                    $(this).removeClass('ipa_symbol').addClass('selected_ipa_symbol'); // change class -> symbol should not be clickable any more once it is part of the transcription
					$('#transcription_container').append($(this)); // move picture to transcription container
				});
				
				$('#delete_button').click(function(e) {
					e.preventDefault();
					$('#transcription_form > .hidden_input_path:last').remove(); // remove the hidden form fields corresponding to the last selected symbol
                    $('#transcription_form > .hidden_input_id:last').remove();
                    $('#transcription_container > .selected_ipa_symbol:last').addClass('ipa_symbol').removeClass('selected_ipa_symbol'); // change class back -> symbol should be clickable again
					$('#ipa_container').append($('#transcription_container > .ipa_symbol:last'));
					if (position > 0) {
						position--;
					}
				});

                $('#reset_task_button').click(function(e) {
                    if (!confirm("Starting the task again will reset your score. Your correct solutions so far will be lost. Are you sure you want to start the task again?")) {
                        e.preventDefault();
                    }
                });
                
                $('#submit_transcription_form').click(function(e) {
                    if ($('#transcription_form > .hidden_input_id').length == 0) { // prevent submission, if no symbols have been selected
                        e.preventDefault();
                        alert("Please select some IPA symbols before clicking 'Ready'!");
                    }
                });

            }); // document ready function
		
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
<?php
            if (isset($_POST['submit_transcription_form'])) { //display content for evaluation
?>
                <p class="centered"><?php echo $message; ?></p>
                <div id="transcription_container">
<?php
                for ($i = 1; $i <= sizeof($submitted_solution); $i++) {
?>
                    <img class="selected_ipa_symbol <?php echo $submitted_solution_frames[$i]; ?>" src="<?php echo $submitted_solution[$i]; ?>" width="43px" height="38px">
<?php
                } // for
                if (sizeof($submitted_solution) < sizeof($_SESSION['solution_ids'])) { //if submitted solution was shorter than correct solution -> print empty boxes marking missing symbols
                    for ($j = 0; $j < (sizeof($_SESSION['solution_ids']) - sizeof($submitted_solution)); $j++) {
?>
                        <img class="selected_ipa_symbol red_border" src="../ipa_images/empty.png" width="43px" height="38px">
<?php
                    }
                }
?>
                </div>
                <form id="continue_form" name="continue_form" method="post" action="phon_task.php">
                    <p class="right_aligned">
<?php
                    if ($_SESSION['counter_seen_items'] < 5) { // allow reset for first four items
?>
                            <input type="submit" id="reset_task_button" name="reset_task" value="Start Task Again" />
<?php
                    }
?>
                        <input type="submit" id="continue_button" name="continue" value="Continue" />
                    </p>
                </form>
<?php
            } // if isset $_POST (display evaluation)
            else { // display content for new item
?>
				<p>Click on the IPA symbols below in the right order to provide the correct transcription for the target word.<br>
				Note: There may be symbols that you do not need for your transcription!</p>
				<p class="centered">Target Word: "<?php echo $word; ?>"</p>
				<div id="transcription_container"></div>
				<div class="right_aligned"><button id="delete_button">Delete last symbol</button></div>
				<div id="ipa_container">
<?php
                for ($i = 0; $i < sizeof($symbols_random); $i++) {
?>
					<img class="ipa_symbol" src="<?php echo $symbols_random[$i]['img_path']; ?>" data-tr_id="<?php echo $symbols_random[$i]['tr_id']; ?>" width="43px" height="38px">
<?php
                } // for
?>
				</div>
				<form id="transcription_form" name="transcription_form" method="post" action="phon_task.php">
					<div class="right_aligned">
                        <input type="submit" id="submit_transcription_form" name="submit_transcription_form" value="Ready" />
                    </div>
				</form>
<?php
            } // else (display new item)
?>
            <p class="centered">
                <em>Correct Answers: <?php echo $_SESSION['correct_answers'] ; ?><br>
                <?php echo $_SESSION['counter_seen_items'] ; ?> out of <?php echo $_SESSION['counter_all'] ; ?> questions answered<br>
<?php 
                if ($_SESSION['correct_answers'] >= $_SESSION['threshold']) { // enough correct answers to pass
?>
                    <img src="../images/yes_sign.png" width="15px" height="15px" />
<?php
                }
                else {
?>
                    <img src="../images/no_sign.png" width="15px" height="15px" />
<?php
                }
?>
                <?php echo $_SESSION['threshold'] ; ?> correct answers required </em>
            </p>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>
<?php
    unset($_POST);
?>
