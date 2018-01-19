
<?php
    require("./SQL/mysqli_connect.php");
    include('./includes/header.html');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $txt="";
        if (empty($_POST["User"]) || empty($_POST["Pass"])){
            $txt = 'You must introduce an user name and a password';
        }
        else{
            $user = trim($_POST["User"]);
            $pass = trim($_POST["Pass"]);
            $patternU = '/^[A-z]{3,}$/';
            $patternP = '/^[0-z]{4,}$/';
            $log = false;
            $prof = 0;
            
            //
            if( empty($_POST["Professor"]) ) { 
                $prof = 1;
            }
            if($_POST["User"]==$_POST["Pass"]){
                $txt = 'User and Password cant be the same';
            }
            if(preg_match($patternU, $user)){
                if(preg_match($patternP, $pass)){
                    $q = "SELECT UserID, Name FROM Users WHERE Name='$user'";
                    $r = @mysqli_query ($dbc, $q);
                    if (!mysqli_num_rows($r) == 1) {
                        $q = "INSERT INTO `users`(`Name`, `Password`, `Category`) VALUES ('$user',SHA1('$pass'),$prof)";
                        @mysqli_query ($dbc, $q);
                        $txt = 'Succesful register';
                    }
                    else{
                        $txt = 'The User Already exist';
                    }
                }
                else{
                   $txt = 'The password must only contain alfa-numerical characters.';
                }
            }
            else{
                $txt = 'The User must only contain alphabetical characters.';
            }
            if ($log == true){
                require('./includes/redirect.php');
                redirect('./Login.php');
            }
        }
    }  
?>
<div id="content">
    <br>
    <form action="register.php" method="POST">
        User name: <input name="User" type="text" value="<?php if(isset($_POST['User'])){ echo $_POST['User'];}?>"/><br><br>
        Password: <input name="Pass" type="password" value="<?php if(isset($_POST['Pass'])){ echo $_POST['Pass'];}?>"/><br><br>
        <input type="checkbox" name="Professor" value="Admin">I'm a Professor<br>
        <input type="submit" value="Register">
        <?php if(isset($txt)){ echo '<p class="error">' . $txt . '</p>'; } ?>
    </form>
</div>
<?php
    include ('./includes/footer.html');
?>