<?php
    include ('./includes/headerlogin.html');
    
    require("./SQL/mysqli_connect.php");
    $Name = $_COOKIE['Name'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $q = "DELETE FROM Users WHERE Name = '$Name'";
        $r = @mysqli_query ($dbc, $q);
        mysqli_close($dbc);
        
        require('./includes/redirect.php');
        redirect('./login.php');
    }
    
    
?>
<div id="content">
    <br>
    <form action="LogOut.php" method="POST">
        <h2>Are You Sure you Want to Delete Your User</h2>
        <h1>This change will be irreversible</h1>
        <input type="submit" value="DeleteUser">
    </form>
</div>
<?php
    include ('./includes/footer.html');
?>