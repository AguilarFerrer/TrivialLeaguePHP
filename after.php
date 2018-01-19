<?php
    include('./includes/headerlogin.html');
    require('./SQL/mysqli_connect.php');
    $q = "SELECT Question, AnsCorrect  FROM Questions WHERE QuestionID=". $_GET['Question'] ."";
    $r = @mysqli_query($dbc, $q);
    $question = mysqli_fetch_array($r);
    $q = "DELETE FROM Games WHERE GameID=". $_GET["Game"] . " AND UserID=" . $_COOKIE['ID'];
    $r = @mysqli_query($dbc, $q);
?>
    <div id="content">
        <h1>You have answered incorrectly the last question.</h1><br>
        <h3><?php echo $question['Question']?></h3>
        <p>Correct answer is:</p>
        <p class="error"><?php echo $question['AnsCorrect']?></p>
    </div>
<?php
    include('./includes/footer.html');
?>