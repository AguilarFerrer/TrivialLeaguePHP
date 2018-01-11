<?php
    require('./SQL/mysqli_connect.php');
    include('./includes/headerlogin.html');

    $txt = '';

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        
    }
        //if error de seleccion preguntas
        $last = 0;
        $log = false;
        $random1 = rand(1, 15);
        $random2 = rand(1, 5);
        while($log == false) {
            $q = "SELECT QuestionID, Question, AnsCorrect, AnsA, AnsB, AnsC  FROM Questions WHERE TopicQuestion=$random1 AND Topic=$random2";
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                //mirar si es = a la ultima pregunta.
                $question = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
                //guardar el valor de question ultima ID
                $q = "SELECT Name, Image  FROM Topics WHERE TopicID=$random2";
                $r = @mysqli_query ($dbc, $q);
                if (mysqli_num_rows($r) == 1) { 
                    $topic = mysqli_fetch_array ($r, MYSQLI_ASSOC);
                    mysqli_close($dbc);
                    $log = true; 
                }
            }
            else{
                $random1 = rand(1, 15);
                $random2 = rand(1, 5);
            }
        }
        
        $txt = $topic['Name'] . $question['Question'] . '<br>
            <form action="Game.php" method="post">
            <input type="radio" name="A" value="' . $question['AnsCorrect'] . '">' . $question['AnsCorrect'] . '<br>
            <input type="radio" name="B" value="' . $question['AnsA'] . '">' . $question['AnsA'] . '<br>
            <input type="radio" name="C" value="' . $question['AnsB'] . '">' . $question['AnsB'] . '<br>
            <input type="radio" name="D" value="' . $question['AnsC'] . '">' . $question['AnsC'] . '<br>
            <input type="submit" values="submit"
            </form>';
    
        echo $txt;

    include('./includes/footer.html');
?>

