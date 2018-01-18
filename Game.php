<?php
    require('./SQL/mysqli_connect.php');
    include('./includes/headerlogin.html');

    $txt = '';
    $last= 0;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $last=$_POST['last'];
        if (!empty($_POST['ans'])){
            $q = "SELECT AnsCorrect  FROM Questions WHERE QuestionID=$last";
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                $correct = mysqli_fetch_array ($r, MYSQLI_ASSOC);
                if ($correct['AnsCorrect'] == $_POST['ans']){
                    $ID = $_COOKIE['ID'];
                    $game = $_GET['Game'];
                    $q = "UPDATE Ranks SET Correct=Correct + 1, Points=Points + 10 WHERE RankID = $ID AND GameID=$game";
                    $r = @mysqli_query ($dbc, $q);
                }
                else{
                    require ('./includes/redirect.php');
                    redirect('after.php?Question='. $last);
                }
            }
        }
        else{
            
        }
        
    }
        //if error de seleccion preguntas
        $log = false;
        
        while($log == false) {
            $random1 = rand(1, 15);
            $random2 = rand(1, 5);
            $q = "SELECT QuestionID, Question, AnsCorrect, AnsA, AnsB, AnsC  FROM Questions WHERE TopicQuestion=$random1 AND Topic=$random2";
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                $question = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
                if($last != $question['QuestionID']){
                    $last = $question['QuestionID'];
                    $q = "SELECT Name, Image  FROM Topics WHERE TopicID=$random2";
                    $r = @mysqli_query ($dbc, $q);
                    if (mysqli_num_rows($r) == 1) { 
                        $topic = mysqli_fetch_array ($r, MYSQLI_ASSOC);
                        $log = true; 
                    }
                }
            }
        }
        mysqli_close($dbc);
        $txt = '<div id="content"><h1><img src=' . $topic['Image'] . 'height="50" width="50">' . $topic['Name'] . '</h1><br><br>' . '
            <h2>' . $question['Question'] . '</h2>
            <p><form action="Game.php?Game=' . $_GET['Game'] . '" method="POST">
            <input type="radio" name="ans" value="' . $question['AnsCorrect'] . '">' . $question['AnsCorrect'] . '<br><br>
            <input type="radio" name="ans" value="' . $question['AnsA'] . '">' . $question['AnsA'] . '<br><br>
            <input type="radio" name="ans" value="' . $question['AnsB'] . '">' . $question['AnsB'] . '<br><br>
            <input type="radio" name="ans" value="' . $question['AnsC'] . '">' . $question['AnsC'] . '<br><br>
            <input type="hidden" name="last" value="' . $last . '">
            <input type="hidden" name0"Game" value="' . $_GET['Game'] . '">
            <input type="submit" values="submit">
            </form></p></div>';
        echo $txt;

    include('./includes/footer.html');
?>