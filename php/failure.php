<?php
// displays feedback by linguist, whenever user fails in a sub-quest task, takes him to multiple-choice questions

	include_once 'user_class.php';
	include_once 'session_check.php';

	include_once 'db.php';
	
	$content = '';
	$errors = false;
	
	if ($_SESSION['user']->getCurrentTower() == 1) {
		$content = '<p>
					<img class="left_image" src="../images/jespersen.jpg" width="220px" height="275px" alt="Otto Jespersen" />
					Well, that could have been better. Before I	can let you try again or go try your luck at another tower, 
					you\'ll have to show me that you know at least something about phonetics and	phonology. I\'ll ask 
					you some questions, and once you get one of them right, you might go on and prove that you can do better 
					than you did just now.
					<br></p><br><p><button id="continue_to_mc">Continue</button></p>';
	} elseif ($_SESSION['user']->getCurrentTower() == 2) {
		$content = '<p>
					<img class="left_image" src="../images/schleicher.jpg" width="220px" height="275px" alt="August Schleicher" />
					Oops! Apparently there were some things you couldn’t solve correctly. Let\'s see whether you can do better 
					with some theoretical questions. Once you get one right, you might try the morpheme analysis again, or just 
					go to another tower first.
					<br></p><br><p><button id="continue_to_mc">Continue</button></p>';
	} elseif ($_SESSION['user']->getCurrentTower() == 3) {
		$content = '<p>
					<img class="left_image" src="../images/jackendoff1.jpg" width="220px" height="275px" alt="Ray Jackendoff" />
					I\'m sorry, but it looks like there are some mistakes to polish off. No worries! Let\'s try with some multiple 
					choice questions about syntax. Once you get a right answer, you can repeat the task!
					<br></p><br><p><button id="continue_to_mc">Continue</button></p>';
	}
	
	$my_db_object->close();
	
	$back_to_map = false; // user is not allowed to go back at this point
	$help_available = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Failure</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#continue_to_mc', function(e) {
					e.preventDefault();
					window.location.assign("index_mcqs.php");
                });
			});
		</script>
    </head>
    <body>
		<div id="frame">
			<div class="allcontent">
				<?php echo $content; ?>
			</div>
			<?php include 'page_elements/bottom_pane.php'; ?>
		</div>
    </body>
</html>