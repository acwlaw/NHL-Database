<html>
<head>
<title>Add Team</title>
</head>
<body>

<?php

if(isset($_POST['submit'])){
    $data_missing = array();
    foreach($_POST as $key => $value) {
        if(empty($value)) {
            $data_missing[] = $key;
        }
        $$key = $value;
    }
    // $team_name, $city // are set now

    if(empty($data_missing)){
        require_once('../../mysqli_connect.php');
        // Check primary keys for if this row already exists
        if(mysqli_fetch_array(mysqli_query($dbc, 'SELECT team_name
            FROM team
            WHERE team_name = "'.$team_name.'"'))['team_name'] == $team_name) {
            // Team already exists
            echo 'This team already exists';
        } else {
            // Team does not exist
            $query = "INSERT INTO team VALUES (?, ?)";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "ss", $team_name, $city);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows == 1){
                echo 'Team Entered';
            } else {
                echo 'Unknown Error Occurred<br />';
                //echo mysqli_error();
            }
            //mysqli_stmt_close($stmt);

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

    <b>Add a New Team</b><br>

    Team Name:<br>
    <input name="team_name" type="text" maxlength="200"><br>

    City:<br>
    <input name="city" type="text" maxlength="200"><br>

    <input type="submit" name="submit" value="Submit">
</form>



</body>
</html>
