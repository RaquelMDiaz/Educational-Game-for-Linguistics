<?php
/**************************************************************************************************************************************************************
CLASS DECLARATION FOR CLASS "USER" (PHP)

- to create objects that represent the user who is currently playing
- new instance should be created every time a user logs in / creates an account
- keeps track of the users achievements in the game
- in case a user with an existing account logs in, the data of previous achievements is loaded from the database and handed to the constructor function
**************************************************************************************************************************************************************/
	
	class User {
		
		private $user_ID, $user_name, $current_tower, $unlocked_towers, $collected_names, $collected_sentences, $tree_task_completed, $linguistic_powers, $seen_items, $seen_mc_questions, $everything_completed;
		
		function __construct   ($my_user_ID,
								$my_user_name,
								$my_current_tower = null, 
								$my_unlocked_towers = [],
								$my_collected_names = array("name1" => false,
															"name2" => false,
															"name3" => false,
															"name4" => false,
															"name5" => false,
															"name6" => false,
															"name7" => false),
								$my_collected_sentences = [],
								$my_tree_task_completed = false,
								$my_linguistic_powers = array("phon" => false,
															 "morph" => false,
															 "syn" => false), 
								$my_seen_items = array("phon" => [],
													   "morph" => [],
													   "syn" => []), 
								$my_seen_mc_questions = array("phon" => [],
															  "morph" => [],
															  "syn" => []),
								$my_everything_completed = false) {
			
			$this->user_ID = $my_user_ID; // ID under which user is stored in DB
			$this->user_name = $my_user_name;
			$this->current_tower = $my_current_tower; // control of which tower the user is currently in / tries to access -> number: 1, 2 or 3 (phon, morph or syn)
			$this->unlocked_towers = $my_unlocked_towers; // control of which towers the user has already unlocked -> array of numbers (1,2,3)
			$this->collected_names = $my_collected_names; // control of which names of the family tree he has already discovered
			$this->collected_sentences = $my_collected_sentences; // control of which sentences of the family tree he has already discovered (array of strings, 1 string = 1 sentence)
			$this->tree_task_completed = $my_tree_task_completed; // control of whether the user has solved all parts of the tree task already or not (true or false)
			$this->linguistic_powers = $my_linguistic_powers; // control of which linguistic powers he has already collected
			$this->seen_items = $my_seen_items; // control of which single subquests items (in the phon/morph/syn tasks) he has already seen -> three arrays of numbers (item IDs)
			$this->seen_mc_questions = $my_seen_mc_questions; // control of which mc questions (for phon/morph/syn) he has already seen -> three arrays of numbers (question IDs)
			$this->everything_completed = $my_everything_completed; //control of whether user has completed final challenge
		} // function __construct
		
		
		function getUserName () {
			return $this->user_name;
		} // function getUserName
		
		function setCollectedName ($my_name, $my_solution) { // to be called once user has collected a new name -> updates the property; possible arguments: 'name1', 'name2', 'name3'
			$this->collected_names[$my_name] = $my_solution;
		} // function setCollectedName
		
		function getCollectedName ($my_name) { // to check whether user has collected a specific name already; possible arguments: 'name1', 'name2', 'name3'
			return $this->collected_names[$my_name];
		} // function getCollectedNames
		
		function setCurrentTower ($my_tower_id) { //to be called whenever user enters one tower -> set to the ID of this tower; possible arguments: 1,2,3
			$this->current_tower = $my_tower_id;
		} // function setCurrentTower
		
		function getCurrentTower () {
			return $this->current_tower;
		} // function getCurrentTower
		
		function setUnlockedTower ($my_tower_id){ // to be called when user has unlocked a tower -> add the nmber of that tower to the array; possible arguments: 1,2,3s
			array_push($this->unlocked_towers, $my_tower_id);
		}
		
		function getUnlockedTowers () {
			return $this->unlocked_towers;
		} // function getUnlockedTowers
		
		function getCollectedNames () {
			return $this->collected_names;
		} // function getCollectedNames

		function setCollectedSentence ($my_sentence) { // to be called once user has collected a new sentence -> updates the property; possible arguments: string (representing one sentence)
			$this->collected_sentences[] = $my_sentence;
		} // function setCollectedSentence

		function getCollectedSentences () {
			return $this->collected_sentences;
		} // function getCollectedSentences
		
		function setLinguisticPower($my_power, $my_boolean_value) { // to be called when user wins or looses a power, first parameter: name of power (phon, morph, syn), second parameter: true or false
			$this->linguistic_powers[$my_power] = $my_boolean_value;
		} // function setLinguisticPower
		
		function getLinguisticPower($my_power) { // to check whether user possesses a specific power; possible arguments: 'phon', 'morph', 'syn'
			return $this->linguistic_powers[$my_power];
		} // function getLinguisticPower
		
		function setTreeTaskCompleted($my_boolean_value) { // to be called when user solves tree task, parameter: true or false
			$this->tree_task_completed = $my_boolean_value;
		} // function setTreeTaskCompletetd
		
		function getTreeTaskCompleted() { 
			return $this->tree_task_completed;
		} // function getTreeTaskCompleted
		
		function getSeenItems($my_category) { // to check which items user has seen already; possible arguments: 'phon', 'morph', 'syn'
			return $this->seen_items[$my_category];
		} // function getSeenItems

		function resetSeenItems($my_category, $my_ids = []) { // to reset items user has seen already; possible arguments: 'phon', 'morph', 'syn', and an array of IDs (for the tasks with different levels)
			if (sizeof($my_ids) == 0) {
				$this->seen_items[$my_category] = [];
			} // if
			else {
				$this->seen_items[$my_category] = array_diff($this->seen_items[$my_category], $my_ids); // remove the items in $my_ids from the seen items array
			}
		} // function resetSeenItems

		function setSeenItem($my_category, $my_id) { // to remember an item as seen; possible arguments: 'phon', 'morph', 'syn' + a number
			$this->seen_items[$my_category][] = $my_id;
		} // function setSeenItem
		
		function getSeenQuestions($my_category) { // to check which mc questions user has seen already; possible arguments: 'phon', 'morph', 'syn'
			return $this->seen_mc_questions[$my_category];
		} // function getSeenQuestions

		function setSeenQuestion($my_category, $my_id) { // to remember a question as seen; possible arguments: 'phon', 'morph', 'syn' + a number
			$this->seen_mc_questions[$my_category][] = $my_id;
		} // function setSeenQuestion

		function resetSeenQuestion($my_category) { // remove the seen questions for one category, possible arguments: 'phon', 'morph', 'syn'
			$this->seen_mc_questions[$my_category] = [];
		} // function resetSeenQuestions

		function getEverythingCompleted() {
			return $this->everything_completed;
		} // function getEverythingCompleted

		function setEverythingCompleted($my_boolean_value) { // to be set when final challenge is completed; possible arguments: true / false
			$this->everything_completed = $my_boolean_value;
		} // function getEverythingCompleted
		
		function saveCurrentState() { // saves the current progress of the user to the database
			include_once 'db.php';

			$update_query = "UPDATE users SET " .
							"unlocked_towers = '" . implode(',', $this->unlocked_towers) . "', " .
							"name1 = " . (($this->collected_names['name1']) ? '1' : '0') . ", " .
							"name2 = " . (($this->collected_names['name2']) ? '1' : '0') . ", " .
							"name3 = " . (($this->collected_names['name3']) ? '1' : '0') . ", " .
							"name4 = " . (($this->collected_names['name4']) ? '1' : '0') . ", " .
							"name5 = " . (($this->collected_names['name5']) ? '1' : '0') . ", " .
							"name6 = " . (($this->collected_names['name6']) ? '1' : '0') . ", " .
							"name7 = " . (($this->collected_names['name7']) ? '1' : '0') . ", " .
							"collected_sentences = '" . implode(',', $this->collected_sentences) . "', " .
							"tree_task_completed = " . (($this->tree_task_completed) ? '1' : '0') . ", " .
							"phon_power = " . (($this->linguistic_powers['phon']) ? '1' : '0') . ", " .
							"morph_power = " . (($this->linguistic_powers['morph']) ? '1' : '0') . ", " .
							"syn_power = " . (($this->linguistic_powers['syn']) ? '1' : '0') . ", " .
							"phon_seen_items = '" . implode(',', $this->seen_items['phon']) . "', " .
							"morph_seen_items = '" . implode(',', $this->seen_items['morph']) . "', " .
							"syn_seen_items = '" . implode(',', $this->seen_items['syn']) . "', " .
							"phon_seen_mc_questions = '" . implode(',', $this->seen_mc_questions['phon']) . "', " .
							"morph_seen_mc_questions = '" . implode(',', $this->seen_mc_questions['morph']) . "', " .
							"syn_seen_mc_questions = '" . implode(',', $this->seen_mc_questions['syn']) . "', " .
							"everything_completed = '" . (($this->everything_completed) ? '1' : '0') . "' " .
							"WHERE user_ID = " . $this->user_ID;

			if ($my_db_object->query($update_query) !== false) {
				return true;
			}
			else {
				echo 'Database error: ' . $my_db_object->error;
				return false;
			}
		} // function saveCurrentState()

	} // class User



?>