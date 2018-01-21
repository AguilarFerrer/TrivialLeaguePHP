<style>
h1 {
    text-align:center;
}
table {
    text-align: center;    
}  
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}    
</style>
<?php
    require("./SQL/mysqli_connect.php");
    include('./includes/headerlogin.html');
?>
<div class="row">
<?php
    $q = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID ORDER BY Points DESC LIMIT 20";
    $r = @mysqli_query ($dbc, $q);
    $txt= '<table><tr><th>Position</th><th>Name</th><th>Points</th><th>Correct Questions</th>';
    $row= mysqli_fetch_row($r);
    $int=1;
    while(!empty($row)) {
        $txt = $txt . '<tr>
        <td>' . $int . '</td>
        <td>' . $row[0] . '</td>
        <td>' . $row[2] . '</td>
        <td>' . $row[1] . '</td>
    </tr>';
        $row = mysqli_fetch_row($r);
        $int++;
    }
    echo '
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Global Ranking</h1> 
                
        ';
                
    echo $txt . '</table></div>';
    
    $cookie = $_COOKIE['ID'];
    $u = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID WHERE UserID=$cookie ORDER BY Points DESC LIMIT 20";
    $r = @mysqli_query ($dbc, $u);
    $txt= '<table><tr><th>Name</th><th>Points<th>Correct Questions</th>';
    $row= mysqli_fetch_row($r);
    $int=1;
    while(!empty($row)) {
        $txt = $txt . '<tr>
        <td>' . $row[0] . '</td>
        <td>' . $row[2] . '</td>
        <td>' . $row[1] . '</td>
    </tr>
    
    ';
        $row = mysqli_fetch_row($r);
        $int++;
    }
    echo '<div class="col-md-6">
    <h1>My Records</h1>';
    echo $txt . '</table></div>
    </div>
        </div>';
        
?>
</div>
