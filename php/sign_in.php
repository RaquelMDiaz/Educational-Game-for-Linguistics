<?php
	include_once 'user_class.php';
    session_start();

    // prevent session fixation:
	if (!isset($_SESSION['dse87jw'])) {
		session_regenerate_id(); // Generate a new session ID
		$_SESSION['dse87jw'] = 1; // Set the special variable to mark the session as genuine
	}
	// prevent session hijacking:
	$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];

    $bool_values = array(0 => false, 1 => true); // in database: 0 for false, 1 for true

	if (isset($_POST)) { //something has been submitted

		// JS is disabled (checked here, because game requires JavaScript -> don't allow access without it):
		if (isset($_POST['js_check'])) { 
			$error_msg = "You don't have JavaScript enabled in your browser, which means that the game won't work properly. 
						Please enable JavaScript and then try again to sign up or log in.";
			include 'index.php';
			die;
		} // if JavaScript disabled
		
		/***************************************************************************************************************************/
		// Signing up:
		else if (isset($_POST['submit_signup'])) {
			// Check whether user name already exists:
			include_once 'db.php';
			$username = prepare_string_for_db($_POST['username']);
			$name_query = "SELECT user_ID FROM users WHERE user_name = '" . $username . "'";
			$name_result = $my_db_object->query($name_query);
			if ($name_result !== false) {
				if ($name_result->num_rows > 0) { // user name exists -> back to form
					$error_msg = "This user name already exists. Please choose a different name!";
					include 'index.php';
					die;
				} // if
				else { // name does not exist -> create account
					$insert_name_query = "INSERT INTO users (user_name, password, unlocked_towers, name1, name2, name3, name4, name5, name6, name7, " . 
															"collected_sentences, tree_task_completed, phon_power, morph_power, syn_power, " . 
															"phon_seen_items, morph_seen_items, syn_seen_items, phon_seen_mc_questions, morph_seen_mc_questions, syn_seen_mc_questions, everything_completed) " . 
										"VALUES ('" . $username . "', '" . md5($_POST['password']) . "', '', 0, 0, 0, 0, 0, 0, 0, " . 
												"'', 0, 0, 0, 0, " . 
												" '', '', '', '', '', '', 0)";
					if($my_db_object->query($insert_name_query) == false){// if the query is unsuccessful
                        $error_msg = 'Invalid query: ' . $my_db_object->error;// send error message
                        include 'index.php';
						die;
                    } // if
                    else { // sign up was successfull -> create user in session, take user to Prof. Handke introduction
                        $_SESSION['user'] = new User($my_db_object->insert_id, $username);
                        header('Location: intro.php'); //take user to intro page
                        die;
                    } // else
				} // else
			} // if
			else {
				echo 'Invalid query: ' . $my_db_object->error;
			}

		} // else if sign up
		
		/***************************************************************************************************************************/
		// Logging in:
		else if (isset($_POST['submit_login'])) {
			// Check whether user name exists:
			include_once 'db.php';
			$errors = false;
			$username = prepare_string_for_db($_POST['username_login']);
			$name_query = "SELECT * FROM users WHERE user_name = '" . $username . "'";
			$name_result = $my_db_object->query($name_query);
			if ($name_result !== false) {
				if ($name_result->num_rows > 0) { // user name exists -> check password
					$user_info = $name_result->fetch_array();
					if ($user_info['password'] !== md5($_POST['password_login'])) {
						$error_msg = "The password is incorrect. Please provide the correct password!";
						$errors = true;
					}
				} // if
				else { // name does not exist -> back to form
					$error_msg = "This user name does not exist. Please provide a correct user name or sign up!";
					$errors = true;
				} // else
				if ($errors) {
					include 'index.php';
					die;
				} // if errors
				// login successful: create user in session with info from DB, take to main game board
				$my_unlocked_towers = [];
				$my_collected_sentences = [];
				$my_seen_items = array("phon" => [],
									   "morph" => [],
									   "syn" => []);
				$my_seen_mc_questions = array("phon" => [],
											  "morph" => [],
											  "syn" => []);

				if ($user_info['unlocked_towers'] !== '') {
					$my_unlocked_towers = explode(',', $user_info['unlocked_towers']);	
				}
				if ($user_info['collected_sentences'] !== '') {
					$my_collected_sentences = explode(',', $user_info['collected_sentences']);	
				}
				if ($user_info['phon_seen_items'] !== '') {
					$my_seen_items['phon'] = explode(',', $user_info['phon_seen_items']);
				}
				if ($user_info['morph_seen_items'] !== '') {
					$my_seen_items['morph'] = explode(',', $user_info['morph_seen_items']);
				}
				if ($user_info['syn_seen_items'] !== '') {
					$my_seen_items['syn'] = explode(',', $user_info['syn_seen_items']);
				}
				if ($user_info['phon_seen_mc_questions'] !== '') {
					$my_seen_mc_questions['phon'] = explode(',', $user_info['phon_seen_mc_questions']);
				}
				if ($user_info['morph_seen_mc_questions'] !== '') {
					$my_seen_mc_questions['morph'] = explode(',', $user_info['morph_seen_mc_questions']);
				}
				if ($user_info['syn_seen_mc_questions'] !== '') {
					$my_seen_mc_questions['syn'] = explode(',', $user_info['syn_seen_mc_questions']);
				}

				$_SESSION['user'] = new User($user_info['user_ID'],
											$user_info['user_name'],
											null, // no current tower 
											$my_unlocked_towers,
											array(	"name1" => $bool_values[$user_info['name1']] ? 'Ula' : false,
													"name2" => $bool_values[$user_info['name2']] ? 'Austen' : false,
													"name3" => $bool_values[$user_info['name3']] ? 'Hoaman' : false,
													"name4" => $bool_values[$user_info['name4']] ? 'Miszka' : false,
													"name5" => $bool_values[$user_info['name5']] ? 'Loasi' : false,
													"name6" => $bool_values[$user_info['name6']] ? 'Unan' : false,
													"name7" => $bool_values[$user_info['name7']] ? 'Hunan' : false),
											$my_collected_sentences,
											$bool_values[$user_info['tree_task_completed']],
											array(	"phon" => $bool_values[$user_info['phon_power']],
													"morph" => $bool_values[$user_info['morph_power']],
													"syn" => $bool_values[$user_info['syn_power']]), 
											$my_seen_items, 
											$my_seen_mc_questions,
											$bool_values[$user_info['everything_completed']]);
				
				header('Location: main_game_board.php'); //take user to main map page
				die;
			} // if
			else {
				echo 'Invalid query: ' . $my_db_object->error;
			}
		} // else if log in
	} // if isset $_POST
?>