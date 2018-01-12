<?php

    require("./mysqli_connect.php");
    include('./includes/header.html');
    
    $q = "SELECT S.Name, R.Correct, R.Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID ORDER BY Points DESC";
    $r = @mysqli_query ($dbc, $q);
         $row = mysqli_fetch_row($r);
    while(!empty($row)) {
        
    echo $row['R.Correct'];
         $row = mysqli_fetch_row($r);
}
        
    

?>

<html>


</html>

<?php
    include ('./includes/footer.html');
?>

/*while ($row = mysqli_fetch_row($res)) {
    echo $row['categoryID'];
}
