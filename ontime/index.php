<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="ontime.css">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
        <title>OnTime</title>
        <script src="utilities.js"></script>
    </head>
    <body>
        <?php include('header.php')?>
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
                        <input class="inputText" type="text" placeholder="Email">
                    <br>
                        <input class="inputText" type="password" placeholder="Password">
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