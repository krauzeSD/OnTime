<?php
    session_start();
    require_once('mysqli_connect.php');
    include('header.php');
?>
<script>
    //Creates a flag with a calendar and the name of the company.
    function askAppoint(companyName){
        CreateFlag('calendar', companyName);
    }
    //Event to hide the flag if the user clicks outside of it.
    window.onclick = function(event) {
        var flag = GetByID('flag');
        if(flag){
            if (event.target == flag) {
                flag.style.display = "none";
            }
        }                
    }
</script>
    <div style="display:flex; justify-content:center">
        <?php include('sidebar.php');?>
        <div id="result_company">
            <?php  
                // Search with a pattern or not
                if (isset($_POST['pattern'])){
                    $pattern = $_POST['pattern'];
                }
                else {
                    $pattern = "";
                }
                $query = "SELECT BusinessName, Sector FROM business WHERE BusinessName LIKE '%$pattern%' OR Sector LIKE '%$pattern%'";
                $result = @mysqli_query($dbc, $query);
                
                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        // Creates a company box structure for each company found.
                        echo "
                        <div class='company_box' onclick=askAppoint(" . "'" . $row['BusinessName'] . "') >
                            <div>
                                <h3 style='margin: 1vw 0vw 0vw 1vw'>" . $row['BusinessName'] . "</h3>
                                <br>
                                <h4 style='margin: 0vw 0vw 0vw 1vw'>Description of the company</h4>
                            </div>
                                <h4 style='margin-left: 100vh; margin-top: 0'>" . $row['Sector'] . "</h4>
                        </div>";
                        
                    }
                } 
            ?>
        </div>
   
  </div>
