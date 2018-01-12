<?php
    function InsertHistories($HistoryID, $QuestionID){
        require ('mysqli_connect.php');
        $q = "Insert INTO Trivial.histories(HistoryID,QuestionID) values ($HistoryID,$QuestionID)";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
    }
?>

<?php
    function Updatehistories($HistoryID, $questionID){
        require ('mysqli_connect.php');
        $q = "UPDATE Trivial.histories SET QuestionID=$questionID WHERE HistoryID=$HistoryID";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
    }
?>