<?php
    include ('./includes/headermenu.html');
?>
    <div class="container text-center">
        <h1 >Are you ready <?php if(isset($_COOKIE['Name'])){ echo $_COOKIE['Name'];} ?> ?</h1><br><br>
        <p> <?php
                //If the ID cookie is set, this will show the games that the user have started.
                if(isset($_COOKIE['ID'])){
                    $id = $_COOKIE['ID'];
                    //starts the conectio to the database.
                    require ('./SQL/mysqli_connect.php');
                    //the query looks to all the games that have the userID the same as the cookie ID.
                    $q = "SELECT GameID FROM Games WHERE UserID='$id'";
                    //Execution of the query.
                    $r = @mysqli_query ($dbc, $q);
                    //Closes the connection to the database.
                    mysqli_close($dbc);
                    /*Now this bucle will look for all the data got in the query and show it.
                    First line obteined form the select.*/
                    $txt='';
                    $row= mysqli_fetch_row($r);
                    //The while will end when the $row is empty.
                    while(!empty($row)) {    
                        //This is what will apear into the menu page.
                        $txt = $txt . '<li><a href="Game.php?Game=' . $row[0] . '">Game with id ' . $row[0] . '.</a></li>';
                        //Next row from the select done before.
                        $row = mysqli_fetch_row($r);
                    }
                if(!empty($txt)){
                    echo '<p>Continue Playing: </p><br>';
                }
                else{
                    echo '<p>Start a new game by clicking in the button "New Game". </p>';
                }
                echo $txt;
                //This is if the user have reached the max number of games active.
                if(isset($_GET['error']) && $_GET['error'] == 1 ){
                ?> 
                <p class="error">You have arrived to the max posible game opened at the same time.</p>
                <?php
                } 
            }
            ?></p>
    </div>

