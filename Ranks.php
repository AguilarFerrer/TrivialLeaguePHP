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
    //This query will get up to 20 ranks ordered form the higest puntuation.
    $q = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID ORDER BY Points DESC LIMIT 20";
    $r = @mysqli_query ($dbc, $q);
    //Crated the table for Global ranks.
    $txt= '<table class="table table-hover text-centered"><tr><th>Position</th><th>Name</th><th>Points</th><th>Correct Questions</th>';
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
    //Print the table.
    echo '
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Global Ranking</h1>';          
    echo $txt . '</table></div>';
    
    //Now using the player ID will get his top 20 ranking puntuations.
    $cookie = $_COOKIE['ID'];
    //this gets the user puntuation.
    $u = "SELECT Name, Correct, Points FROM Ranks AS R INNER JOIN Users AS S ON S.UserID = R.RankID WHERE UserID=$cookie ORDER BY Points DESC LIMIT 20";
    $r = @mysqli_query ($dbc, $u);
    //Now is generated the table for User ranks.
    $txt= '<table class="table table-hover text-centered"><tr><th>Name</th><th>Points<th>Correct Questions</th>';
    $row= mysqli_fetch_row($r);
    $int=1;
    while(!empty($row)) {
        $txt = $txt . '<tr>
        <td>' . $row[0] . '</td>
        <td>' . $row[2] . '</td>
        <td>' . $row[1] . '</td>
    </tr><br>
    
    ';
        $row = mysqli_fetch_row($r);
        $int++;
    }
    //Printed the table.
    echo '</div><div class="col-md-6">
    <h1>My Records</h1>';
    echo $txt . '</table></div>
    </div>
        </div>';
        
?>
</aside>
