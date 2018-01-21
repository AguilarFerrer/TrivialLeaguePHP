<?php
    //Conection to the database.
    require('./SQL/mysqli_connect.php');
    include('./includes/headerlogin.html');

    $txt = '';
    $last= 0;
    //If have filled the form.
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //This will setup the value of the last questionID.
        $last=$_POST['last'];
        //if the question is not selected it will skip the check.
        if (!empty($_POST['ans'])){
            //Query to get the correct answer.
            $q = "SELECT AnsCorrect  FROM Questions WHERE QuestionID=$last";
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                $correct = mysqli_fetch_array ($r, MYSQLI_ASSOC);
                //If is the same as the user have selected.
                if ($correct['AnsCorrect'] == $_POST['ans']){
                    $ID = $_COOKIE['ID'];
                    $game = $_GET['Game'];
                    //Here adds the points to the rank of the game.
                    $q = "UPDATE Ranks SET Correct=Correct + 1, Points=Points + 10 WHERE RankID = $ID AND GameID=$game";
                    $r = @mysqli_query ($dbc, $q);
                }
                //if he have failed the correct answer, it will redirect the user to after.php.
                else{
                    require ('./includes/redirect.php');
                    redirect('after.php?Game=' . $_GET['Game'] . '&Question='. $last);
                }
            }
        }
        else{
            
        }
        
    }
        //Now we will show the new question, it can't be the same as the last one.
        $log = false;
        
        while($log == false) {
            //Now we generate a 2 random numbers, one for the topic and one for the question inside the topic.
            $random1 = rand(1, 15);
            $random2 = rand(1, 5);
            //This query will get us the information of the question selected by the two random number generated before.
            $q = "SELECT QuestionID, Question, AnsCorrect, AnsA, AnsB, AnsC  FROM Questions WHERE TopicQuestion=$random1 AND Topic=$random2";
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                $question = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
                //This will look that this is not the same question as before.
                if($last != $question['QuestionID']){
                    //Set the new last questionID.
                    $last = $question['QuestionID'];
                    //Get the information from the Topics table.
                    $q = "SELECT Name, Image  FROM Topics WHERE TopicID=$random2";
                    $r = @mysqli_query ($dbc, $q);
                    if (mysqli_num_rows($r) == 1) { 
                        $topic = mysqli_fetch_array ($r, MYSQLI_ASSOC);
                        //Return true to exit form the while.
                        $log = true; 
                    }
                }
            }
        }
        //Now we introduce de data from the posible answers into the array and shuffle it.
        $Quest = array($question['AnsCorrect'],$question['AnsA'],$question['AnsB'],$question['AnsC']);
        shuffle($Quest);
        
        //close the connection with the database, create the form and display it.
        mysqli_close($dbc);
        $txt = '<div class="container">
        			<h1 class="text-center"><img src=' . $topic['Image'] . 'height="50" width="50">' . $topic['Name'] . '</h1><br>' . '
            		<h2 class="text-center">' . $question['Question'] . '</h2>
                    <form action="Game.php?Game=' . $_GET['Game'] . '" method="POST">
                    <div class="row">
           				<div class="col-md-offset-5 col-md-2">
            				<input type="radio" class="form-check" name="ans" value="' . $Quest[0] . '"> ' . $Quest[0] . '<br>
           		 			<input type="radio" class="form-check" name="ans" value="' . $Quest[1] . '"> ' . $Quest[1] . '<br>
                        	<input type="radio" class="form-check" name="ans" value="' . $Quest[2] . '"> ' . $Quest[2] . '<br>
       						<input type="radio" class="form-check" name="ans" value="' . $Quest[3] . '"> ' . $Quest[3] . '<br><br>
                        </div>
                	</div>
          			<input type="hidden" name="last" value="' . $last . '">
            		<input type="hidden" name0"Game" value="' . $_GET['Game'] . '">
					<input type="submit" class="btn btn-success center-block" value="Check">
            		</form>
           		</div>';
        echo $txt;

?>
