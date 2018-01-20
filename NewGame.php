<?php
    //Here we open the connection to the database and the function redirect.
    require ('./SQL/mysqli_connect.php');
    require ('./includes/redirect.php');
    //Here the query is a select to obtein the number of games that the user have started.
    $q = "SELECT Count(GameID) AS Count FROM Games WHERE UserID=". $_COOKIE['ID'];
    //Executed the query.
    $r = @mysqli_query ($dbc, $q);
    //Now it obtein the data from the operation done before.
    $count = mysqli_fetch_array ($r, MYSQLI_ASSOC);
    //If the number of games active is 5, this will be redirected to the menu with an error code.
    if ($count['Count'] == 5){
        mysqli_close($dbc);
        redirect('Menu.php?error=1');
    }
    //If is less than 5, this will create a new game.
    else{
        // This query creates the new game inserting the UserID and creating the GameID.
        $q = "INSERT INTO Games (UserID) Values (" . $_COOKIE['ID'] . ")";
        //Executed the query.
        $r = @mysqli_query ($dbc, $q);
        //Now we obtein the GameID Created now by the last query.
        $q = "SELECT MAX(GameID) AS Max FROM Games WHERE UserID=" . $_COOKIE['ID'];
        //Executed the query.
        $r = @mysqli_query ($dbc, $q);
        //And created a variable with the GameID obteined.
        $GameID = mysqli_fetch_array ($r, MYSQLI_ASSOC);
        //Then insert into ranks the information obteined before. UserID, GameID and setting the points and correct answers to 0.
        $q = "INSERT INTO Ranks (RankID, GameID, Correct, Points) Values (" . $_COOKIE['ID'] . "," . $GameID['Max'] . ", 0, 0)";
        //Executed the query.
        $r = @mysqli_query ($dbc, $q);
        //Close the connection to the database.
        mysqli_close($dbc);
        //Redirect the user to the Game page with the GameID with get method.
        redirect('Game.php?Game=' . $GameID['Max']);
    }
?>
