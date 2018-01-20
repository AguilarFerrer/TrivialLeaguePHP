
<?php
    //The header of the page.
    include('./includes/header.html');


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $txt="";
        if (empty($_POST["User"]) || empty($_POST["Pass"])){
                $txt = 'You must introduce an user name and a password';
        }
        else{
            //Now it checks that the User and Password are match the patterns.
            $user = trim($_POST["User"]);
            $pass = trim($_POST["Pass"]);
            $patternU = '/^[A-z]{3,}$/';
            $patternP = '/^[0-z]{4,}$/';
            if(preg_match($patternU, $user)){
                if(preg_match($patternP, $pass)){
                    //Conection to the SQL database.
                    require("./SQL/mysqli_connect.php");
                    //Query, this is looking on a user with same password and user name.
                    $q = "SELECT UserID, Name FROM Users WHERE Name='$user' AND Password=SHA1('$pass')";
                    //Execution of the query.
                    $r = @mysqli_query ($dbc, $q);
                    //Now if it was successful, the data will be introducen into a cookie.
                    if (mysqli_num_rows($r) == 1) { 
                        //The data obteined is inserted into an array to be used.
                        $data = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
                        //Close the connection to the database.
                        mysqli_close($dbc);
                        //The cookies for the user are created.
                        setcookie('ID' , $data['UserID']);
                        setcookie('Name' , $data['Name']);
                        //The user is redirected to the menu page.
                        require('./includes/redirect.php');
                        redirect('./menu.php');
                    }
                    else{
                        $txt = 'The Name or Password introduced are incorrect.';
                    }
                }
                else{
                   $txt = 'The password must only contain alfa-numeric characters.';
                }
            }
            else{
                $txt = 'The user name must be at least 3 characters long and only have letters.';
            }
        }
    }
?>
<div id="content">
    <br>
    <form action="Login.php" method="POST">
        User name: <input name="User" type="text" value="<?php if(isset($_POST['User'])){ echo $_POST['User'];}?>"/><br><br>
        Password: <input name="Pass" type="password" value="<?php if(isset($_POST['Pass'])){ echo $_POST['Pass'];}?>"/><br><br>
        <input type="submit" value="Submit">  <?php
            //If the user miss one time the password or user, this link will appear to change the password.
            if(isset($_POST['User'])){
                echo '<a href="edit.php?user='. $_POST['User'] .'">Have you forgot the password?</a>';
            }
        ?>
        <?php 
            //Here will apear all error messages.
            if(isset($txt)){ echo '<p class="error">' . $txt . '</p>'; } 
        ?>
    </form>
</div>

<?php
    //The footer of the page.
    include ('./includes/footer.html');
?>