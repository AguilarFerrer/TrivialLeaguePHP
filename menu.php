<?php
    include ('./includes/headerlogin.html');
    require ('./SQL/mysqli_connect.php');

    if(isset($_COOKIE['GAMES'])){

        if (count($_COOKIE['GAMES'])<=5){
            // array_push($_COOKIE['GAMES'], );
        }else{
            redirect('menu.php?error=1');
        }

    }else{
        // setcookie('GAMES', ['']);
    }

    if(isset($_REQUEST['error'])){
        $error = intval($_REQUEST['error']);
        // var_dump($error);exit();
    }

?>
    <div id="content">
        <?php 
            if(isset($error)){
                if($error == 1){
                    ?> 
                    <p>ERROR YA HAS PASADO LOS 5 JUEGOS</p>
                    <?php
                }
            }
        ?>
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