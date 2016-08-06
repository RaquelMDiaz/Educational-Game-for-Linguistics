<?php
// displays the final challenge (including a phonetics, a morphology & a syntax part) to the user

	include_once 'user_class.php';
	include_once 'session_check.php';
    include_once 'db.php';
    $message = '';
    $border = '';
    $errors = false;
	
	if (!isset($_SESSION['challenge_counter_all'])) { // run when user first accesses page
    	$_SESSION['challenge_counter_all'] = 18;
    	$_SESSION['challenge_correct_answers'] = 0;
    	$_SESSION['challenge_counter_seen_items'] = 0;
		$_SESSION['challenge_correct_phon_answers'] = 0;
		$_SESSION['challenge_correct_morph_answers'] = 0;
		$_SESSION['challenge_correct_syn_answers'] = 0;

		//PHON
		//get challenge words
		$items_query = 'SELECT * FROM phon_words WHERE challenge_id > 0';
		$items_result = $my_db_object->query($items_query);
		$items = [];
		if ($items_result !== false) {
			$items_num_rows = $items_result->num_rows;
			for ($i = 0; $i < $items_num_rows; $i++) {
				$items[] = $items_result->fetch_array();
			} // for
		}
		$items_result->free();
		$_SESSION['challenge_original_phon_items'] = $items;
		$_SESSION['challenge_phon_items'] = $items;
		
		//get all IPA symbols from database (for randomly displaying distractor symbols)
		$symbols_query = 'SELECT * FROM phon_word_transcription';
		$symbols_result = $my_db_object->query($symbols_query);
		$_SESSION['challenge_all_symbols'] = [];
		if ($symbols_result !== false) {
			$_SESSION['challenge_nr_symbols'] = $symbols_result->num_rows;
			for ($i = 0; $i < $_SESSION['challenge_nr_symbols']; $i++) {
				$_SESSION['challenge_all_symbols'][] = $symbols_result->fetch_array();
			} // for
		}

		//MORPH
		//get challenge words
		$items_query = 'SELECT word, word_id, h_id, m_requested_id FROM morph_words_table WHERE level_id = 4';
		$items_result = $my_db_object->query($items_query);
		$items = [];
		if ($items_result !== false) {
			$items_num_rows = $items_result->num_rows;
			for ($j = 0; $j < $items_num_rows; $j++) {
				$items[] = $items_result->fetch_array();
			}
		}
		$items_result->free();
		$_SESSION['challenge_morph_original_items'] = $items;
		$_SESSION['challenge_morph_items'] = $items;

		//SYN
		//get challenge trees
		$items_query = 'SELECT * FROM syntax_phrases WHERE level = 4';
		$items_result = $my_db_object->query($items_query);
		$items = [];
		if ($items_result !== false) {
			$items_num_rows = $items_result->num_rows;
			for ($j = 0; $j < $items_num_rows; $j++) {
				$items[] = $items_result->fetch_array();
			} //for
		}
		$items_result->free();
		$_SESSION['challenge_syn_original_items'] = $items;
		$_SESSION['challenge_syn_items'] = $items;

	}
	
	/**************************************************************************************************************************************************************/

	if (isset($_POST['submit_challenge_form'])) {
		if ($_SESSION['challenge_counter_seen_items'] < 6) { //evaluation for phon. task
			$i = 1;
			$mistake = false;
			$submitted_solution = []; //record the solution submitted by the user, so that it can be displayed after submission
			$submitted_solution_frames = []; //to mark correct/incorrect symbols with the correct colors (stores name of class)
			while (isset($_POST[$i])) { // loop through posted values
				$submitted_solution[$i] = $_POST['path' . $i]; //store the path of each symbol the user has selected to display his solution after submission
				if (isset($_SESSION['challenge_phon_solution_ids'][$i]) && ($_POST[$i] != $_SESSION['challenge_phon_solution_ids'][$i])) { // not the correct symbol in the correct position
					$mistake = true;
					$submitted_solution_frames[$i] = 'red_border';
				}
				else if (!isset($_SESSION['challenge_phon_solution_ids'][$i])) { // account for user providing a solution longer than the correct solution
					$mistake = true;
					$submitted_solution_frames[$i] = 'red_border';
				}
				else {
					$submitted_solution_frames[$i] = 'green_border';
				}
				$i++;
			} // while isset POST
			if (sizeof($submitted_solution) !== sizeof($_SESSION['challenge_phon_solution_ids'])) {
				$mistake = true;
			}

			if ($mistake) {
				$message = '<p class="centered">Incorrect!</p>';
			}
			else {
				$_SESSION['challenge_correct_answers']++;
				$_SESSION['challenge_correct_phon_answers']++;
				$message = '<p class="centered">Correct!</p>';
			}    
			$_SESSION['challenge_counter_seen_items']++;
			
		/**************************************************************************************************************************************************************/
		
		} else if ($_SESSION['challenge_counter_seen_items'] < 12) { //evaluation for morph. task.
		
			$submitted_solution = [];
			$i = 1;
			$solution = str_split($_SESSION['challenge_morph_correct_item']);
			while (isset($_POST['path' . $i])) { // loop through posted values
				$submitted_solution[$i -1] = $_POST['path' . $i]; //store the path of each letter the user has selected to display his solution after submission
				if (isset($solution[$i - 1]) && ($solution[$i - 1] != $submitted_solution[$i -1])) { //need to do -1 one cause submitted_solution starts at 1
					$errors = true;
				}
				$i++;
			}
			if (sizeof($submitted_solution) !== sizeof($_SESSION['challenge_morph_correct_item'])) {
				$errors = true;
			}
			$_POST['selected_challenge_item'] = implode($submitted_solution);
			$_SESSION['challenge_counter_seen_items']++;
			if ($errors == true) {
				$message = '<p class="centered">Incorrect!</p>';
				$border = 'red_border';
			} else {
				$message = '<p class="centered">Correct!</p>';
				$border = 'green_border';
				$_SESSION['challenge_correct_morph_answers']++;
				$_SESSION['challenge_correct_answers']++;
			}
		
		/**************************************************************************************************************************************************************/
		
		} else { //evaluation for syn. task
		
			if ($_POST['selected_challenge_item'] != $_SESSION['challenge_syn_correct']) {
            	$message = '<p class="centered">Incorrect!</p>';
            	$border = 'red_border';
			} else {
				$_SESSION['challenge_correct_answers']++;
				$_SESSION['challenge_correct_syn_answers']++;
				$message = '<p class="centered">Correct!</p>';
				$border = 'green_border';
			}    
			$_SESSION['challenge_counter_seen_items']++;
		
		}
	
	/**************************************************************************************************************************************************************/

    } // if task submitted
	else { //display new item
		if($_SESSION['challenge_counter_seen_items'] == $_SESSION['challenge_counter_all']) { //he has seen enough items
				unset($_SESSION['challenge_counter_all']);
				if($_SESSION['challenge_correct_answers'] == 18) { //he succeeded
					$_SESSION['user']->setEverythingCompleted(true);
					header('Location: success_challenge.php');
				} else { //he failed
					header('Location: failure_challenge.php');
				}
				die;
		}
		
		/**************************************************************************************************************************************************************/

		if ($_SESSION['challenge_counter_seen_items'] < 6) {

			//PHON. TASK
			
			//random selection of task
			if(sizeof($_SESSION['challenge_phon_items']) == 0) { //if he has seen everything -> start with all items again
				$_SESSION['challenge_phon_items'] = $_SESSION['challenge_original_phon_items']; // start with all items again
			}
			
			$counter = sizeof($_SESSION['challenge_phon_items']);
			$my_index = rand(0, $counter - 1); //get random integer between 0 and $counter - 1 (last remaining list index)
			$random_item = array_splice($_SESSION['challenge_phon_items'], $my_index, 1)[0]; //remove answer from items list, store it in variable
			
			//get task from DB
			$task_id = $random_item['word_id'];
			$_SESSION['challenge_phon_items_seen_ids'][] = $task_id;
			$word = $random_item['word'];
			$_SESSION['random_phon_word'] = $random_item['word'];
			
			$solution_query =   "SELECT pa.position, pa.tr_id, pt.img_path " .
								"FROM phon_answers AS pa, phon_word_transcription AS pt " .
								"WHERE pa.wd_id = " . $task_id . " AND pa.tr_id = pt.trans_id";
			$solution_result = $my_db_object->query($solution_query);
			$solution = []; //store all ipa symbols of the solution
			$solution_ids = []; //store order of IDs of correct transcription of the target word
			if ($solution_result !== false) {
				$solution_num_rows = $solution_result->num_rows;
				for ($i = 0; $i < $solution_num_rows; $i++) {
					$solution_data = $solution_result->fetch_array();
					$solution[$i]['position'] = intval($solution_data['position']); //store as number
					$solution[$i]['tr_id'] = intval($solution_data['tr_id']); //store as number
					$solution[$i]['img_path'] = $solution_data['img_path'];
					$solution_ids[$solution[$i]['position']] = $solution[$i]['tr_id'];        
				} // for solution_result
			} // if query successful
			
			$_SESSION['challenge_phon_solution_ids'] = $solution_ids;
			
			$j = sizeof($solution);
			while (sizeof($solution) < 20) { //minimum # of symbols
				$index_symbol = rand(0, $_SESSION['challenge_nr_symbols'] - 1); // get a random index of an IPA symbol
				$solution[$j]['position'] = 0;
				$solution[$j]['tr_id'] = intval($_SESSION['challenge_all_symbols'][$index_symbol]['trans_id']); //store as number
				$solution[$j]['img_path'] = $_SESSION['challenge_all_symbols'][$index_symbol]['img_path'];
				$j++;
			} // while
			
			// shuffle the ipa symbols for display:
			$symbols_random = array();
			$counter = sizeof($solution);
			for ($i = $counter; $i > 0; $i--){
				$my_index = rand(0, $i - 1); //get random integer between 0 and $i - 1 (last remaining list index)
				$symbols_random[] = array_splice($solution, $my_index, 1)[0]; //remove answer from options list, add it to random_list
			}
			
			$solution_result->free();
			
			$message = 'Click on the IPA symbols below in the right order to provide the correct transcription for the target word.';
		
		/**************************************************************************************************************************************************************/
		
		} else if ($_SESSION['challenge_counter_seen_items'] < 12) {
		
			//MORPH. TASK
			if(sizeof($_SESSION['challenge_morph_items']) == 0) { //if he has seen everything -> start with all items again
				$_SESSION['challenge_morph_items'] = $_SESSION['challenge_morph_original_items']; // start with all items again
			}
			shuffle($_SESSION['challenge_morph_items']);
			$random_word = array_pop($_SESSION['challenge_morph_items']);
			$_SESSION['challenge_morph_random_word'] = $random_word;
			$_SESSION['challenge_m_requested_id'] = $random_word['m_requested_id'];
			$_SESSION['challenge_random_word_id'] = $random_word['word_id'];
			
			//retrieve type requested morpheme (for display)
			$m_requested_query = 'SELECT morpheme_type_table.type, morph_words_table.word_id FROM morpheme_type_table, morph_words_table WHERE morpheme_type_table.type_id = ' 
								 . $_SESSION['challenge_m_requested_id'] . ' AND morph_words_table.word_id = ' . $_SESSION['challenge_random_word_id'];
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
			
			//retrieve correct morpheme
			$correct_morpheme_query = 'SELECT morphemes_table.morpheme FROM morphemes_table, words_morphemes_lookup WHERE morphemes_table.t_id = ' 
									  . $_SESSION['challenge_m_requested_id'] . ' AND words_morphemes_lookup.w_id = ' . $_SESSION['challenge_random_word_id'] 
									  . ' AND words_morphemes_lookup.m_id = morphemes_table.morpheme_id';
			$correct_morpheme_result = $my_db_object->query($correct_morpheme_query);
			$correct_item = [];
			if ($correct_morpheme_result !== false) {
				$correct_morpheme_num_rows = $correct_morpheme_result->num_rows;
				if ($correct_morpheme_num_rows > 0) {
					$correct_item = $correct_morpheme_result->fetch_array()['morpheme'];
					
				}
				
				$_SESSION['challenge_morph_correct_item'] = $correct_item;
			}
			$correct_morpheme_result->free();
			
			$message = 'Identify the following type of morpheme in the target word by clicking on it below: <strong>' . $m_requested[0]['type'] . '</strong>';
		
		/**************************************************************************************************************************************************************/
			
		} else {
			
			//SYN. TASK
			// reset items, if necessary:
			if(sizeof($_SESSION['challenge_syn_items']) == 0) { //if he has seen everything -> start with all items again
				$_SESSION['challenge_syn_items'] = $_SESSION['challenge_syn_original_items']; //start with all items again
			}
			
			$task_id = array_shift($_SESSION['challenge_syn_items']);
			$phrase = $task_id['phrase'];
			
			//get incorrect answer options from DB
			$incorrect_trees_query =   "SELECT si.tree_id, st.path " .
									   "FROM syntax_incorrect AS si, syntax_trees AS st " .
									   "WHERE si.phrase_id = " . $task_id['phrase_id'] . " AND si.tree_id = st.tree_id";
			$incorrect_trees_result = $my_db_object->query($incorrect_trees_query);
			$trees = []; //store all trees that are to be displayed as answer options
			if ($incorrect_trees_result !== false) {
				$incorrect_trees_num_rows = $incorrect_trees_result->num_rows;
				for ($i = 0; $i < $incorrect_trees_num_rows; $i++) {
					$data = $incorrect_trees_result->fetch_array();
					$trees[$i]['tree_id'] = intval($data['tree_id']); //store as number
					$trees[$i]['path'] = $data['path'];        
				} // for
			} // if query successful
			$incorrect_trees_result->free();
			
			//get correct answer from DB
			$correct_tree_query =   "SELECT path " .
									"FROM syntax_trees " .
									"WHERE tree_id = " . $task_id['correct_id'];
			$correct_tree_result = $my_db_object->query($correct_tree_query);
			if ($correct_tree_result !== false) {
				$correct_tree_num_rows = $correct_tree_result->num_rows;
				if ($correct_tree_num_rows > 0) {
					$data = $correct_tree_result->fetch_array();
					$trees[$i]['tree_id'] = $task_id['correct_id'];
					$trees[$i]['path'] = $data['path']; 
					$_SESSION['challenge_syn_correct'] = $data['path']; //store for checking later    
				} // if
			} // if query successful
			$correct_tree_result->free();
			$_SESSION['challenge_trees'] = ($trees); //store in session, so that can be displayed in same order after submission
			
			$message = '<p>Click on the correct syntax tree for:</p><p class="centered">"' . $phrase . '"</p>';
		}
	}
	
	$back_to_map = false;
	
	$my_db_object->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Challenge</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				
				// from line 326 to 344 -> phon. task
				var position = 1; // counter for symbols that have been added to transcription
				$(document).on('click', '.ipa_symbol', function() {
					$('#challenge_form').append('<input type="hidden" class="hidden_input_id" name="' + position + '" value="' + $(this).data('tr_id') + '" />');
                    $('#challenge_form').append('<input type="hidden" class="hidden_input_path" name="path' + position + '" value="' + $(this).attr('src') + '" />');
					position++;
                    $(this).removeClass('ipa_symbol').addClass('selected_ipa_symbol'); //change class -> symbol should not be clickable any more once it is part of the transcription
					$('#transcription_container').append($(this)); //move picture to transcription container
				});
				
				$('#delete_button').click(function(e) {
					e.preventDefault();
					$('#challenge_form > .hidden_input_path:last').remove(); // remove the hidden form fields corresponding to the last selected symbol
                    $('#challenge_form > .hidden_input_id:last').remove();
                    $('#transcription_container > .selected_ipa_symbol:last').addClass('ipa_symbol').removeClass('selected_ipa_symbol'); //change class back -> symbol should be clickable again
					$('#ipa_container').append($('#transcription_container > .ipa_symbol:last'));
					if (position > 0) {
						position--;
					}
				});
				
				/**************************************************************************************************************************************************************/

				// from line 347 to 374 morph. task
				var position_2 = 1; // changed this to another position var
				$(document).on('click', '.letter', function(e) {
					e.preventDefault();
					$('#challenge_form').append('<input type="hidden" class="hidden_morph_path" name="path' + position_2 + '" value="' + $(this).attr('data') + '" />');
					position_2++;
					$('#morph_displayed').append($(this));
					$(this).removeClass('letter');
					$(this).addClass('unselectable_letter');
				});
				
				$('#undo_selection').click(function(e) {
					e.preventDefault();
					$('#challenge_form > .hidden_morph_path:last').remove(); // remove hidden input field from submission form
					$('#morph_displayed > .unselectable_letter:last').addClass('letter').removeClass('unselectable_letter');
					$('#morph_displayed > .letter:last').appendTo('#morpheme_container');
					if (position > 0) {
						position_2--;
					}
				});
				
				/**************************************************************************************************************************************************************/
				
				//from line 459 to -- syn. task
				$(document).on('click', '.tree_picture', function() {
					//remove existing selection borders:
					$(".tree_picture").each(function() {
						$(this).removeClass('selection_border');
						$(this).addClass('invisible_border');
					});
					//add selection border to clicked picture:
					$(this).removeClass('invisible_border');
					$(this).addClass('selection_border');
					//store the path of the selected image as value for submission:
					$('#selected_challenge_item').val($(this).attr('src'));
				});
				
