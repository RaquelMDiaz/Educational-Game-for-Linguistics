<?php
// first page user sees after signing-up: Prof. Handke introduces the situation
	include_once 'user_class.php';
    include_once 'session_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
    			$('#continue_button').click(function(e) {
                     window.location.assign("main_game_board.php"); 
    			}); 
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
            	<p>
					<img class="left_image" src="../images/handke.png" width="220px" height="242px" alt="JH" />
					“<?php echo $_SESSION['user']->getUserName(); ?>, I’m afraid I have some urgent news. The University has been invaded by The Society of Famous Linguists. 
					I have no idea what they want here and their master, Chomsky, who seems to be the one who ordered this invasion, just won't tell me the reason. 
					He said that he will only talk to a student of linguistics who has proven himself worthy as a talented linguist. 
					So I'm desperately looking for somebody who'll go in there, master all the challenges these crazy linguists will present to him, and finally convince Chomsky to gather his companions and leave us in peace again. 
					They actually have taken up nearly all the towers of the PhilFak, and no classes can take place until we get rid of them again. 
					You seem to be just the right person for this! I'll be available, in case you need some help with the linguistic challenges, but you will have to be the one who saves us. 
					I trust you! You can do it! Just go ahead to the towers, where you'll find the linguists with their challenges for you.”
					<p class="right_aligned"><button id="continue_button">Continue</button></p>
				</p>
            </div>
        </div>
    </body>
</html>