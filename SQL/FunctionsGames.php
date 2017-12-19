<?php
    function UpdateGames($questionID, $gameID){
        require ('mysqli_connect.php');
        $q = "UPDATE Trivial.Games SET QuestionID=$questionID WHERE GameID=$gameID";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
    }

    function DeleteGame($GameID){
        require ('mysqli_connect.php');
        $q = "DELETE FROM Trivial.Games WHERE $GameID=GameID";
        $r = @mysqli_query($dbc,$q);
        mysqli_close($dbc);
    }
    
    function InsertGame ($UserID, $QuestionID, $HistoryID) {
        require ('mysqli_connect.php');
        $q = "INSERT INTO Trivial.Games (UserID, QuestionID, HistoryID) Values ($UserID, $QuestionID, $HistoryID)";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
    }
?>