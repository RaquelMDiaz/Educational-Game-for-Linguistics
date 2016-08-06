<!DOCTYPE html>
<!-- Start page, allows user to sign up or log in to enter the game -->
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
    			$('#submit_signup').click(function(e) {
                    // check form input:
                    var errors = false;
                    $('#sign_up_form').find('.error_msgs').remove();
                    if ($.trim($('#username').val()) == '') {
                        errors = true;
                        $('#username').after(' <span class="error_msgs">Please provide a username!</span>');
                    }
                    if ($.trim($('#password').val()) == '') {
                        errors = true;
                        $('#password').after(' <span class="error_msgs">Please provide a password!</span>');
                    }
                    if ($.trim($('#password_repeated').val()) == '') {
                        errors = true;
                        $('#password_repeated').after(' <span class="error_msgs">Please provide a repetition of your password!</span>');
                    }
                    else if ($('#password_repeated').val() != $('#password').val()) {
                        errors = true;
                        $('#password_repeated').after(' <span class="error_msgs">Your repeated password does not match your password!</span>');
                    }
                    if (errors) { //form input not ok -> prevent submission
                        e.preventDefault();
                    }
                    else { // if no errors: allow submission, remove hidden input field (as check for JS enabled)
                        $('#sign_up_form').find('.js_check').remove();
                    }
                });
                $('#submit_login').click(function(e) {
                    // check form input:
                    var errors = false;
                    $('#login_form').find('.error_msgs').remove();
                    if ($.trim($('#username_login').val()) == '') {
                        errors = true;
                        $('#username_login').after(' <span class="error_msgs">Please provide your username!</span>');
                    }
                    if ($.trim($('#password_login').val()) == '') {
                        errors = true;
                        $('#password_login').after(' <span class="error_msgs">Please provide your password!</span>');
                    }
                    if (errors) { //form input not ok -> prevent submission
                        e.preventDefault();
                    }
                    else { // if no errors: allow submission, remove hidden input field (as check for JS enabled)
                        $('#login_form').find('.js_check').remove();
                    }
                });
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
<?php 
            if (isset($error_msg)) { // submission error has been detected by the php file
?>
                <p class="red_border error_indexpage"><strong><?php echo $error_msg; ?></strong></p>
<?php
            }
?>
		        <p>Welcome to "The Society of Famous Linguists!"</p>
                <p>This educational game has been created for students of linguistics who want to deepen and practice their knowledge of linguistic key areas. So if you feel up for a challenge, sign up or, if you have been here before, log in with your account. Have fun!</p>
                <p>
                    <fieldset>
                        <legend>Sign Up</legend>
                        <form id="sign_up_form" name="sign_up_form" method="post" action="sign_in.php">
                            <div class="display_table">
                                <div class="table_row">
                                    <div class="table_cell">
                                        <label for="username" id="label_username">Enter a username of your choice:</label>
                                    </div>
                                    <div class="table_cell">
                                        <input type="text" id="username" name="username" size="10" />
                                    </div>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">
                                        <label for="password" id="label_password">Enter a password:</label>
                                    </div>
                                    <div class="table_cell">
                                        <input type="password" id="password" name="password" size="10" />
                                    </diV>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">
                                        <label for="password_repeated" id="label_password_repeated">Repeat the password:</label>
                                    </div>
                                    <div class="table_cell">
                                        <input type="password" id="password_repeated" name="password_repeated" size="10" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="js_check" class="js_check" value="" /> <!-- to check whether JS is enabled in user's browser: this will be deleted by JS prior to form submission -->
                            <p class="right_aligned"><input type="submit" name="submit_signup" id="submit_signup" value="Sign Up"></p>
                        </form>
                    </fieldset>
                </p>
                <p> 
                    <fieldset>
                        <legend>Log In</legend>
                        <form id="login_form" name="login_form" method="post" action="sign_in.php">
                            <div class="display_table">
                                <div class="table_row">
                                    <div class="table_cell">
                                        <label for="username_login" id="label_username_login">Your username:</label>
                                    </div>
                                    <div class="table_cell">
                                        <input type="text" id="username_login" name="username_login" size="10" />
                                    </div>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">
                                        <label for="password_login" id="label_password_login">Your password:</label>
                                    </div>
                                    <div class="table_cell">
                                        <input type="password" id="password_login" name="password_login" size="10" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="js_check" class="js_check" value="" /> <!-- to check whether JS is enabled in user's browser: this will be deleted by JS prior to form submission -->
                            <p class="right_aligned"><input type="submit" name="submit_login" id="submit_login" value="Log In"></p>
                        </form>
                    </fieldset>
                </p>
            </div>
        </div>
    </body>
</html>