<?php
// first page - challenge
    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $help_available = false; // help is not available
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Chomsky's Tower</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
    			$('#continue_button').click(function(e) {
                     window.location.assign("challenge.php"); 
    			}); 
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
		        <img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
                <p>"Well, I will tell you why we are here. Hundreds of years ago the Society was given the prophecy that this year, a new very talented student of linguistics would arise in Marburg, and that he would become the new Master of the society.
                </p><p>Until now, it seems like you are that student. 
                But I won’t give up my position as lightly as this to a greenhorn like you. First, you’ll have to show me once more what you can really do."
               	</p>
		        <p><button id="continue_button">Continue</button></p>
                <p>&nbsp;<p>
                <p>&nbsp;<p>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>