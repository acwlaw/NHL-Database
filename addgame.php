<html>
<head>
<title>Add Game</title>
</head>
<body>

<?php

if(isset($_POST['submit'])){
    $data_missing = array();
    foreach($_POST as $key => $value) {
        if(empty($value)) {
            if ($key != "a_score" && $key != "b_score") {
                $data_missing[] = $key;
            }
        }
        $$key = $value;
    }
    // $date, $time, $location, $a_score, $b_score, $a_team, $b_team // are set now
    //$a_score = $a_score == '' ? NULL : $a_score;
    //$b_score = $b_score == '' ? NULL : $a_score;
    if ($a_score == '') {
        $a_score = NULL;
    }
    if ($b_score == '') {
        $b_score = NULL;
    }

    if(empty($data_missing)){
        require_once('../../mysqli_connect.php');
        // Check primary keys for if this row already exists
        if(mysqli_fetch_array(mysqli_query($dbc, 'SELECT date, location
            FROM game
            WHERE date = "'.$date.'" AND location = "'.$location.'"'))['date'] == $date) {
            // Game already exists
            echo 'This game already exists';
        } else {
            // Game does not exist
            $query = "INSERT INTO game VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "sssiiss", $date, $time, $location, $a_score, $b_score, $a_team, $b_team);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows == 1){
                echo 'Game Entered';
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

    <b>Add a New Game</b><br>

    Date:<br>
    <input name="date" type="date" min="1917-11-26"><br>

    Time (ET):<br>
    <select name="time">
    <?php for ($h = 0; $h <= 23; $h++) {
            for ($m = 0; $m <= 30; $m+= 30) {
                $hstring = strlen((string)$h) == 1 ? "0".(string)$h : (string)$h;
                $mstring = strlen((string)$m) == 1 ? "0".(string)$m : (string)$m;
                echo '<option>' . $hstring . ':' . $mstring . '</option>';
            }
    } ?>
    </select><br>

    Location:<br>
    <input name="location" type="text" maxlength="40"><br>

    Home Team:<br>
    <select name="a_team">
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
    </select><br>

    Away Team:<br>
    <select name="b_team">
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
    </select><br>

    Score (home / away):<br>
    <input name="a_score" type="number" min="0" max="999">
    <input name="b_score" type="number" min="0" max="999"><br>

    <input type="submit" name="submit" value="Submit">
</form>

<? mysqli_close($dbc); ?>
</body>
</html>
