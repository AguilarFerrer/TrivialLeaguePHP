<?php
    include ('./includes/headermenu.html');
    require ('./SQL/mysqli_connect.php');
?>
    <div id="content">
        <h1>Are you ready <?php if(isset($_COOKIE['Name'])){ echo $_COOKIE['Name'];} ?> ?</h1><br><br>
        <p> <?php
                if(isset($_COOKIE['ID'])){
                    $id = $_COOKIE['ID'];
                    $q = "SELECT GameID FROM Games WHERE UserID='$id'";
                    $r = @mysqli_query ($dbc, $q);
                    $row= mysqli_fetch_row($r);
                    while(!empty($row)) {    
                        echo '<li><a href="Game.php?Game=' . $row[0] . '">Game with id ' . $row[0] . '.</a></li>';
                        $row = mysqli_fetch_row($r);
                    }
                if(isset($_GET['error']) && $_GET['error'] == 1 ){
                ?> 
                <p class="error">You have arrived to the max posible game opened at the same time.</p>
                <?php
                } 
            }
            ?></p>
    </div>
<?php
    include ('./includes/footer.html');
?>
