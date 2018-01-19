<?php

    require("./SQL/mysqli_connect.php");
    include('./includes/header.html');
    $txt='';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (!empty($_POST["password"])){
            if ($_POST["password"]==$_POST["check"]){
                if(preg_match('/^[0-z]{4,}$/', $_POST["password"])){
                    $q = "SELECT UserID, Password FROM Users WHERE Name='" . $_POST['User'] . "'";
                    $r = @mysqli_query ($dbc, $q);
                    if (mysqli_num_rows($r)==1){
                        $user = mysqli_fetch_array($r, MYSQLI_ASSOC);
                        if ($user['Password']!=sha1($_POST['password'])){
                            $password = sha1($_POST["password"]);
                            $usertest = $user["UserID"];
                            $q = "UPDATE Users SET Password='$password' WHERE UserID='$usertest'";
                            $r = @mysqli_query ($dbc, $q);
                            if ($r){
                                $txt="The password has been changed succesfully.";
                            }
                            else {
                                $txt="The password can not be change.";
                            }
                        }
                        else {
                            $txt = "The password is the same as before.";
                        }
                    }
                    else {
                        $txt = "Invalid user.";
                    }  
                }
            
            else {
                $txt = 'The password must only contain alfa-numeric characters.';
            }
        }
        else{
            $txt='The password does not match.';
        }
    }
        else{
            $txt= "You must insert a password.";
        }
    }
?>
<div id="content">
    <br>
    <h1>Change your password.</h1><br>
        <form action="edit.php" method="post">
            User name: <input type="text" name="User" value="<?php if(isset($_POST["User"])){echo $_POST["User"];}
                                                        else { echo $_GET["user"]; } ?>"><br>
            New password: <input type="password" name="password" value=""><br>
            Confirm password: <input type="password" name="check" value=""><br>
            <input type="submit" name="submit" value="Change password">
        </form><br>
    <p class="error"><?php echo $txt; ?></p>
</div>

<?php
    include ('./includes/footer.html');
?>