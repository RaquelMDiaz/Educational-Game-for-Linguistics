<?php
// displays morphology task
    include_once 'user_class.php';
	include_once 'session_check.php';
	
	$_SESSION['user']->setCurrentTower(2);
    
    include_once 'db.php';
    $message = '';
    $errors = false;
    
    if((!isset($_SESSION['morph_counter_all'])) || isset($_POST['reset_task'])) { //called only first time user accesses this page
    	$_SESSION['morph_counter_all'] = 10;
    	$_SESSION['morph_threshold'] = 7;
    	$_SESSION['morph_correct_answers'] = 0;
    	$_SESSION['morph_counter_seen_items'] = 0;
		
		//get words from all levels
		for ($i = 1; $i <= 3; $i++) {
			$items_query = 'SELECT word, word_id, h_id, m_requested_id FROM morph_words_table WHERE level_id = ' . $i;
			$items_result = $my_db_object->query($items_query);
			$items = [];
			if ($items_result !== false) {
				$items_num_rows = $items_result->num_rows;
				for ($j = 0; $j < $items_num_rows; $j++) {
					$items[] = $items_result->fetch_array();
				}
			}
			$items_result->free();
			$_SESSION['morph_original_items_' . $i] = $items;
			
			$_SESSION['morph_items_' . $i] = [];
            //get the items the user has not seen yet for display:
            foreach ($items as $my_item) {
                if (!(in_array($my_item['word_id'], $_SESSION['user']->getSeenItems('morph')))) { // user has not seen the item
                    $_SESSION['morph_items_' . $i][] = $my_item;
                }
            } // foreach
            $_SESSION['morph_seen_ids'] = []; // to keep track of what user has seen already during this run of the task
		} // for
    }
	
	/**************************************************************************************************************************************************************/

    if (isset($_POST['submit_morph'])) {
        //submission
        if ($_SESSION['morph_counter_seen_items'] < 6) { //evaluation for first 2 levels
			if ($_SESSION['correct_item'] !== $_POST['selected_morpheme']) {
				$feedback = '<p class="centered">Incorrect!</p>';
				$border = 'red_border';
			} else {
				$feedback = '<p class="centered">Correct!</p>';
				$border = 'green_border';
				$_SESSION['morph_correct_answers']++;
			}
			$_SESSION['morph_counter_seen_items']++;
		} else { // evaluation for third level
			$submitted_solution = [];
			$i = 1;
			$solution = str_split($_SESSION['correct_item']);
			while (isset($_POST['path' . $i])) { // loop through posted values
				$submitted_solution[$i -1] = $_POST['path' . $i]; // store the path of each letter the user has selected to display his solution after submission
				if (isset($solution[$i - 1]) && ($solution[$i - 1] != $submitted_solution[$i -1])) {
					$errors = true;
				}
				$i++;
			}
			if (sizeof($submitted_solution) !== sizeof($_SESSION['correct_item'])) {
				$errors = true;
			}
			
			// for displaying the feedback to user
			$_POST['selected_morpheme'] = implode($submitted_solution);
			
			$_SESSION['morph_counter_seen_items']++;
			if ($errors == true) {
				$feedback = '<p class="centered">Incorrect!</p>';
				$border = 'red_border';
			} else {
				$feedback = '<p class="centered">Correct!</p>';
				$border = 'green_border';
				$_SESSION['morph_correct_answers']++;
			}
		}
		
	/**************************************************************************************************************************************************************/
	
    } else {
		// display new item - three levels - success - failure
	
		if($_SESSION['morph_counter_seen_items'] == $_SESSION['morph_counter_all']) {
			unset($_SESSION['syn_counter_all']);
			if($_SESSION['morph_correct_answers'] >= $_SESSION['morph_threshold']) { //he succeeded
				$_SESSION['user']->setLinguisticPower('morph', true); //user gains the linguistic power
				header('Location: success.php'); //take user to success page
			} else { //he failed
				header('Location: failure.php'); //take user to failure page
			}
			die;
		}
	
		// determine which level should be displayed
        if ($_SESSION['morph_counter_seen_items'] < 3) { // items 1 - 3 -> level 1
            $level = 1;
        }
        else if ($_SESSION['morph_counter_seen_items'] < 6) { //items 4 - 6 -> level 2
            $level = 2;
        }
        else { // items 7 - 10 -> level 3
            $level = 3;
        }
		
		// reset items, if necessary:
        if(sizeof($_SESSION['morph_items_' . $level]) == 0) { //if he has seen everything -> start with all items again
            foreach ($_SESSION['morph_original_items_' . $level] as $temp_item) {
                $temp_ids[] = $temp_item['word_id']; // build array with all IDs of items of this level 
                if (!(in_array($temp_item['word_id'], $_SESSION['morph_seen_ids']))) { // user has not seen item during this run of the task
                    $_SESSION['morph_items_' . $level][] = $temp_item;
                } // if
            } // foreach
            $_SESSION['user']->resetSeenItems('morph', $temp_ids); //remove items of this level from the user object
            if (sizeof($_SESSION['morph_items_' . $level]) == 0) { // user has seen all items during this run
                $_SESSION['morph_items_' . $level] = $_SESSION['morph_original_items_' . $level]; // start with all items again
            }
        } 
        
		// random selection of word
		shuffle($_SESSION['morph_items_' . $level]);
		$random_word = array_pop($_SESSION['morph_items_' . $level]);
		$_SESSION['random_word'] = $random_word;
		$_SESSION['help_id'] = $random_word['h_id'];
		$_SESSION['m_requested_id'] = $random_word['m_requested_id'];
		$_SESSION['word_id'] = $random_word['word_id'];
		
		$_SESSION['user']->setSeenItem('morph', $random_word['word_id']); // remember item as seen
    	$_SESSION['morph_seen_ids'][] = $random_word['word_id'];
		
		// retrieve morphemes from word
		$morphemes_query = "SELECT morphemes_table.morpheme FROM morphemes_table, words_morphemes_lookup WHERE words_morphemes_lookup.w_id = " . $_SESSION['word_id'] . " AND morphemes_table.morpheme_id = words_morphemes_lookup.m_id";
		$morphemes_result = $my_db_object->query($morphemes_query);
		$morphemes = [];
		if ($morphemes_result !== false) {
			$morphemes_num_rows = $morphemes_result->num_rows;
			for ($i = 0; $i < $morphemes_num_rows; $i++) {
				$morphemes[] = $morphemes_result->fetch_array();
			}
		}
		$morphemes_result->free();
		$_SESSION['morphemes'] = $morphemes;
			
		// retrieve type requested morpheme (for display)
		$m_requested_query = 'SELECT morpheme_type_table.type, morph_words_table.word_id FROM morpheme_type_table, morph_words_table WHERE morpheme_type_table.type_id = ' . $_SESSION['m_requested_id'] . ' AND morph_words_table.word_id = ' . $_SESSION['word_id'];
		$m_requested_result = $my_db_object->query($m_requested_query);
		$m_requested = [];
		if ($m_requested_result !== false) {
			$m_requested_num_rows = $m_requested_result->num_rows;
			for ($i = 0; $i < $m_requested_num_rows; $i++) {
				$m_requested[] = $m_requested_result->fetch_array();
			}   
		}
		$m_requested_result->free();
		$_SESSION['m_requested'] = $m_requested;
			
		// retrieve correct morpheme (for evaluation)
		$correct_morpheme_query = 'SELECT morphemes_table.morpheme FROM morphemes_table, words_morphemes_lookup WHERE morphemes_table.t_id = ' 
								  . $_SESSION['m_requested_id'] . ' AND words_morphemes_lookup.w_id = ' . $_SESSION['word_id'] . 
								  ' AND words_morphemes_lookup.m_id = morphemes_table.morpheme_id';
		$correct_morpheme_result = $my_db_object->query($correct_morpheme_query);
		if ($correct_morpheme_result !== false) {
			$correct_morpheme_num_rows = $correct_morpheme_result->num_rows;
			if ($correct_morpheme_num_rows > 0) {
				$correct_item = $correct_morpheme_result->fetch_array()['morpheme'];
			}
				
			$_SESSION['correct_item'] = $correct_item;
		}
		$correct_morpheme_result->free();
			
		$message = 'Identify the following type of morpheme in the target word by clicking on it below: <strong>' . $m_requested[0]['type'] . '</strong>';
		
    }
    $my_db_object->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Morphology Tower</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script>
            $(document).ready(function () {
				var position = 1; // counter for letters that have been selected
                
				$(document).on('click', '.morpheme', function(e) {
                   e.preventDefault;
                    $('#morph_displayed').append($(this));
					// add selection border to clicked button
					$(this).removeClass('morpheme');
					$(this).addClass('unselectable_morpheme');
					var new_value = $('#morph_task > #selected_morpheme').val() + $(this).attr('data');
					$('#morph_task > #selected_morpheme').val(new_value);
                });

                $(document).on('click', '.letter', function(e) {
					e.preventDefault(); // append hidden input per letter selected
					$('#morph_task_level3').append('<input type="hidden" class="hidden_morph_path" name="path' + position + '" value="' + $(this).attr('data') + '" />');
					position++;
					$('#morph_displayed').append($(this));
					$(this).removeClass('letter');
					$(this).addClass('unselectable_letter');
				});
				
				$('#reset_task_button').click(function(e) {
					if (!confirm("Starting the task again will reset your score. Your correct solutions so far will be lost. Are you sure you want to start the task again?")) {
						e.preventDefault();
					}
                });
				
				$('#undo_selection').click(function(e) {
					e.preventDefault();
					// first two levels:
					$('#morph_displayed > .unselectable_morpheme').removeClass('unselectable_morpheme').addClass('morpheme')
					$('#morph_displayed > .morpheme').appendTo('#morpheme_container');
					$('#morph_task > #selected_morpheme').val('');

					// third level:
					$('#morph_task_level3 > .hidden_morph_path:last').remove(); // romve hidden input field from submission form
					$('#morph_displayed > .unselectable_letter:last').addClass('letter').removeClass('unselectable_letter');
					$('#morph_displayed > .letter:last').appendTo('#morpheme_container');
					if (position > 0) {
						position--;
					}
				});
				
				$(document).on('click', '#submit_morph', function(e) {
/*<?php
				if ($_SESSION['morph_counter_seen_items'] < 6) {
?>*/			
					if ($('#selected_morpheme').val() == '') {
						e.preventDefault();
						alert('Please select at least one morpheme!');
					}
/*<?php
				}
?>*/
				});
            });
        </script>
    </head>
    <body>
		<div id="frame">
			<div class="allcontent">
