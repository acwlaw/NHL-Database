<html>
<head>
<title>Add Player</title>
</head>
<body>
<?php

if(isset($_POST['submit'])){
    $data_missing = array();

    if(empty($_POST['name'])){
        // Adds name to array
        $data_missing[] = 'Player Name';
    } else {
        // Trim white space from the name and store the name
        $f_name = trim($_POST['name']);
    }

    if(empty($_POST['position'])){
        // Adds position to array
        $data_missing[] = 'Position';
    } else{
        // Trim white space from the name and store the name
        $l_name = trim($_POST['position']);
    }

    if(empty($data_missing)){
        require_once('../mysqli_connect.php');
        $query = "INSERT INTO players (name, position) VALUES (?, ?)";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ss", $f_name, $l_name);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){
            echo 'Player Entered';
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        } else {
            echo 'Error Occurred<br />';
            echo mysqli_error();
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    } else {
        echo 'You need to enter the following data<br />';
        foreach($data_missing as $missing){
            echo "$missing<br />";
        }
    }
}

?>
<form action="http://localhost:1234/playeradded.php" method="post">

<b>Add a New Player</b><br>
<form>
  First name:<br>
  <input type="text" name="firstname"><br>
  Last name:<br>
  <input type="text" name="lastname"><br>
  <input type="radio" name="Player type" value="Active player" checked>Active Player<br>
  <input type="radio" name="Player type" value="Retired player">Retired player<br>
  <input type="radio" name="Player type" value="Free agent">Free Agent<br>
  <input type="submit" value="Submit">
</form>
</body>

</html>
