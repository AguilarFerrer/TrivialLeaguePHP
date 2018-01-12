<?php
    function InsertRanks($RankID, $Correct,$Points){
        require ('mysqli_connect.php');
        $q = "Insert INTO Trivial.ranks(RankID,Correct,Points) values ($RankID, $Correct,$Points)";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
    }
?>

<?php
    function DeleteRanks($RankID){
        require ('mysqli_connect.php');
        $q = "DELETE FROM Trivial.ranks WHERE $RankID=RankID";
        $r = @mysqli_query($dbc,$q);
        mysqli_close($dbc);
    }
?>