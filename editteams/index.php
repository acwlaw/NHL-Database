<html>
<head>
<title>Edit Players</title>
</head>
<body>

<?php
    $connect = '../../../mysqli_connect.php';
    require_once($connect);
    
    $selects = array(
        "team_name" => array(),
        "city" => array()
    );

    // QUERY
    $originalQuery = 'SELECT team_name, city FROM team';
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
            'city' => 'City',
            'year_retired' => 'Retired',
            'last_team' => 'Last Team',
            'delete' => 'Delete'
        );
        
        // IF DATA IS SUBMITTED
        if (isset($_POST['submit'])) {
            $errors = array();
            // IF NEW DATA SHOULD BE ADDED
            if (!empty($_POST['new']['team_name']) && !empty($_POST['new']['city'])) {
                $query = 'INSERT INTO team VALUES ("'.$_POST['new']['team_name'].'", "'.$_POST['new']['city'].'");';
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) != 1) {
                    $errors[] = 'Could not add team, "'.$_POST['new']['team_name'].'" already exists.';
                }
            }
            foreach ($_POST['data'] as $i => $values) {
                // IF VALUE SHOULD BE DELETED
                if (isset($_POST['delete'][$values['team_name']])) {
                    if(mysqli_fetch_array(mysqli_query($dbc, "SELECT team_name
                        FROM team
                        WHERE team_name = '".$values['team_name']."'"))['team_name'] == $values['team_name']) {
                        // Team exists
                        $query = 'DELETE FROM team WHERE team_name = "'.$values['team_name'].'"';
                        $stmt = mysqli_prepare($dbc, $query);
                        mysqli_stmt_execute($stmt);
                    } else {
                        // Team does not exist
                        // Do nothing
                        $errors[] = 'Could not delete team, '.$values['team_name'].' does not exist.';
                    }
                }
                foreach ($values as $key => $value) {
                    // IF VALUE HAS CHANGED
                    if ($value != $data[$i][$key]) {
                        if (checkConstraint($key, $value)) {
                            $query = 'UPDATE team SET '.$key.' = "'.$value.'" WHERE team_name = "'.$data[$i]['team_name'].'"';
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
            
            // ADD NEW TEAM
            echo '<tr>
            <td><input type="text" name="new[team_name]" value=""></td>';
            echo '<td><input type="text" name="new[city]" value=""></td>';
            echo '<td></td></tr>';
            
            // DATA
            foreach ($data as $i => $values) {
                echo '<tr>
                ';
                // TEAM NAME
                echo '<td><input class="field" type="text" name="data['.$i.'][team_name]" value="'.$values['team_name'].'"></td>
                ';
                // CITY
                echo '<td><input class="field" type="text" name="data['.$i.'][city]" value="'.$values['city'].'"></td>';
                // DELETE
                echo '<td class="delete"><input type="checkbox" name="delete['.$values['team_name'].']" value="true"></td>';
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
?>

<script>
document.title = "Edit <?=$formatted[$type]?> Players"; 
</script>

</body>
</html>
