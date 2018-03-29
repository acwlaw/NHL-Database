<html>
<head>
<title>Edit Players</title>
</head>
<body>

<?php
    if (!isset($type)) {
        echo '<a href="active.php">Edit Active Players</a><br>
        <a href="retired.php">Edit Retired Players</a><br>
        <a href="free_agent.php">Edit Free Agent Players</a><br>';
    } else {
        $connect = '../../../mysqli_connect.php';
        require_once($connect);

        /*$columns = array(
            "players" => array(
                "name", "position", "team"
            )
        );*/
        
        $otherKey = array(
            "retired" => "year_retired",
            "active" => "team_name",
            "free_agent" => "last_team"
        );
        
        $selects = array(
            "position" => array(
                "Left Wing", "Centreman", "Right Wing", "Defenseman", "Goalie"
            ),
            "team_name" => array(),
            "last_team" => array()
        );
        
        $query = "SELECT team_name
            FROM team
            ORDER BY team_name";
        $response = mysqli_query($dbc, $query);
        if($response) {
            while($row = mysqli_fetch_array($response)) {
                $selects[$otherKey[$type]][] = $row['team_name'];
            }
        }

        // QUERY
        $originalQuery = 'SELECT name, position, '.$otherKey[$type].' FROM '.$type.' NATURAL JOIN players';
        $response = @mysqli_query($dbc, $originalQuery);

        if($response){
            // CREATE DATA ARRAY
            $data = array();
            for ($i = 0; $row = mysqli_fetch_array($response); $i++) {
                foreach ($row as $key => $value) {
                    if (!is_int($key)) {
                        $data[$i][$key] = $value;
                    }
                }
            }
            $headings = array();
            foreach ($data[0] as $heading => $_) {
                $headings[] = $heading;
            }
            $headings[] = "delete";
            $headings[0] = $type;
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
                    default: return true;
                }
            }
            
            // PREPARE HEADINGS WITH DATABASE KEY => HEADING
            $formatted = array(
                'active' => 'Active',
                'retired' => 'Retired',
                'free_agent' => 'Free Agent',
                'name' => 'Player Name',
                'position' => 'Position',
                'team_name' => 'Team',
                'year_retired' => 'Retired',
                'last_team' => 'Last Team',
                'delete' => 'Delete'
            );
            
            // IF DATA IS SUBMITTED
            if (isset($_POST['submit'])) {
                $errors = array();
                // IF NEW DATA SHOULD BE ADDED
                if (!empty($_POST['new']['name']) && !empty($_POST['new']['position']) && !empty($_POST['new'][$otherKey[$type]])) {
                    $query = 'INSERT INTO players VALUES ("'.$_POST['new']['name'].'", "'.$_POST['new']['position'].'");';
                    $stmt = mysqli_prepare($dbc, $query);
                    mysqli_stmt_execute($stmt);
                    if (mysqli_stmt_affected_rows($stmt) != 1) {
                        $errors[] = 'Could not add player, "'.$_POST['new']['name'].'" already exists.';
                    } else {
                        $query = 'INSERT INTO '.$type.' VALUES ("'.$_POST['new']['name'].'", "'.$_POST['new'][$otherKey[$type]].'");';
                        $stmt = mysqli_prepare($dbc, $query);
                        mysqli_stmt_execute($stmt);
                    }
                }
                foreach ($_POST['data'] as $i => $values) {
                    // IF VALUE SHOULD BE DELETED
                    if (isset($_POST['delete'][$values['name']])) {
                        if(mysqli_fetch_array(mysqli_query($dbc, "SELECT name
                            FROM players
                            WHERE name = '".$values['name']."'"))['name'] == $values['name']) {
                            // Player exists
                            $query = 'DELETE FROM players WHERE name = "'.$values['name'].'"';
                            $stmt = mysqli_prepare($dbc, $query);
                            mysqli_stmt_execute($stmt);
                        } else {
                            // Player does not exist
                            // Do nothing
                            $errors[] = 'Could not delete player, '.$values['name'].' does not exist.';
                        }
                    }
                    foreach ($values as $key => $value) {
                        // IF VALUE HAS CHANGED
                        if ($value != $data[$i][$key]) {
                            if (checkConstraint($key, $value)) {
                                if ($key == $otherKey[$type]) {
                                    $query = 'UPDATE '.$type.' SET '.$key.' = "'.$value.'" WHERE name = "'.$data[$i]['name'].'"';
                                } else { // $key is in players
                                    $query = 'UPDATE players SET '.$key.' = "'.$value.'" WHERE name = "'.$data[$i]['name'].'"';
                                }
                                $stmt = mysqli_prepare($dbc, $query);
                                mysqli_stmt_execute($stmt);
                                $affected_rows = mysqli_stmt_affected_rows($stmt);
                                if ($affected_rows != 1) {
                                    $errors[] = '"'.$data[$i][$key].'" could not be changed to "'.$value.'".';
                                }
                            } else {
                                $errors[] = $formatted[$key].': '.$value.' is not a valid input.';
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
                <table border="1" cellpadding="2" style="border: 1px solid black; border-collapse:collapse">';
                
                // HEADINGS
                foreach ($headings as $_ => $heading) {
                    echo '<td><b>'.$formatted[$heading].'</b></td>';
                }
                
                // ADD NEW PLAYER
                echo '<tr>
                <td><input type="text" name="new[name]" value=""></td>';
                echo '<td class="'.$key.' edit">
                <select name="new[position]"><option></option>';
                foreach ($selects['position'] as $i => $option) {
                    echo '<option>'.$option.'</option>';
                }
                echo '</select></td>';
                if ($type == "retired") {
                    echo '<td><select name="new[year_retired]"><option></option>';
                    for ($j = 2018; $j >= 1917; $j--) {
                        echo '<option>'.$j.'</option>';
                    }
                    echo '</select></td>';
                } else { // $type == "active" || $type == "free_agent"
                    echo '<td>
                    <select name="new['.$otherKey[$type].']"><option></option>';
                    foreach ($selects[$otherKey[$type]] as $i => $option) {
                        echo '<option>'.$option.'</option>';
                    }
                }
                echo '</select></td>';
                echo '<td></td></tr>';
                
                // DATA
                foreach ($data as $i => $values) {
                    echo '<tr>
                    ';
                    // NAME
                    echo '<td><input class="field" type="text" name="data['.$i.'][name]" value="'.$values['name'].'"></td>
                    ';
                    // POSITION
                    echo '<td><select name="data['.$i.'][position]">';
                    foreach ($selects['position'] as $_ => $option) {
                        if ($values['position'] == $option) {
                            echo '<option selected>'.$option.'</option>';
                        } else {
                            echo '<option>'.$option.'</option>';
                        }
                    }
                    echo '</select></td>';
                    // OTHER ATTRIBUTE
                    if ($type == "retired") {
                        echo '<td><select name="data['.$i.'][year_retired]">';
                        for ($j = 2018; $j >= 1917; $j--) {
                            if ($values['year_retired'] == $j) {
                                echo '<option selected>'.$j.'</option>';
                            } else {
                                echo '<option>'.$j.'</option>';
                            }
                        }
                        echo '</select></td>';
                    } else { // $type == "active" || $type == "free_agent"
                        echo '<td>
                        <select name="data['.$i.']['.$otherKey[$type].']">';
                        foreach ($selects[$otherKey[$type]] as $_ => $option) {
                            if ($values[$otherKey[$type]] == $option) {
                                echo '<option selected>'.$option.'</option>';
                            } else {
                                echo '<option>'.$option.'</option>';
                            }
                        }
                        echo '</select></td>';
                    }
                    // DELETE
                    echo '<td class="delete"><input type="checkbox" name="delete['.$values['name'].']" value="true"></td>';
                    echo '</tr>
                    ';
                }
                
                // END TABLE AND FORM
                echo '</table><input type="submit" name="submit" value="Submit"></form>';
            }
        } else {
            echo "Couldn't issue database query<br />";
            echo mysqli_error($dbc);
        }
        mysqli_close($dbc);
    }
?>

<script>
document.title = "Edit <?=$formatted[$type]?> Players"; 
</script>

</body>
</html>
