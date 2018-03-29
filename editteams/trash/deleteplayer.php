<html>
<head>
<title>Delete Player</title>
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
    // $name // is set now

    if(empty($data_missing)){
        require_once('../../mysqli_connect.php');
        // Check primary keys for if this row already exists
        if(mysqli_fetch_array(mysqli_query($dbc, "SELECT name
            FROM players
            WHERE name = '" . $name . "'"))['name'] == $name) {
            // Player exists
            $query = 'DELETE FROM players WHERE name = "'.$name.'"';
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_execute($stmt);
            echo 'Player Removed';
        } else {
            // Player does not exist
            // Do nothing
            echo 'Player does not exist.';
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

<b>Delete a Player</b><br>

    Name:<br>
    <select name="name">
        <?php
        require_once('../../mysqli_connect.php');
        $query = "SELECT name
            FROM players";
        $response = mysqli_query($dbc, $query);
        if($response) {
          while($row = mysqli_fetch_array($response)) {
            echo "<option>" . $row['name'] . "</option>";
          }
        } ?>
    </select><br>

    <input type="submit" name="submit" value="Submit">
</form>
  
<? mysqli_close($dbc); ?>
</body>
</html>
