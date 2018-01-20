<?php

    require("./SQL/mysqli_connect.php");
    include('./includes/header.html');
    $txt='';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        //Check if a password has been entered.
        if (!empty($_POST["password"])){
            //Verify that the password and verify fields are equal.
            if ($_POST["password"]==$_POST["check"]){
                //Check that the fields do not contain invalid characters.
                if(preg_match('/^[0-z]{4,}$/', $_POST["password"])){
                    $q = "SELECT UserID, Password FROM Users WHERE Name='" . $_POST['User'] . "'";
                    $r = @mysqli_query ($dbc, $q);
                    //Check if the user exists.
                    if (mysqli_num_rows($r)==1){
                        $user = mysqli_fetch_array($r, MYSQLI_ASSOC);
                        ////Check that it is not the same password that the user already has.
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
<div class="container">
    <h1 class="text-center">Change your password.</h1>

    
        <form action="edit.php" method="post">
            <div class="row">
                <div class='col-md-offset-5 col-md-2'>
                    <label for="pwd">User name:</label>
                    <input type="text" class="form-control" name="User" value="<?php if(isset($_POST["User"])){echo $_POST["User"];}
                                                            else { echo $_GET["user"]; } ?>">
                </div>
            </div>
            <div class="row">
                <div class='col-md-offset-5 col-md-2'>
                    <label for="pwd">New password:</label>
                    <input type="password" name="password"  class="form-control"><br>
                </div>
            </div>
            <div class="row">
                <div class='col-md-offset-5 col-md-2'>
                    <label for="pwd">Confirm password:</label>
                    <input type="password" name="check" class="form-control"><br>
                </div>
            </div>
            <input type="submit" class="btn btn-success center-block" name="submit" value="Change password">
        </form><br>
    <p class="error"><?php echo $txt; ?></p>
</div>