<?php 
    session_start();
    include('header.php');
?>
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
    
    <script>
        $(document).ready(function(){
          $('#calendar').fullCalendar({
                events: {
                    url: 'get_events.php',
                    type: 'POST',
                    error: function(){
                        alert('There was an error fetching events.');
                    }
                },
                aspectRatio: 2,
                defaultView: 'listMonth'
          })
        });
    </script>
</head>
<body>
    <div class="main_container">
        <?php include('sidebar.php'); ?>
        <div id="calendar" style="width:60vw;margin-right:auto;margin-top:5vh"></div>
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

