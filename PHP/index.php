<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include('header.php')?>
        <link rel="stylesheet" href="ontime.css">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
        <title>OnTime</title>
        <script src="utilities.js"></script>
    </head>
    <body>
        <?php 
            function check_login($dbc, $email = '', $pass = '') {
    $errors = array(); // Initialize error array.
    // Validate the email address:
    if (empty($email)) {
        $errors[] = 'Please, enter your email address';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }
    // Validate the password:
    if (empty($pass)) {
        $errors[] = 'Please, enter your password.';
    } else {
        $p = mysqli_real_escape_string($dbc, trim($pass));
    }
    //Validate if in the DB the BusinessID field is Null or not:
    if (is_null($BussID)){
        // enter as Individual 
    } else {
        // enter as Business
    }
    if (empty($errors)) { // If everything's OK.
        // Retrieve the Name and Surname for that email/password combination:
        $q = "SELECT Name, Surname, BusinessID FROM Individuals WHERE Email='$e' AND EncryptedPassword=SHA1('$p') AND BusinessID='$BussID'";      
        $r = @mysqli_query ($dbc, $q); // Run the query.
        
        // Check the result:
        if (mysqli_num_rows($r) == 1) {
            // Fetch the record:
            $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
    
            // Return true and the record:
            return array(true, $row);
            
        } else { // Not a match!
            $errors[] = 'The email address and password entered do not match those on file.';
        }
        
    } // End of empty($errors) IF.
    
    // Return false and the errors:
    return array(false, $errors);
} // End of check_login() function.
        ?>
        <div id="entry_container">
            <div id="about" class="box">
                <span class="title">What is OnTime?</span>
                <p>Every now and then everyone has to make an appointment with a professional like, for example, a dentist or hairdresser.
                In these cases, many of us can't spend the time in going to the establishment in person and, even if we can contact with
                the business by telephone, we will need to make each appointment separately which will cost us time.
                </p>
                <p>And that's why we created OnTime: a place where individuals and business contact each other in a fast and easy way. By creating
                your own appointment calendar, you will be able to make requests for appointments in a matter of clicks and, if you are representing 
                a company, you can manage your company's requests and decide which hours to appoint.</p>
                <a href="about.html">Discover more</a>
            </div>
            <div id="login" class="box">
               <span class="title">OnTime</span>
                <form>
                    <div>
                        <input class="input text" type="text" placeholder="Email">
                    <br>
                        <input class="input text" type="password" placeholder="Password">
                    </div>
                    <br>                  
                    <div id="submits">
                        <input class="button" type="submit" value="Login">
                        <input id="registerButton" type="button" class="button" value="Register">
                    </div>
                </form>
            </div>
        </div>
        <?php include('footer.html'); ?>
        <div id="flag" class="modal">
            <div class="modal-content">
                <div id="individual" class="box">I'm an individual</div>
                <div id="company" class="box">I represent a company</div>
            </div>
        </div>
    </body>
    <script>
        var flag = GetByID('flag');
        var registerButton =GetByID("registerButton");
        var individual = GetByID('individual');
        var company = GetByID('company');
        registerButton.onclick = function() {
            flag.style.display = "flex";
        }
        window.onclick = function(event) {
            if (event.target == flag) {
                flag.style.display = "none";
            }
        }
        individual.onclick = function(){
            window.location.href = "register.php?mode=individual";
        }
        company.onclick = function(){
            window.location.href = "register.php?mode=company";
        }
    </script>
</html>
