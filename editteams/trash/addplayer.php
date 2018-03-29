<html>
<head>
<title>Add Player</title>
</head>
<body>

<?php

if(isset($_POST['submit'])){
    //$data = array("name", "position", "type", "team", "year");
    $data_missing = array();
    foreach($_POST as $key => $value) {
        if(empty($value)) {
            $data_missing[] = $key;
        }
        $$key = $value;
    }
    // $name, $position, $type, $team, $year // are set now

    if(empty($data_missing)){
        require_once('../../mysqli_connect.php');
        // Check primary keys for if this row already exists
        if(mysqli_fetch_array(mysqli_query($dbc, "SELECT name
            FROM players
            WHERE name = '" . $name . "'"))['name'] == $name) {
            // Player already exists
            echo 'This player already exists';
        } else {
            // Player does not exist
            // Add player to players
            $query = "INSERT INTO players VALUES (?, ?)";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "ss", $name, $position);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            // Add player to specific type
            $stmt = mysqli_prepare($dbc, "INSERT INTO " . $type . " VALUES (?, ?)");
            if ($type == "active" || $type == "free") {
                mysqli_stmt_bind_param($stmt, "ss", $name, $team);
            } else { // retired
                mysqli_stmt_bind_param($stmt, "si", $name, $year);
            }
            mysqli_stmt_execute($stmt);
            $affected_rows += mysqli_stmt_affected_rows($stmt);

            if ($affected_rows == 2){
                echo 'Player Entered';
            } else {
                echo 'Unknown Error Occurred<br />';
                //echo mysqli_error();
            }
            //mysqli_stmt_close($stmt);
            //mysqli_close($dbc);
        }
    } else {
        echo 'You need to enter the following data<br />';
        foreach($data_missing as $missing){
            echo "$missing<br />";
        }
    }
}

?>

<form action="" method="post">

<b>Add a New Player</b><br>

    Name:<br>
    <input type="text" name="name"><br>

    Position:<br>
    <input type="text" name="position"><br>

    Status:<br>
    <input type="radio" name="type" value="active" onclick="showTeam()" checked>Active<br>
    <input type="radio" name="type" value="retired" onclick="showYear()">Retired<br>
    <input type="radio" name="type" value="free_agent" onclick="showTeam()">Free Agent<br>

    <div id="team">
        Team / Last Team:<br>
        <select name="team">
            <?php
            require_once('../../mysqli_connect.php');
            $query = "SELECT city, team_name
                FROM team
                ORDER BY city";
            $response = mysqli_query($dbc, $query);
            if($response) {
              while($row = mysqli_fetch_array($response)) {
                echo "<option>" . $row['team_name'] . "</option>";
              }
            } ?>
        </select>
    </div>

    <div id="year" style="display:none">
        Retirement Year:<br>
        <select name="year">
            <?php for ($i = 2018; $i >= 1917; $i--) {echo '<option>', $i, '</option>';} ?>
        </select><br>
    </div>

    <input type="submit" name="submit" value="Submit">
</form>

<script>
    function showTeam() {
        document.getElementById("team").style.display = "";
        document.getElementById("year").style.display = "none";
    }
    function showYear() {
        document.getElementById("year").style.display = "";
        document.getElementById("team").style.display = "none";
    }
</script>

<? mysqli_close($dbc); ?>
</body>
</html>
