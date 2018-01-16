<?php
    include ('./includes/headerlogin.html');
    require ('./SQL/mysqli_connect.php');

?>
    <div id="content">
        <h1>Are you ready <?php if(isset($_COOKIE['Name'])){ echo $_COOKIE['Name'];} ?> ?</h1><br><br>
        <p> <?php
                if(isset($_COOKIE['ID'])){
                    $id = $_COOKIE['ID'];
                    $q = "SELECT GameID FROM Games WHERE UserID='$id'";
                    $r = @mysqli_query ($dbc, $q);
                    //working.....
                    $row= mysqli_fetch_row($r);
                    while(!empty($row)) {    
                        echo '<li><a href="">Login</a></li>';
                        $row = mysqli_fetch_row($r);
                    }
                    //:V   
                }
            ?></p>
    </div>
<?php
    include ('./includes/footer.html');
?>