<?php 
				if (isset($feedback)) {
					echo $feedback;
				}
?>
				<div> <?php echo $message; ?> </div>
				<p class="centered">Target Word: "<?php echo $_SESSION['random_word']['word']; ?>"</p>

<?php			
		if (isset($_POST['selected_morpheme'])) { // feedback for submitted morpheme is shown
?>
				<div id="morph_displayed"><button type="button" id="submitted_morpheme" class="<?php echo $border; ?>"><strong><?php echo $_POST['selected_morpheme']; ?></strong></button></div>
				<form id="continue_form" name="continue_form" method="post" action="morphology_task.php">
					<p class="right_aligned">
<?php
        if ($_SESSION['morph_counter_seen_items'] < 5) { // allow reset for first four items
?>
						<input type="submit" id="reset_task_button" name="reset_task" value="Start Task Again" />
<?php
        }
?>
						<input type="submit" id="continue_button" name="continue" value="Continue" />
					</p>
				</form>
<?php
		} else { 
?>	
				<div id="morph_displayed"></div>
				<div class="right_aligned"><button id="undo_selection">Undo selection</button></div>
<?php
		}
?>
<?php
		if (!(isset($_POST['selected_morpheme'])) && ($_SESSION['morph_counter_seen_items'] < 6)) { // level 1 & 2
?>
					<div id="morpheme_container">
<?php

                    foreach ($_SESSION['morphemes'] as $value) {
?>
    		            <button type="button" class="morpheme" name="morpheme" data="<?php echo $value['morpheme']; ?>"><strong> <?php echo $value['morpheme']; ?> </strong></button>
<?php
                    }
?>
					</div>
					<form id="morph_task" name="morph_task" method="post" action="morphology_task.php">
						<input type="hidden" id="selected_morpheme" name="selected_morpheme" value="" />
						
						<div class="right_aligned">
							<input type="submit" id="submit_morph" name="submit_morph" value="Ready" />
						</div>
					</form>
<?php

		} else if (!(isset($_POST['selected_morpheme']))) { // level 3
?>
				<div id="morpheme_container">
<?php
                    $letters = str_split($_SESSION['random_word']['word']);
					for ($i = 0; $i < sizeof($letters); $i++) {
?>
						<button type="button" class="letter invisible_border" name="letter" data="<?php echo $letters[$i]; ?>"><strong> <?php echo $letters[$i]; ?> </strong></button>
<?php
					}
?>
					</tr>
				</div>
				<form id="morph_task_level3" name="morph_task_level3" method="post" action="morphology_task.php">
					<div class="right_aligned">
						<input type="submit" id="submit_morph" name="submit_morph" value="Ready" />
					</div>
				</form>
<?php
		}
?>
				<p class="centered">
                <em>Correct Answers: <?php echo $_SESSION['morph_correct_answers'] ; ?><br>
                <?php echo $_SESSION['morph_counter_seen_items'] ; ?> out of <?php echo $_SESSION['morph_counter_all'] ; ?> questions answered<br>
<?php 
                if ($_SESSION['morph_correct_answers'] >= $_SESSION['morph_threshold']) { // enough correct answers to pass
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
                <?php echo $_SESSION['morph_threshold'] ; ?> correct answers required </em>
            </p>
			</div>
		<?php include 'page_elements/bottom_pane.php'; ?>
		</div>
    </body>
</html>
<?php
    unset($_POST);
?>