/*<?php
				if (isset($_POST['selected_challenge_item']) && $_SESSION['challenge_counter_seen_items'] > 12) {
?>*/
				$(".tree_picture").each(function() {
					$(this).removeClass('tree_picture');
					$(this).addClass('unselectable_tree_picture');
					if ($(this).attr('src') == '<?php echo $_POST['selected_challenge_item']; ?>') {
						$(this).removeClass('invisible_border');
						$(this).addClass('<?php echo $border; ?>');
					}
				});
/*<?php
				}
?>*/
				
            }); // document ready function
		</script>
	</head>
	<body>
		<div id="frame">
		<div class="allcontent">
<?php
		if (($_SESSION['challenge_counter_seen_items'] < 6) || (isset($_POST['selected_challenge_item']) && $_SESSION['challenge_counter_seen_items'] == 6)) { //phon. task
?>
			<h3 class="centered">Phonology Task</h3>
			<p><?php echo $message; ?></p>
<?php
            if (isset($_POST['selected_challenge_item'])) { //display content for evaluation
?>
                <div id="transcription_container">
<?php
                for ($i = 1; $i <= sizeof($submitted_solution); $i++) {
?>
                    <img class="selected_ipa_symbol <?php echo $submitted_solution_frames[$i]; ?>" src="<?php echo $submitted_solution[$i]; ?>" width="43px" height="38px">
<?php
                } // for
                if (sizeof($submitted_solution) < sizeof($_SESSION['challenge_phon_solution_ids'])) { //if submitted solution was shorter than correct solution -> print empty boxes marking missing symbols
                    for ($j = 0; $j < (sizeof($_SESSION['challenge_phon_solution_ids']) - sizeof($submitted_solution)); $j++) {
?>
                        <img class="selected_ipa_symbol red_border" src="../ipa_images/empty.png" width="43px" height="38px">
<?php
                    }
                }
?>
                </div>
<?php
            } // if isset $_POST (display evaluation)
            else { //display content for new item
?>
				<p class="centered">Target Word: "<?php echo $_SESSION['random_phon_word']; ?>"</p>
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
<?php
            } // else (display new item)
			
			} //phon. task
			
			/**************************************************************************************************************************************************************/

			else if (($_SESSION['challenge_counter_seen_items'] < 12) || (isset($_POST['selected_challenge_item']) && $_SESSION['challenge_counter_seen_items'] == 12)) { //morph. task
?>
			<h3 class="centered">Morphology Task</h3>
			<p> <?php echo $message; ?> </p>
			<p class="centered">Target Word: <?php echo $_SESSION['challenge_morph_random_word']['word']; ?></p>
<?php
				if (isset($_POST['selected_challenge_item'])) { //display content for evaluation
?>			
					<div id="morph_displayed"><button type="button" id="submitted_morpheme" class="<?php echo $border; ?>"><strong><?php echo $_POST['selected_challenge_item']; ?></strong></button></div>
<?php
				} //display content for evaluation
				else { //display new item
?>
				<div id="morph_displayed"></div>
				<div class="right_aligned"><button id="undo_selection">Undo selection</button></div>
				<div id="morpheme_container">
<?php
                    $letters = str_split($_SESSION['challenge_morph_random_word']['word']);
					for ($i = 0; $i < sizeof($letters); $i++) {
?>
						<button type="button" class="letter invisible_border" name="letter" data="<?php echo $letters[$i]; ?>"><strong> <?php echo $letters[$i]; ?> </strong></button>
<?php
					}
?>
					</tr>
				</div>

<?php
				}
?>
<?php
			} //morph. task
			
			/**************************************************************************************************************************************************************/

			else if (($_SESSION['challenge_counter_seen_items'] < 18) || (isset($_POST['selected_challenge_item']) && $_SESSION['challenge_counter_seen_items'] == 18)) { //syn. task
?>
				<h3 class="centered">Syntax Task</h3>
				<p><?php echo $message; ?></p>
				<div id="trees_container">
<?php
					for ($i = 0; $i < sizeof($_SESSION['challenge_trees']); $i++) {
?>
						<img class="tree_picture invisible_border" src="<?php echo $_SESSION['challenge_trees'][$i]['path']; ?>" width="220px" height="300px" alt="<?php echo $_SESSION['challenge_trees'][$i]['path']; ?>" />
<?php
					} // for
?>
				</div>
<?php
			} //display syn. task

			if (isset($_POST['selected_challenge_item'])) {
?>
			<form id="continue_form" name="continue_form" method="post" action="challenge.php">
				<p class="right_aligned">
				<input type="submit" id="continue_button" name="continue" value="Continue" />
				</p>
			</form>
<?php
			} else {
?>
			<br><br>
			<form id="challenge_form" name="challenge_form" method="post" action="challenge.php">
				<div id="challenge_task_displayed">
					<input type="hidden" id="selected_challenge_item" name="selected_challenge_item" value="" />
				</div>
				<div class="right_aligned">
					<input type="submit" id="submit_challenge_form" name="submit_challenge_form" value="Ready" />
				</div>
			</form>
<?php
			}
?>
			<p class="centered">
                <em>Correct Answers: <?php echo $_SESSION['challenge_correct_answers'] ; ?><br>
                <?php echo $_SESSION['challenge_counter_seen_items'] ; ?> out of <?php echo $_SESSION['challenge_counter_all'] ; ?> questions answered<br>
<?php 
                if ($_SESSION['challenge_correct_answers'] >= $_SESSION['challenge_counter_all']) { // enough correct answers to pass
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
                <?php echo $_SESSION['challenge_counter_all'] ; ?> correct answers required </em>
            </p>
            </div>
			<?php include 'page_elements/bottom_pane.php'; ?>
		</div>
	</body>
</html>