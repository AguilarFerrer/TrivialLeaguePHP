<?php
    function DeleteGame($GameID){
        require ('mysqli_connect.php');
        $q = "DELETE FROM Trivial.Games WHERE $GameID=GameID";
        $r = @mysqli_query($dbc,$q);
        mysqli_close($dbc);
    }
DeleteGame(1);
?>