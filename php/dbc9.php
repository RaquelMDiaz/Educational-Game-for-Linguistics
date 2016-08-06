<?php
    $ip = '127.0.0.1';
    $port = "3306";
    $db_user = "raquelita";
    $DB = "c9";
    
    $my_db_object = new mysqli($ip, $db_user, '', $DB, $port);
  
    if ($my_db_object->connect_error) {
      die('Connection failed (' . $my_db_object->connect_errno . ') ' . $my_db_object->connect_error);
    }
    
    /**************************************************************************************************************************************************************/

    function prepare_string_for_db($my_string){
    /***********************************************************************************************
    takes a string as argument, 
    prepares that string for insertion into the database by: 
     - removing whitespaces & html tags, 
     - converting special characters into html entities, 
     - checking for magic quotes, 
     - escaping for use in SQL
    ***********************************************************************************************/
        if (isset($my_string) && is_string($my_string)) {
            global $my_db_object;
            
            $my_string = strip_tags(trim($my_string));
            $my_string = htmlentities($my_string, ENT_QUOTES|ENT_HTML5, "UTF-8", false); // syntax: htmlentities(string,flags,character-set,double_encode)
            
            /* If Magic Quotes are enabled, strip any backward slashes 
            from the string to prevent double escaping: */
            if (get_magic_quotes_gpc()) { // Magic Quotes are enabled.  
                $my_string = stripslashes($my_string);
            }
            
            $my_string = $my_db_object->real_escape_string($my_string);
            
            return $my_string;
        }
    }
    
    /**************************************************************************************************************************************************************/

?>