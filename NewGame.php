<?php
    require ('./SQL/mysqli_connect.php');
    require ('./includes/redirect.php');
    $ID = $_COOKIE['ID'];
    $q = "SELECT Count(GameID) AS Count FROM Games WHERE UserID=$ID";
    $r = @mysqli_query ($dbc, $q);
    $count = mysqli_fetch_array ($r, MYSQLI_ASSOC);
    if ($count['Count'] == 5){
        mysqli_close($dbc);
        redirect('Menu.php?error=1');
    }
    else{
        $q = "INSERT INTO Games (UserID) Values ($ID)";
        $r = @mysqli_query ($dbc, $q);
        $q = "SELECT MAX(GameID) AS Max FROM Games WHERE UserID=$ID";
        $r = @mysqli_query ($dbc, $q);
        $GameID = mysqli_fetch_array ($r, MYSQLI_ASSOC);
        $GameID = $GameID['Max'];
        $q = "INSERT INTO Ranks (RankID, GameID, Correct, Points) Values ($ID, $GameID, 0, 0)";
        $r = @mysqli_query ($dbc, $q);
        mysqli_close($dbc);
        redirect('Game.php?Game=' . $GameID);
    }
?>
