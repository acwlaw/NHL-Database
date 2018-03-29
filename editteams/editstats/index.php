<html>
<head>
<title></title>
</head>
<body>

<style>
.stats-field {
    width: 60px;
}
</style>

<?php

if (!isset($type)) {
    echo '<a href="skater.php">Edit Skater Statistics</a><br>
        <a href="goalie.php">Edit Goalie Statistics</a><br>
        <a href="team.php">Edit Team Statistics</a><br>';
} else {
    require_once('../../../mysqli_connect.php');

    $columns = array(
        "skater" => array(
            "name", "year", "PIM", "points", "assist", "goals", "SOG", "plusminus"
        ),
        "goalie" => array(
            "name", "year", "win", "loss", "tie", "GAA", "saving_percent", "SO"
        ),
        "team" => array(
            "team_name", "year", "win", "loss", "goals_for", "goals_against"
        )
    );

    $order = array("skater" => "points", "goalie" => "win", "team" => "win");

    // QUERY
    $query = 'SELECT';
    foreach ($columns[$type] as $i => $column) {
        $query = $i == 0 ? $query.' '.$column : $query.', '.$column;
    }
    $query = $query.' FROM '.$type.'_statistic ORDER BY '.$order[$type];
    $response = @mysqli_query($dbc, $query);

    if($response){
        // CREATE DATA ARRAY
        $headings = array();
        $data = array();
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
        $headings[] = "delete";
        /*
        [Wayne Gretzky] => Array
            (
                [1982] => Array
                    (
                        [win] => 1
                        [loss] => 1
                    )
                [1983] => Array(...)
            )
        */
    
        function checkConstraint($key, $value) {
            switch ($key) {
                case "plusminus": return true;
                case "saving_percent": return $value >= 0 && $value <= 1;
                default: return $value >= 0;
            }
        }
        
        function incrementAmount($key) {
            if ($key == 'saving_percent') {
                return 0.001;
            } else if ($key == 'GAA') {
                return 0.01;
            } else {
                return 1;
            }
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
            'assist' => 'Assist',
            'goals' => 'Goals',
            'SOG' => 'SOG',
            'plusminus' => '+/-',
            'team_name' => 'Team',
            'goals_for' => 'Goals For',
            'goals_against' => 'Goals Against',
            'delete' => 'Delete'
        );
        
        // IF DATA IS SUBMITTED
        if (isset($_POST['submit'])) {
            $errors = array();
            $fail = false;
            foreach ($_POST['data'] as $name => $namedata) {
                foreach ($namedata as $year => $yeardata) {
                    foreach ($yeardata as $key => $value) {
                        // IF VALUE HAS CHANGED
                        if ($value != $data[$name][$year][$key]) {
                            if (checkConstraint($key, $value)) {
                                $query = 'UPDATE '.$type.'_statistic SET '.$key.' = '.$value.' WHERE '.$columns[$type][0].' = "'.$name.'" AND year = '.$year;
                                
                                $stmt = mysqli_prepare($dbc, $query);
                                mysqli_stmt_execute($stmt);
                                $affected_rows = mysqli_stmt_affected_rows($stmt);
                                
                                if ($affected_rows == 1){
                                } else {
                                    echo 'Unknown Error Occurred<br />';
                                    //echo mysqli_error();
                                    $fail = true;
                                }
                            } else {
                                $errors[] = $name.' &raquo; '.$year.' &raquo; '.$formatted[$key].': '.$value.' is not a valid input.';
                                $_POST['data'][$name][$year][$key] = $data[$name][$year][$key];
                            }
                        }
                    }
                }
            }
            if (!empty($errors)) {
                foreach ($errors as $i => $message) {
                    echo 'Error: '.$message.'<br>';
                }
            } else {
                echo 'Success!<br>';
            }
            echo '<br><a href="">Return</a>';
        } else {
        
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
                        } else if ($key == "points") {
                            echo '<td class="'.$key.' edit">'.$value.'<input class="stats-field" type="hidden" name="data['.$name.']['.$year.']['.$key.']" value="'.$value.'"></td>
                            ';
                        } else {
                            echo '<td class="'.$key.' edit"><input class="stats-field" type="number" step="'.incrementAmount($key).'" name="data['.$name.']['.$year.']['.$key.']" value="'.$value.'"></td>
                            ';
                        }
                    }
                // DELETE
                echo '<td class="delete"><input type="checkbox" name="delete['.$name.']" value="true"></td>';
                echo '</tr>
                ';
                }
            }
            
            // END TABLE AND FORM
            echo '</table><input type="submit" name="submit" value="submit"><input type="hidden" name="type" value="'.$type.'"></form>';
        }
    } else {
        echo "Couldn't issue database query<br />";
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
}
?>

<script>
document.title = "Edit<?php echo isset($type) ? ' '.ucfirst($type) : '';?> Statistics"
</script>

</body>
</html>
