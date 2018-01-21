<?php 
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors = array();
        $mainColor = $_POST['mainColor'];
        $secondColor = $_POST['secondColor'];
        if (isset($_POST['image'])){
            if ($_POST['image'] != ""){
                $file_name = $_POST['image'];
                $file_ext = explode('.', $file_name);
                $ext = strtolower(array_pop($file_ext));   
                $extensions= array("jpeg","jpg","png","bmp","gif","tif");


                if (!in_array($ext, $extensions)){
                    $errors[]="Extension not allowed, please choose a BMP, GIF, TIF, JPG, JPEG or PNG file.";
                }
            }
        }
        if (empty($errors)) {
            
            require ('mysqli_connect.php');
            $query = "SELECT AccountIMG, MainColor, SecondColor FROM settings WHERE UserEmail='". $_SESSION['IndividualEmail'] ."'";
            $res = @mysqli_query ($dbc, $query);
            
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            if (!isset($file_name)){
                $file_name = $row['AccountIMG'];
            }
            else {
                $file_name = "../IMG/" . $file_name;
            }
            if (!isset($mainColor)){
                $mainColor = $row['MainColor'];
            }
            if (!isset($secondColor)){
                $secondColor = $row['SecondColor'];
            }
            $sql = "UPDATE settings SET AccountIMG='" . mysqli_escape_string($dbc, $file_name) . "', MainColor='". $mainColor ."', SecondColor='".  $secondColor ."' WHERE UserEmail='". $_SESSION['IndividualEmail'] ."'";  
            $r = @mysqli_query ($dbc, $sql); 
            
            if ($r){
                if (isset($_FILES['image'])){
                    move_uploaded_file($_FILES["image"]["tmp_name"], $file_name);
                }
                $_SESSION['AccountIMG'] = $file_name;
                $_SESSION['MainColor'] = $mainColor;
                $_SESSION['SecondColor'] = $secondColor;
                $_SESSION['status'] = 'success';
            }
        }
        else {
                $_SESSION['status'] = 'error';
        }
    }
?>
<html lang="en">
    <head> 
        <style>
            .banner {
                padding: 20px;
                color: white;
            }
            .success {
                display: none;
                background-color: #2C7F15;
            }
            .error {
                display: none;
                background-color: red;
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
    </head>
    <body>
        <?php include('header.php'); ?>
        <div class="banner success" 
            <?php 
                if (isset($_SESSION['status'])){ 
                    if ($_SESSION['status'] == 'success') { 
                        echo "style='display:block'";
                    } 
                    else { 
                        echo "style='display:none'";
                    }
                }
                else {
                    echo "style='display:none'";
                }
            ?>>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong>DONE!</strong> Configuration has been successful.
        </div>
        <div class="banner error"
               <?php if (isset($_SESSION['status'])){ 
                if ($_SESSION['status'] == 'error') { 
                    echo "style='display:block'";
                } 
                else { 
                    echo "style='display:none'";
                }
             }
             else {
                 echo "style='display:none'";
             }?>>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong>ERROR!</strong> <?php if (isset($errors)){ foreach($errors as $item){ echo $item . "<br>";}};?>
        </div>
        <div style="display:flex">
            <?php include('sidebar.php'); ?>
            <div class="box" style="margin: auto">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h2>Change your profile picture</h2>
                    <div style="margin-left:5vw">
                        <span >Upload your profile image:</span>
                        <input type="file" name="image"/>
                    </div>

                    <h2>Change the Color</h2>
                    <div style="display:flex; flex-direction:column;margin-left:5vw">
                        <span>Main Color: <input style="margin-left:1.70vw" type="color" name="mainColor" value="<?php echo $_SESSION['MainColor']; ?>"></span>
                        <span>Second Color: <input type="color" name="secondColor" value="<?php echo $_SESSION['SecondColor']; ?>"></span>
                    </div>
                    
                    <input style="margin: 5vh 2.5vh 0 2.5vh;width:90%" type="submit" value="Save"/>
                </form>
            </div>
        </div>  
    </body>
</html>