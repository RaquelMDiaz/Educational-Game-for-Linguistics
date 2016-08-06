<?php
// displays multiple-choice questions to the user as punishment for failing in one of the sub.quest tasks

	include_once 'user_class.php';
	include_once 'session_check.php';

    include_once 'db.php';
	$errors = false;
	$towers = array(1 => 'phon', 2 => 'morph', 3 => 'syn');

	if (!isset($_SESSION['mcqs_counter_all'])) { // run only when user first accesses page
		$_SESSION['mcqs_counter_all'] = 10; //10 per topic
		$_SESSION['mcqs_counter_correct'] = 0;
		
		$topic = $_SESSION['user']->getCurrentTower();
		
		$retrieve_mcqs_query = "SELECT question, quest_text, correct, incorrect1, incorrect2, incorrect3
								FROM questions_table
								WHERE quest_topic = " . $topic;
		
		$retrieve_mcqs_query_result = $my_db_object->query($retrieve_mcqs_query);
		if ($retrieve_mcqs_query_result === false) {
			$errors = true;
			die('Error!' . $my_db_object->error);
		}
		
		$num_rows_mcqs = $retrieve_mcqs_query_result->num_rows;
		
		if ($num_rows_mcqs > 0) {
			for ($i = 0; $i < $num_rows_mcqs; $i++) {
	        	$mcqs_rows[] = $retrieve_mcqs_query_result->fetch_array(MYSQLI_ASSOC);
	        } // for

			$_SESSION['all_questions'] = $mcqs_rows;
			$_SESSION['randomized_questions'] = [];
			//get the items the user has not seen yet for display:
	        foreach ($mcqs_rows as $my_mcq) {
	            if (!(in_array($my_mcq['question'], $_SESSION['user']->getSeenQuestions($towers[$topic])))) { // user has not seen the item
	                $_SESSION['randomized_questions'][] = $my_mcq;
	            }
	        } // foreach
        	$_SESSION['mcqs_seen_ids'] = []; // to keep track of what user has seen already during this run
			
			shuffle($_SESSION['randomized_questions']);
		} 
		else {
			die('Error!');
		}
	} // if (!isset($_SESSION['mcqs_counter_all']))
	
	/**************************************************************************************************************************************************************/

	if ($_SESSION['user']->getCurrentTower() == 1 || $_SESSION['user']->getCurrentTower() == 2 || $_SESSION['user']->getCurrentTower() == 3) {
		if (isset($_POST['submit_mcq_form'])) {

			$selected_option = $_POST['options'];
			if ($selected_option === $_SESSION['correct']) {
				$_SESSION['mcqs_counter_correct'] = 1;
				unset($_SESSION['mcqs_counter_all']);
				$feedback = '<p>That was correct! You may now repeat the task or choose another tower. Good luck in your quest!
			 		<br><p><button id="to_main_page">Continue to Main Page</button></p><br>
			 		</p>';
			}					
			else {
				$feedback = '<p>That\'s incorrect! You must try again with another question.</p>';
			}
		
		}

		if ($_SESSION['mcqs_counter_correct'] === 0) {
			
			if (sizeof($_SESSION['randomized_questions']) == 0) {
				foreach ($_SESSION['all_questions'] as $temp_question) {
	                if (!(in_array($temp_question['question'], $_SESSION['mcqs_seen_ids']))) { // user has not seen item during this run of the task
	                    $_SESSION['randomized_questions'][] = $temp_question;
	                } // if
	            } // foreach
	            $_SESSION['user']->resetSeenQuestions($towers[$_SESSION['user']->getCurrentTower()]); //take everything as 'unseen' again
	            if (sizeof($_SESSION['randomized_questions']) == 0) { // user has seen all items during this run (should not happen, but just in case)
	                $_SESSION['randomized_questions'] = $_SESSION['all_questions']; // start with all items again
	            }
				shuffle($_SESSION['randomized_questions']);
			}

			$my_random_mcq = array_pop($_SESSION['randomized_questions']);
			
			$_SESSION['user']->setSeenQuestion($towers[$_SESSION['user']->getCurrentTower()], $my_random_mcq['question']); // remember question as seen
			$_SESSION['mcqs_seen_ids'][] = $my_random_mcq['question'];
			$_SESSION['correct'] = $my_random_mcq['correct'];
			$my_random_mcq_copy = $my_random_mcq;
			$question_id = array_shift($my_random_mcq_copy);
			$question_text = array_shift($my_random_mcq_copy);

			shuffle($my_random_mcq_copy);
			
		}
			
	} else {
		$errors = true;
		die('Error!');
	}
	
	$my_db_object->close();
	
	$back_to_map = false; // user is not allowed to go back at this point
	$help_available = false;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>MC</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#to_main_page', function(e) {
					window.location.assign("main_game_board.php");
                });
			});
		</script>
	</head>
	<body>
		<div id="frame">
			<div  class="allcontent">
<?php
			if (isset($feedback)) {
				echo $feedback;
			}
			if ($_SESSION['mcqs_counter_correct'] === 0) {
?> 
				<form id="mcq_form" name="mcq_form" method="post" action="index_mcqs.php">

					<div id="display_mc">
						<h3>
<?php
							echo $question_text;
?>
						</h3>
<?php
				$x = 0;
				for ($i = 0; $i < sizeof($my_random_mcq_copy); $i++) {
					$option_id = $x++;
?>
						<input type="radio" name="options" value="<?php echo $my_random_mcq_copy[$i]; ?>" id="<?php echo $option_id; ?>" /><?php echo $my_random_mcq_copy[$i]; ?><br><br>
<?php
				}
?>			
						<div class="right_aligned"><input type="submit" id="submit_mcq_form" name="submit_mcq_form" value="Ready" /></div>
					</div>		
				</form>
<?php
	}
?>
			</div>
			<?php include 'page_elements/bottom_pane.php'; ?>
		</div>
	</body>
</html>
<?php
    unset($_POST);
?>