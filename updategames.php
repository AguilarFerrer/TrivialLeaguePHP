<?php
    function UpdateGames($questionID, $gameID){
        require ('mysqli_connect.php');
        $q = "UPDATE Trivial.Games SET QuestionID=$questionID WHERE GameID=$gameID";
        $r = @mysqli_query($dbc, $q);
        mysqli_close($dbc);
    }

    UpdateGames (2, 1);
?>