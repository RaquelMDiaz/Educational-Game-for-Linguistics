<?php
// success challenge -> user wins game
	include_once 'user_class.php';
	include_once 'session_check.php';
	$content = '';
	$errors = false;

	if ($_SESSION['user']->getEverythingCompleted() == true) { // check if user completed all tasks
			$content = '
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"You\'ve done it. You have conquered all the challenges and you are now worthy of my long-held title… I see that my days as the greatest of the great linguists are over. 
			Well, well… Maybe it\'s time for me to finally dedicate myself entirely to politics. Who cares about syntax anyway?"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>
			';
	} else {
		$errors = true;
		die('Error!');
	}

	$_SESSION['user']->saveCurrentState(); // save state
	$help_available = false;
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Success</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#continue_to_main_board', function(e) {
					window.location.assign("main_game_board.php");
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