<?php
//Checks a field for the register.
function check_field($db_connect, &$escape_array, &$errors_array, $field, $is_password = false, $pass2 = ""){
        $check = 0;
        if ($is_password){
            if (!empty($_POST[$field])) {
                //check if password1 = password2
                if ($_POST[$field] != $_POST[$pass2]) {
                    $errors_array[] = 'Passwords did not match';
                } 
                else {
                    $check++;
                }
            }
        }
        else {
            if (!empty($_POST[$field])){
                $check++;
            }
        }
        
        if ($check == 1){
            $escape_array[$field] = mysqli_real_escape_string($db_connect, trim($_POST[$field]));
            
        }
        else {
            $errors_array[] = 'Enter the ' . $field . '.';
        }
    }
//Deletes the last character of a string. We use it to take out the last comma in a query.
    function deleteLastChar($string){
                $result = substr($string, 0, strlen($string) - 1);
                return $result;
            }
//Does an insert ??????specifying?????? database, table, an array of fields and an associative array of values. 
    function insert(&$db_connect, $table, $fields, $values){
                //FIELDS
                $insert_string = "INSERT INTO " . $table . " (";
                foreach($fields as $item){
                    $insert_string = $insert_string . $item . ","; 
                }
                $insert_string = deleteLastChar($insert_string);
                $insert_string = $insert_string . ")"; 
                
                //VALUES
                $insert_string = $insert_string . "VALUES (";
                foreach($values as $key=>$value){
                    if ($key == 'Password1'){
                        $insert_string = $insert_string . "SHA1('" . $value . "'),";
                    }
                    else if ($key == 'Location'){
                        $insert_string = $insert_string . $value . ",";
                    }
                    else if (is_null($value)){
                        $insert_string = $insert_string . "NULL,";
                    }
                    else {
                        $insert_string = $insert_string . "'" . $value . "',";
                    }
                }
                $insert_string = deleteLastChar($insert_string);
                $insert_string = $insert_string . ")"; 
             
                $result = @mysqli_query($db_connect, $insert_string);
                
                return $result;
            }
//Checks the login
function check_login($dbc, $email = '', $pass = '') {
                $errors = array(); 
                if (empty($email)) {
                    $errors[] = 'Please, enter your email address';
                } else {
                    $escaped_email = mysqli_real_escape_string($dbc, trim($email));
                }
                // Validate the password:
                if (empty($pass)) {
                    $errors[] = 'Please, enter your password.';
                } else {
                    $escaped_pass = mysqli_real_escape_string($dbc, trim($pass));
                }
    
                if (empty($errors)) {
                   
                    $query = "SELECT Name, Surname, Email, Telephone, BusinessName FROM individuals WHERE Email='$escaped_email' AND EncryptedPassword=SHA1('$escaped_pass')";      
                    $result = @mysqli_query ($dbc, $query);
                    
                 
                    if (mysqli_num_rows($result) == 1) {
                       
                        $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
                      
                       
                        return array(true, $row);

                    } else {
                        $errors[] = 'Incorrect password or email. Please try again.';
                    }

                } 
                return array(false, $errors);
            } 
?>