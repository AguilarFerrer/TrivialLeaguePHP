<?php
    include ('./includes/headerlogin.html');
    
    require("./SQL/mysqli_connect.php");
    $Name = $_COOKIE['Name'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $q = "DELETE FROM users WHERE Name = '$Name'";
        $r = @mysqli_query ($dbc, $q);
        mysqli_close($dbc);
        require('./includes/redirect.php');
        redirect('./login.php');

    }
    
    
?>
<div class="container">
    <br>
    <form action="DeleteUser.php" method="POST">
        <h2 class="text-center">Are You Sure you Want to Delete Your User</h2>
        <h1 class="text-center">This change will be irreversible</h1>
        <input type="submit" class="btn btn-danger center-block" value="DeleteUser">
    </form>
</div>