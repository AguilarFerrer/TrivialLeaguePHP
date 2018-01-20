<style>
h1 { text-align:center; }
aside {
    display:flex;
    flex-flow:row wrap;
    align-content: center;
    align-items: center;
    justify-content:center;
    padding: 2%;
    widyh:100%;
}   
table {
    margin-right: 10%;
    text-align: center;    
}  
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td { padding: 15px; }
</style>

<?php
    require("./SQL/mysqli_connect.php");
    include('./includes/headerlogin.html');
?>
<aside>
<?php
    $q = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID ORDER BY Points DESC LIMIT 20";
    $r = @mysqli_query ($dbc, $q);
    $txt= '<p id="content"><table><tr><th>Position</th><th>Name</th><th>Points</th><th>Correct Questions</th>';
    $row= mysqli_fetch_row($r);
    $int=1;
    while(!empty($row)) {
        $txt = $txt . '<tr>
        <td>' . $int . '</td>
        <td>' . $row[0] . '</td>
        <td>' . $row[2] . '</td>
        <td>' . $row[1] . '</td>
    </tr><br>';
        $row = mysqli_fetch_row($r);
        $int++;
    }
    echo "<h1>Global Ranking</h1";
    echo $txt . '</table></p>';
    
    $cookie = $_COOKIE['ID'];
    $u = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID WHERE UserID=$cookie ORDER BY Points DESC LIMIT 20";
    $r = @mysqli_query ($dbc, $u);
    $txt= '<p id="content"> <table><tr><th>Name</th><th>Points<th>Correct Questions</th>';
    $row= mysqli_fetch_row($r);
    $int=1;
    while(!empty($row)) {
        $txt = $txt . '<tr>
        <td>' . $row[0] . '</td>
        <td>' . $row[2] . '</td>
        <td>' . $row[1] . '</td>
    </tr><br>';
        $row = mysqli_fetch_row($r);
        $int++;
    }
    echo "<h1>My Records</h1";
    echo $txt . '</table></p>';
        
?>
</aside>

<?php
    include ('./includes/footer.html');
?>
