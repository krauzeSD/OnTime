<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
      session_start();
      include('header.php');

        $file_name = "../IMG/ontime_logo.png";
        if(isset($_FILES['image'])){
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $value1 = $_POST['color1'];
        $value2 = $_POST['color2'];
        $file_ext=explode('.',$file_name);
        $ext = strtolower(array_pop($file_ext));   
        $extensions= array("jpeg","jpg","png","bmp","gif","tif");


        if(in_array($ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a BMP, GIF, TIF, JPG, JPEG or PNG file.";
        }

        
        if($file_size > 2097152) {
           $errors[]='File size must be excately 2 MB';
        }


        if(empty($errors)==true) {
        $file_name = "../IMG/".$file_name;
           move_uploaded_file($file_tmp, $file_name);
            require ('mysqli_connect.php');
            $query = "SELECT AccountIMG FROM individuals WHERE UserEmail='". $_SESSION['IndividualEmail'] ."'";
            $res = @mysqli_query ($dbc, $query);
            if ($res ==  NULL) {
              $errors[]='Select a file';
            }
            $sql = "UPDATE settings SET AccountIMG='" . $file_name . "', MainColor='". $value1 ."', SecondColor='".  $value2 ."' WHERE UserEmail='". $_SESSION['IndividualEmail'] ."'";  
            $r = @mysqli_query ($dbc, $sql); ?>


            <style>
            .alert {
                padding: 20px;
                background-color: #2C7F15;
                color: white;
            }

            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
            </style>
            <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong>DONE!</strong> Configuration has been succesful.
            </div>


<?php
         }

         else{
          ?>
                     <style>
            .alert {
                padding: 20px;
                background-color: #f44336;
                color: white;
            }

            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
            </style>
            <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong>ERROR!</strong> <?php print_r($errors);?>
            </div>

         <?php
         
      }
   }
 ?>
</head>
<body>

   <div class="main_container">
    <div id="sidebar" class="box">
        <img style="width:10vw" src="../IMG/<?php echo "$file_name"?>">
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
      <div class="box" id="calendar" style="width:60vw;margin-right:auto;margin-top:5vh;margin-left:auto">

     
     <form action="" method="POST" enctype="multipart/form-data" >
       <h1>Change your profile photo</h1>
      Upload your profile image: <input type="file" name="image"/>

      <h1>Change the Color</h1>
      Main Color: <select name="color1">
      <option value="#6060B9">Blue</option>
      <option value="#2C7F15">Green</option>
    </select>
    Second Color: <select name="color2">
      <option value="#FFFFFF">White</option>
      <option value="#B72424">Red</option>
    </select>
       <input type="submit" value="save"/>
    </form>
    </div>

  </div>


</body>
</html>
