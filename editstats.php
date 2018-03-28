<html>
<head>

<?php

if (!isset($_POST['choice'])) {
    echo '<form method="post" action="">
        <select name="choice">
            <option value="skater">Skater Statistics</option>
            <option value="goalie">Goalie Statistics</option>
            <option value="team">Team Statistics</option>
        </select>
        <input name="choicesubmit" type="submit" value="Submit">
    </form>';
} else {
    $type = $_POST['choice'];
    require_once('../../mysqli_connect.php');

    $columns = array(
        "skater" => array(
            "name", "year", "PIM", "points", "assists", "goals", "SOG", "plusminus"
        ),
        "goalie" => array(
            "name", "year", "win", "loss", "tie", "GAA", "saving_percent", "SO"
        ),
        "team" => array(
            "team_name", "year", "win", "loss", "goals_for", "goals_against"
        )
    );

    $order = array("skater" => "points", "goalie" => "win", "team" => "win");

    // Create queries for the database
    $query = 'SELECT';
    foreach ($columns[$type] as $i => $column) {
        $query = $i == 0 ? $query.' '.$column : $query.', '.$column;
    }
    $query = $query.' FROM '.$type.'_statistic ORDER BY '.$order[$type];

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);

    // If the query executed properly proceed
    if($response){
        $data = array();
        $headings = array();
        while($row = mysqli_fetch_array($response)) {
            foreach ($row as $key => $value) {
                if (!is_int($key)) {
                    $headings[] = $key;
                    if ($key != $columns[$type][0] && $key != "year") {
                        $data[$row[$columns[$type][0]]][$row["year"]][$key] = $value;
                    }
                }
            }
        }
        $headings = array_unique($headings);
        /*
        [Roberto Luongo] => Array
            (
                [1982] => Array
                    (
                        [win] => 1
                        [loss] => 1
                    )
                [1983] => Array(...)
            )
        */
        
        // IF DATA IS SUBMITTED
        if (isset($_POST['submit'])) {
            foreach ($_POST['data'] as $name => $namedata) {
                foreach ($namedata as $year => $yeardata) {
                    foreach ($yeardata as $key => $value) {
                        if ($value != $data[$name][$year][$key]) {
                            $query = 'UPDATE '.$type.'_statistic SET '.$key.' = '.$value.' WHERE '.$columns[$type][0].' = "'.$name.'" AND year = '.$year;
                            
                            $stmt = mysqli_prepare($dbc, $query);
                            mysqli_stmt_execute($stmt);
                            $affected_rows = mysqli_stmt_affected_rows($stmt);

                            if ($affected_rows == 1){
                                echo 'Stat Entered';
                            } else {
                                echo 'Unknown Error Occurred<br />';
                                //echo mysqli_error();
                            }
                        }
                    }
                }
            }
            $data = $_POST['data'];
        }
        
        // PREPARE HEADINGS WITH DATABSE KEY => HEADING
        $formatted = array(
            'name' => 'Name',
            'year' => 'Year',
            'win' => 'Win',
            'loss' => 'Loss',
            'tie' => 'Tie',
            'GAA' => 'GAA',
            'saving_percent' => 'Sv%',
            'SO' => 'SO',
            'PIM' => 'PIM',
            'points' => 'Points',
            'assists' => 'Assists',
            'goals' => 'Goals',
            'SOG' => 'SOG',
            'plusminus' => '+/-',
            'team_name' => 'Team',
            'goals_for' => 'Goals For',
            'goals_against' => 'Goals Against'
        );
        
        // BEGIN FORM AND TABLE
        echo '<form action="" method="post">
        <table border="1" cellpadding="2" style="border: 1px solid black; border-collapse:collapse">
        <tr>';
        
        // HEADINGS
        foreach ($headings as $_ => $heading) {
            echo '<td><b>'.$formatted[$heading].'</b></td>';
        }
        
        // DATA
        echo '</tr>';
        foreach ($data as $name => $namedata) {
            foreach ($namedata as $year => $nameyeardata) {
                echo '<tr>
                <td class="'.$columns[$type][0].' noedit">'.$name.'</td>
                <td class="'.$year.' noedit">'.$year.'</td>
                ';
                foreach ($nameyeardata as $key => $value) {
                    if ($key == $columns[$type][0] || $key == "year") { // primary key
                        echo '<td class="'.$key.' noedit">'.$value.'</td>
                        ';
                    } else {
                        echo '<td class="'.$key.' edit"><input class="stats-field" type="number" name="data['.$name.']['.$year.']['.$key.']" value="'.$value.'"></td>
                        ';
                    }
                }
                echo '</tr>
                ';
            }
        }
        
        // END TABLE AND FORM
        echo '</table><input type="submit" name="submit" value="submit"></form>';
    } else {
        echo "Couldn't issue database query<br />";
        echo mysqli_error($dbc);
    }
}

?>
<title>Edit <?=ucfirst($type)?> Statistics</title>
</head>
<body>

<style>
.stats-field {
    width: 60px;
}
</style>
  
<? mysqli_close($dbc); ?>
</body>
</html>
