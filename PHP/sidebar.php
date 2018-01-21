<style>
    .menu_tabs {
        background-color: <?php echo $_SESSION['MainColor'];?>;
    }
</style>
<div id="sidebar" class="box">
    <img style="width:10vw" src="<?php echo $_SESSION['AccountIMG'];?>">
    <h3>
        <?php
        //Show company name or individual name and surname.
            if (isset($_SESSION['BusinessName'])){
                echo $_SESSION['BusinessName'];
            }
            else {
                echo $_SESSION['IndividualName'] . " " . $_SESSION['IndividualSurname'];
            }
        ?>
    </h3>
    
    <div style="display:flex;flex-direction:column">
      <a class="menu_tabs" href="agenda.php">My appointments</a>
       <?php
            //Change content of the sidebar menu depending on what the user is (individual or company).
            if (isset($_SESSION['BusinessName'])){
                echo "<a class='menu_tabs' href='manage.php'>Requests <span id='notifications'></span></a>";  
            }
        ?>
        <a class="menu_tabs" href="company_search.php">Make an appointment</a>
        <a class="menu_tabs" href="settings.php">Settings</a>
    </div>
    <?php
        //If is business creates an script to check for requests via AJAX.
        if (isset($_SESSION['BusinessName'])){
            echo "<script>    
            AJAX_select('post','notify.php','data','',writeNotifications);
        </script>";
        }
    ?>
</div>