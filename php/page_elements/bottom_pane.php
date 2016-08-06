<!-- bottom pane for all the pages (contains navigation buttons) -->

<div class="bottom_pane">
	<script src="../js/popup.js"></script>
	<script src="../js/tooltip.js"></script>
	<script>
		$(document).ready(function() {
			$('#notebook_button').my_popup({
				name: 'notebook',
				url: 'notebook.php',
				height: 850,
				width: 650
			});

			$('#hint_button').my_popup({
				name: 'help',
				url: 'help.php',
				height: 550,
				width: 650
			});

			$('.tooltip1').initializeTooltip({ // notebook tooltip
				id: "my_tooltip1",
				w: 250,
				h: 30,
				bgc: "white",
				fgc: "#a3948f"
			});

			$('.tooltip2').initializeTooltip({ // help tooltip
				id: "my_tooltip2",
				w: 250,
				h: 30,
				bgc: "white",
				fgc: "#a3948f"
			});

			$('.tooltip3').initializeTooltip({ // logout tooltip
				id: "my_tooltip3",
				w: 160,
				h: 20,
				bgc: "white",
				fgc: "#a3948f"
			});

			$('a.tooltip').click(function(e) {
				e.preventDefault();
			});

			$('#back_map_button').click(function() {
/* <?php
				if (isset($confirm_back_to_map) && ($confirm_back_to_map == true)) { //points where user is in middle of task -> ask for confirmation
?>*/
					if (confirm("Leaving the task now will reset your score. Your solutions so far will be lost. Are you sure you want to leave?")) {
/* <?php
				}
?> */
						window.location.assign("main_game_board.php"); 
/* <?php
				if (isset($confirm_back_to_map) && ($confirm_back_to_map == true)) { //points where user is in middle of task -> ask for confirmation
?>*/
					}
/* <?php
				}
?> */
			});
			$('#logout_button').click(function() {
				if (confirm("Are you sure you want to log out? If your are just in the middle of a task, your progress in this task will not be saved!")) {
					window.location.assign("logout.php");
				}
			});
/* <?php
				if (isset($back_to_map) && ($back_to_map == false)) { //points where user should not be allowed to go back to main board
?>*/
					$('#back_map_button').hide();
					$('#logout_button').hide();
/* <?php
				}
				if (isset($logout) && ($logout == true)) { //user should be allowed to logout (on main map)
?>*/
					$('#logout_button').show();
/* <?php
				}
				if (isset($help_available) && ($help_available == false)) { //points where user should not see help
?>*/
					$('#hint_button').hide();
/* <?php
				}
?>*/


		});
	</script>
    <a href="#" class="tooltip1 tooltip" title="Click here to look at your personal notebook!"><img id="notebook_button" class="buttons" src="../images/notebook_button.png" alt="inventory_button" width="74px" height="65px"/></a>
    <a href="#" class="tooltip2 tooltip" title="Click here for some help with your task!"><img id="hint_button" class="buttons" src="../images/hint_button.png" alt="hint_button" width="74px" height="65px" /></a>
    <span id="right_buttons">
    	<img id="back_map_button" class="buttons" src="../images/back_button.png" alt="back_button" width="74px" height="65px" />
    	<a href="#" class="tooltip3 tooltip" title="Click here to log out!"><img id="logout_button" class="buttons" src="../images/logout.png" alt="logout_button" width="74px" height="65px" /></a>
    </span>
</div>