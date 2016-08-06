<?php
// displays syntax task
    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $_SESSION['user']->setCurrentTower(3);
    
    include_once 'db.php';
    $message = '';
    $border = '';
    
    // initialize counters when the task is started:
    if((!isset($_SESSION['syn_counter_all'])) || isset($_POST['reset_task'])) { // called only first time user accesses this page or when reset was pressed
    	$_SESSION['syn_counter_all'] = 10; 
    	$_SESSION['syn_threshold'] = 7;
    	$_SESSION['syn_correct_answers'] = 0;
    	$_SESSION['syn_counter_seen_items'] = 0;

        // get items for all three levels
        for ($i = 1; $i <= 3; $i++) {
            $items_query = 'SELECT * FROM syntax_phrases WHERE level = ' . $i;
            $items_result = $my_db_object->query($items_query);
            $items = [];
            if ($items_result !== false) {
                $items_num_rows = $items_result->num_rows;
                for ($j = 0; $j < $items_num_rows; $j++) {
                    $items[] = $items_result->fetch_array();
                } // for
            }
            $items_result->free();
            $_SESSION['syn_original_items_' . $i] = $items;
            $_SESSION['syn_items_' . $i] = [];
            // get the items the user has not seen yet for display
            foreach ($items as $my_item) {
                if (!(in_array($my_item['phrase_id'], $_SESSION['user']->getSeenItems('syn')))) { // user has not seen the item
                    $_SESSION['syn_items_' . $i][] = $my_item;
                }
            } // foreach
            $_SESSION['syn_seen_ids'] = []; // to keep track of what user has seen already during this run of the task
        } // for 
    	
    } // if
    
    /**************************************************************************************************************************************************************/

    // a solution has been submitted for evaluation
    if (isset($_POST['submit_syntax_form'])) { 
        if ($_POST['selected_tree'] != $_SESSION['correct']) {
            $message = '<p class="centered">Incorrect!</p>';
            $border = 'red_border ';
        }
        else {
            $_SESSION['syn_correct_answers']++;
            $message = '<p class="centered">Correct!</p>';
            $border = 'green_border ';
        }    
        $_SESSION['syn_counter_seen_items']++; //increase counter
    } // if submitted

    /**************************************************************************************************************************************************************/

    // a new item is to be displayed
    else {
        
        if ($_SESSION['syn_counter_seen_items'] == $_SESSION['syn_counter_all']) { // he has seen enough items
            unset($_SESSION['syn_counter_all']);
        	if($_SESSION['syn_correct_answers'] >= $_SESSION['syn_threshold']) { // he succeeded
        		$_SESSION['user']->setLinguisticPower('syn', true); // user gains the linguistic power
                header('Location: success.php'); // take user to success page
			} 
			else { //he failed
				header('Location: failure.php'); // take user to failure page
        	}
        	die;
        }
        
        // determine which level should be displayed
        if ($_SESSION['syn_counter_seen_items'] < 3) { // items 1 - 3 -> level 1
            $level = 1;
        }
        else if ($_SESSION['syn_counter_seen_items'] < 6) { //items 4 - 6 -> level 2
            $level = 2;
        }
        else { // items 7 - 10 -> level 3
            $level = 3;
        }

        // reset items, if necessary
        if(sizeof($_SESSION['syn_items_' . $level]) == 0) { // if he has seen everything -> start with all items again
            foreach ($_SESSION['syn_original_items_' . $level] as $temp_item) {
                $temp_ids[] = $temp_item['phrase_id']; // build array with all IDs of items of this level 
                if (!(in_array($temp_item['phrase_id'], $_SESSION['syn_seen_ids']))) { // user has not seen item during this run of the task
                    $_SESSION['syn_items_' . $level][] = $temp_item;
                } // if
            } // foreach
            $_SESSION['user']->resetSeenItems('syn', $temp_ids); // remove items of this level from the user object
            if (sizeof($_SESSION['syn_items_' . $level]) == 0) { // user has seen all items during this run
                $_SESSION['syn_items_' . $level] = $_SESSION['syn_original_items_' . $level]; // start with all items again
            }
        }
        
        // random selection of task
    	$counter = sizeof($_SESSION['syn_items_' . $level]);
    	$my_index = rand(0, $counter - 1); // get random integer between 0 and $counter - 1 (last remaining list index)
    	$random_item = array_splice($_SESSION['syn_items_' . $level], $my_index, 1)[0]; // remove item from items list, store it in variable
        
        $_SESSION['help_id'] = $random_item['h_id'];
        
        // get task from DB
        $task_id = $random_item['phrase_id'];
        $_SESSION['user']->setSeenItem('syn', $task_id); // remember item as seen
        $_SESSION['syn_seen_ids'][] = $task_id;
        $phrase = $random_item['phrase'];
        
        // get incorrect answer options from DB
        $incorrect_trees_query =   "SELECT si.tree_id, st.path " .
                         		   "FROM syntax_incorrect AS si, syntax_trees AS st " .
                         		   "WHERE si.phrase_id = " . $task_id . " AND si.tree_id = st.tree_id";
        $incorrect_trees_result = $my_db_object->query($incorrect_trees_query);
        $trees = []; // store all trees that are to be displayed as answer options
        if ($incorrect_trees_result !== false) {
            $incorrect_trees_num_rows = $incorrect_trees_result->num_rows;
            for ($i = 0; $i < $incorrect_trees_num_rows; $i++) {
                $data = $incorrect_trees_result->fetch_array();
                $trees[$i]['tree_id'] = intval($data['tree_id']); // store as number
                $trees[$i]['path'] = $data['path'];        
            } // for
        } // if query successful
        $incorrect_trees_result->free();
    	
    	// get correct answer from DB
    	$correct_tree_query =   "SELECT path " .
                         		"FROM syntax_trees " .
                         		"WHERE tree_id = " . $random_item['correct_id'];
        $correct_tree_result = $my_db_object->query($correct_tree_query);
        if ($correct_tree_result !== false) {
            $correct_tree_num_rows = $correct_tree_result->num_rows;
            if ($correct_tree_num_rows > 0) {
                $data = $correct_tree_result->fetch_array();
                $trees[$i]['tree_id'] = $random_item['correct_id'];
                $trees[$i]['path'] = $data['path']; 
                $_SESSION['correct'] = 	$data['path']; // store for checking later    
            } // if
        } // if query successful
        $correct_tree_result->free();

    	// shuffle the answer options for display:
    	shuffle($trees);
    	$_SESSION['trees'] = ($trees); // store in session, so that can be displayed in same order after submission

    	$message = '<p>Click on the correct syntax tree for:</p><p class="centered">"' . $phrase . '"</p>';
       
    } // else show new item 

	$my_db_object->close();

    // set the variable which determines whether back-to-main-map button is shown
    if ($_SESSION['syn_counter_seen_items'] > 4) {
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
        <title>Syntax Task</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
    			$(document).on('click', '.tree_picture', function() {
					// remove existing selection borders
					$(".tree_picture").each(function() {
						$(this).removeClass('selection_border');
						$(this).addClass('invisible_border');
					});
					// add selection border to clicked picture
					$(this).removeClass('invisible_border');
					$(this).addClass('selection_border');
					// store the path of the selected image as value for submission
					$('#selected_tree').val($(this).attr('src'));
				});
    			$(document).on('click', '#submit_syntax_form', function(e) {
					// prevent submission if no tree has been selected
					if ($('#selected_tree').val() == '') {
						e.preventDefault();
						alert('Please select a tree!');
					}
				});

/*<?php
				if (isset($_POST['selected_tree'])) {
?>*/
				$(".tree_picture").each(function() {
					$(this).removeClass('tree_picture');
					$(this).addClass('unselectable_tree_picture');
					if ($(this).attr('src') == '<?php echo $_POST['selected_tree']; ?>') {
						$(this).removeClass('invisible_border');
						$(this).addClass('<?php echo $border; ?>');
					}
				});
/*<?php
				}
?>*/
                $('#reset_task_button').click(function(e) {
                    if (!confirm("Starting the task again will reset your score. Your correct solutions so far will be lost. Are you sure you want to start the task again?")) {
                        e.preventDefault();
                    }
                });
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
            	<?php echo $message; ?>
		        <div id="trees_container">
<?php 
				for ($i = 0; $i < sizeof($_SESSION['trees']); $i++) { // display tree pictures
?>
					<img class="tree_picture invisible_border" src="<?php echo $_SESSION['trees'][$i]['path']; ?>" width="220px" height="300px"/>
<?php
				}
?>
				</div>
<?php 
				if (isset($_POST['selected_tree'])) { // if a tree was selected, the continue part is shown
?>
					<form id="continue_form" name="continue_form" method="post" action="syntax_task.php">
	                	<p class="right_aligned">
<?php
                    if ($_SESSION['syn_counter_seen_items'] < 5) { // allow reset for first four items
?>
                            <input type="submit" id="reset_task_button" name="reset_task" value="Start Task Again" />
<?php
                    }
?>
							<input type="submit" id="continue_button" name="continue" value="Continue" />
						</p>
					</form>
<?php
				} //if
				else { // else display items for user to select
?>
					<form id="syntax_form" name="syntax_form" method="post" action="syntax_task.php">
						<div class="right_aligned">
							<input type="hidden" id="selected_tree" name="selected_tree" val="" />
	                        <input type="submit" id="submit_syntax_form" name="submit_syntax_form" value="Ready" />
	                    </div>
					</form>
<?php
				} //else
?>
			<p class="centered">
                <em>Correct Answers: <?php echo $_SESSION['syn_correct_answers'] ; ?><br>
                <?php echo $_SESSION['syn_counter_seen_items'] ; ?> out of <?php echo $_SESSION['syn_counter_all'] ; ?> questions answered<br>
<?php 
                if ($_SESSION['syn_correct_answers'] >= $_SESSION['syn_threshold']) { // enough correct answers to pass
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
                <?php echo $_SESSION['syn_threshold'] ; ?> correct answers required </em>
            </p>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>
<?php
    unset($_POST);
?>
