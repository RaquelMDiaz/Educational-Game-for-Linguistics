<?php
// displays help provided by Prof. Handke in a pop-up window (called by click on help-button)

	include_once 'user_class.php';
	include_once 'session_check.php';
	include 'db.php';
	$content = '';
	$errors = false;

	if ($_SESSION['user']->getCurrentTower() == 1) { // phonetics help
		$help_source = 'SELECT help_source FROM help_source_table WHERE help_id = ' . $_SESSION['help_id'];
		$help_source_result = $my_db_object->query($help_source);
		if ($help_source_result === false) {
				$errors = true;
				die('Error!' . $my_db_object->error);
		}
		$num_rows_help_source = $help_source_result->num_rows;
		if ($num_rows_help_source > 0) {
			for ($i = 0; $i < $num_rows_help_source; $i++) {
					$help[] = $help_source_result->fetch_array(MYSQLI_ASSOC);
			}
		}
		$content = '<p>
				<img class="left_image" src="../images/handke.png" width="220px" height="242px" alt="JH" />
				You need some help with transcription? Well, I\'ve just had this great idea for a new YouTube
				video, so I can\'t stay long, but maybe this can help you... To start with, a quick reminder: 
				don\'t forget to use the stress <strong>\'</strong> before the stressed syllable. And something 
				else that might help you... <br><br><audio width="" height="" controls><source src="' . $help[0]['help_source'] . '" type="audio/mp3">
				</source>Your browser does not support the video tag.</audio><br></p>';
	
	/**************************************************************************************************************************************************************/
		
	} elseif ($_SESSION['user']->getCurrentTower() == 2) { // morph help
	    $help_source = 'SELECT help_source FROM help_source_table WHERE help_id = ' . $_SESSION['help_id'];
		$help_source_result = $my_db_object->query($help_source);
		if ($help_source_result === false) {
				$errors = true;
				die('Error!' . $my_db_object->error);
		}
		$num_rows_help_source = $help_source_result->num_rows;
		if ($num_rows_help_source > 0) {
			for ($i = 0; $i < $num_rows_help_source; $i++) {
					$help[] = $help_source_result->fetch_array(MYSQLI_ASSOC);
			}
		}
		$content = '<p>
			<img class="left_image" src="../images/handke.png" width="220px" height="242px" alt="JH" /><br><br>' . $help[0]['help_source'] . '</p>';
	
	/**************************************************************************************************************************************************************/
	
	} elseif ($_SESSION['user']->getCurrentTower() == 3) { // syn help
	    $help_source = 'SELECT help_source FROM help_source_table WHERE help_id = ' . $_SESSION['help_id'];
		$help_source_result = $my_db_object->query($help_source);
		if ($help_source_result === false) {
				$errors = true;
				die('Error!' . $my_db_object->error);
		}
		$num_rows_help_source = $help_source_result->num_rows;
		if ($num_rows_help_source > 0) {
			for ($i = 0; $i < $num_rows_help_source; $i++) {
					$help[] = $help_source_result->fetch_array(MYSQLI_ASSOC);
			}
		}
		$content = '<p>
			<img class="left_image" src="../images/handke.png" width="220px" height="242px" alt="JH" /><br><br>' . $help[0]['help_source'] . '</p>';
	}
	$my_db_object->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Help</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="../js/popup.js"></script>
    </head>
    <body>
		<div id="help">
			<div class="allcontent">
				<?php echo $content; ?>
			</div>
		</div>
    </body>
</html>