<!DOCTYPE html>
<html>
    <head>
        <?php 
        session_start();
        if (isset($_SESSION['IndividualEmail'])){
            header('Location: logout.php');
        }
        else {
            include('header.php');
        }
        ?>
    </head>
    <body>
        <?php 
            require_once('mysqli_connect.php');
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
                   
                    $query = "SELECT Name, Surname, Email, BusinessID FROM individuals WHERE Email='$escaped_email' AND EncryptedPassword=SHA1('$escaped_pass')";      
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
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $login_result = check_login($dbc, $_POST['user_email'], $_POST['user_pass']);
                
                if ($login_result[0]){
                    session_start();
                    
                    if (!is_null($login_result[1]['BusinessID'])){
                        $query = "SELECT BusinessID, BusinessName, Email, Telephone, Sector FROM business WHERE BusinessID=" . $login_result[1]['BusinessID'];
                        $result = @mysqli_query ($dbc, $query);
                        $row = mysqli_fetch_array($result, MYSQL_ASSOC);
                        $_SESSION['BusinessID'] = $row['BusinessID'];
                        $_SESSION['BusinessName'] = $row['BusinessName'];
                        $_SESSION['BusinessEmail'] = $row['BusinessEmail'];
                        $_SESSION['BusinessTelephone'] = $row['BusinessTelephone'];
                        $_SESSION['Sector'] = $row['Sector'];
                    } 
                    $_SESSION['IndividualEmail'] = $login_result[1]['Email'];
                    $_SESSION['IndividualName'] = $login_result[1]['Name'];
                    $_SESSION['IndividualSurname'] = $login_result[1]['Surname'];
                    $_SESSION['IndividualTelephone'] = $login_result[1]['Telephone'];
                    //get settings
                    $query = "SELECT AccountIMG, MainColor, SecondColor FROM settings WHERE UserEmail='". $login_result[1]['Email'] . "'";
                    $result = @mysqli_query($dbc, $query);
                    $row = mysqli_fetch_array($result, MYSQL_ASSOC);
                    $_SESSION['AccountIMG'] = $row['AccountIMG'];
                    $_SESSION['MainColor'] = $row['MainColor'];
                    $_SESSION['SecondColor'] = $row['SecondColor'];
                    header('Location: main.php');
                }
                else {
                    foreach($login_result[1] as $report){
                        echo "- $report" . "<br>";
                    }
                }
            }
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
                <form method="post">
                    <div>
                        <input name="user_email" class="input text" type="text" placeholder="Email" value="<?php if (isset($_POST['user_email'])){echo $_POST['user_email'];}?>">
                    <br>
                        <input name="user_pass" class="input text" type="password" placeholder="Password">
                    </div>
                    <br>                  
                    <div id="submits">
                        <input class="button" type="submit" value="Login">
                        <input id="registerButton" type="button" class="button" value="Register">
                    </div>
                </form>
            </div>
        </div>
        <?php include('footer.php'); ?>
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
