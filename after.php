<?php
    include('./includes/headerlogin.html');
    //Starts the connection to the database.
    require('./SQL/mysqli_connect.php');
    //This query, obteins the question and the correct answer for the question with ID of the last question answered.
    $q = "SELECT Question, AnsCorrect  FROM Questions WHERE QuestionID=". $_GET['Question'] ."";
    //The query is executed and the data is introduced into a variable called question.
    $r = @mysqli_query($dbc, $q);
    $question = mysqli_fetch_array($r);
    //Now is Deleted the game that is finished (rank for this game is not touched).
    $q = "DELETE FROM Games WHERE GameID=". $_GET["Game"] . " AND UserID=" . $_COOKIE['ID'];
    $r = @mysqli_query($dbc, $q);
    //The connection to the database is closed and the last question is shown to the user.
    mysqli_close($dbc);
?>
    <div class="container">
        <h1>You have answered incorrectly the last question.</h1><br>
        <h3><?php echo $question['Question']?></h3>
        <p>Correct answer is:</p>
        <p class="label label-danger"><?php echo $question['AnsCorrect']?></p>
    </div>