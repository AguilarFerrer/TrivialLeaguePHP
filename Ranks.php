
<?php
    require("./SQL/mysqli_connect.php");
    include('./includes/headerlogin.html');
    
    $q = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID ORDER BY Points DESC";
    $r = @mysqli_query ($dbc, $q);
    $row= mysqli_fetch_row($r);
    while(!empty($row)) {    
        echo $row[2] . '<br>';
        $row = mysqli_fetch_row($r);
    }
    
?>

<html>
 <table></table>
</html>

<?php
    include ('./includes/footer.html');
?>