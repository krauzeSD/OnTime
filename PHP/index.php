<?php 
    require_once('mysqli_connect.php');
    require_once('functions.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){   
        $login_result = check_login($dbc, $_POST['user_email'], $_POST['user_pass']);
        //If the login is succesful we send a value of true together with an array of data.
        if ($login_result[0]){
            session_start();    
            //If the logged user is representing a company.
            if (!is_null($login_result[1]['BusinessName'])){
                $query = "SELECT BusinessID, BusinessName, Email, Telephone, Sector FROM business WHERE BusinessName='" . $login_result[1]['BusinessName'] . "'";
                $result = @mysqli_query ($dbc, $query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                //We store all their company's information in SESSION:
                $_SESSION['BusinessID'] = $row['BusinessID'];
                $_SESSION['BusinessName'] = $row['BusinessName'];
                $_SESSION['BusinessEmail'] = $row['Email'];
                $_SESSION['BusinessTelephone'] = $row['Telephone'];
                $_SESSION['Sector'] = $row['Sector'];
            }
            //Anyhow we store the individual's information.
            $_SESSION['IndividualEmail'] = $login_result[1]['Email'];
            $_SESSION['IndividualName'] = $login_result[1]['Name'];
            $_SESSION['IndividualSurname'] = $login_result[1]['Surname'];
            $_SESSION['IndividualTelephone'] = $login_result[1]['Telephone'];
            //We also get the settings configuration
            $query = "SELECT AccountIMG, MainColor, SecondColor FROM settings WHERE UserEmail='". $login_result[1]['Email'] . "'";
            $result = @mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['AccountIMG'] = $row['AccountIMG'];
            $_SESSION['MainColor'] = $row['MainColor'];
            $_SESSION['SecondColor'] = $row['SecondColor'];
            //Finally we redirect to the main page.
            header('Location: main.php');
        }
        else {
            //If there are errors, we show them a report list.
            foreach($login_result[1] as $report){
                echo "- $report" . "<br>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
       <?php 
        if (isset($_SESSION['IndividualEmail'])){
            //If a user is logged in and tries to acces this page via changing the url we log them out.
            header('Location: logout.php');
        }
        else {
            include('header.php');
        }
        ?>  
    </head>
    <body>
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
        //Events for the identification flag (individual or company) and the register button.
        var flag = GetByID('flag');
        var registerButton =GetByID("registerButton");
        var individual = GetByID('individual');
        var company = GetByID('company');
        registerButton.onclick = function() {
            //If the register button is clicked we show the flag.
            flag.style.display = "flex";
        }
        window.onclick = function(event) {
            //If the user clicks outside of the flag we hide it.
            if (event.target == flag) {
                flag.style.display = "none";
            }
        }
        individual.onclick = function(){
            //The user identifies as an individual.
            window.location.href = "register.php?mode=individual";
        }
        company.onclick = function(){
            //The user identifies as a company.
            window.location.href = "register.php?mode=company";
        }
    </script>
</html>
