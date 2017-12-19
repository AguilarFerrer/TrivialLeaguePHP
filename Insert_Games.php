<?php

function InsertGame ($UserID, $QuestionID, $HistoryID) {
    require ('mysqli_connect.php');
    $q = "INSERT INTO Trivial.Games (UserID, QuestionID, HistoryID) Values ($UserID, $QuestionID, $HistoryID)";
    $r = @mysqli_query($dbc, $q);
    mysqli_close($dbc);
}

InsertGame (1,1,1)

?>