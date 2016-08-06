<?php
// first page - syntax tower
    include_once 'user_class.php';
    include_once 'session_check.php';
    $_SESSION['user']->setCurrentTower(3);
    $help_available = false;
	$message = '';
	
	if ($_SESSION['user']->getLinguisticPower('syn')) {
		// user repeats task
		$message = '
		<img class="left_image" src="../images/jackendoff1.jpg" width="220px" height="275px" alt="Ray Jackendoff" />
                <p>"So here you are again. Welcome back! As you now, my name is Ray Jackendoff and this challenge involves a syntax task.
                </p>
                <p>
                	Just in case you might have forgot... you will see a phrase or sentence, and three different syntax trees, one of which correctly represents the structure 
					of the phrase or sentence in X-Bar Syntax. Just click on the picture which you think is the correct one, and see whether you were right. Good luck!"
               	</p>
		        <p><button id="continue_button">Continue</button></p>
		';
	} else {
		// user does task for first time
		$message = '
		<img class="left_image" src="../images/jackendoff1.jpg" width="220px" height="275px" alt="Ray Jackendoff" />
                <p>"Welcome to another challenge in this linguistic quest! Every step takes you closer to the final stage, so let\'s get right to work! 
                	Your task now has to do with syntax, Chomsky\'s beloved field of study.
                </p>
                <p>
                	You will see a phrase or sentence, and three different syntax trees, one of which correctly represents the structure of the phrase or sentence in X-Bar Syntax. 
                	Just click on the picture which you think is the correct one, and see whether you were right. Good luck!"
               	</p>
		        <p><button id="continue_button">Continue</button></p>
		';
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Syntax Tower</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#continue_button', function(e) {
                     window.location.assign("syntax_task.php"); 
    			});
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
		        <?php echo $message; ?>
                <p>&nbsp;<p>
                <p>&nbsp;<p>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>