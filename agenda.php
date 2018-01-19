<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../fullcalendar-3.8.0/fullcalendar.min.css">
    <link href="../fullcalendar-3.8.0/fullcalendar.print.min.css" rel="stylesheet" media="print">
    <script src="../fullcalendar-3.8.0/lib/moment.min.js"></script>
    <script src="../fullcalendar-3.8.0/lib/jquery.min.js"></script>
    <script src="../fullcalendar-3.8.0/fullcalendar.js"></script>
    <script src="../fullcalendar-3.8.0/locale-all.js"></script>
    <script src="../JS/flag.js"></script>
    <?php 
        session_start();
        include('header.php');
    ?>
    <script>
      
    $(document).ready(function(){
      $('#calendar').fullCalendar({
            timeFormat: 'H(:mm)',
                header: {
                    center: 'listWeek'
                },
                views: {
                  listWeek: {buttonText: 'My appointments'}
                },
                aspectRatio: 2,
                defaultView: 'listMonth'

      })
    });

    </script>
</head>
<body>
   <div class="main_container">
    <div id="sidebar" class="box">
        <img style="width:10vw" src="../IMG/ontime_logo.png">
        <h3>
            <?php
                echo $_SESSION['IndividualName'] . " " . $_SESSION['IndividualSurname'];
            ?>
            
        </h3>
        <div style="display:flex;flex-direction:column">
            <a class="menu_tabs" href="agenda.php">My appointments</a>
            <a class="menu_tabs" href="">Make an appointment</a>
            <a class="menu_tabs" href="">Settings</a>
        </div>
    </div>

   <div id="calendar" style="width:60vw;margin-right:auto;margin-top:5vh">
    
   </div>
   
    </div>
<script>
	window.onclick = function(event) {
        var flag = GetByID('flag');
        if(flag){
            if (event.target == flag) {
            	flag.style.display = "none";
            }
        }                
    }
    </script>
</body>
</html>

