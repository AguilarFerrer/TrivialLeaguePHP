<?php
    include ('./includes/headermenu.html');
    require ('./SQL/mysqli_connect.php');



        if (isset($_GET['GAMES'])){
            ?><p>Your game ID is</p> <?php $_GET['GAMES']

            }else{
            redirect('menu.php?error=1');
        }

    }else{
      
    }

    if(isset($_GET['error'])){
        $error = intval($_REQUEST['error']);
       
    }

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
                        echo '<li><a href="Game.php?Game=' . $row[GameID] . '">Game with id '.$row[GameID]   ' </a></li>';
                        $row = mysqli_fetch_row($r);
                    }    <?php 
            if(isset($_GET['error'])){
                if($_GET['error'] == 1){
                    ?> 
                    <p><class='error'> ERROR YA HAS PASADO LOS 5 JUEGOS</p>
                }
            ?></p>
    </div>
<?php
    include ('./includes/footer.html');
?>