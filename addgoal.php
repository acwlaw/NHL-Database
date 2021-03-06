<html>
<head>
<title>Add Goal</title>
</head>
<body onload="showDates(document.getElementById('location').value)">

<?php

if(isset($_POST['submit'])){
    $data_missing = array();
    foreach($_POST as $key => $value) {
        if($value == "") {
            $data_missing[] = $key;
        }
        $$key = $value;
    }
    // $date, $location, $name, $assist1, $assist2, $min, $sec, $period // are set now
    if ($assist1 == 'null') {
        $assist1 = NULL;
    }
    if ($assist2 == 'null') {
        $assist2 = NULL;
    }
    if ($sec < 10) {
        $sec = '0'.$sec;
    }
    $goal_time = $min.':'.$sec;
    
    if(empty($data_missing)){
        require_once('../../mysqli_connect.php');
        // Check primary keys for if this row already exists
        if(mysqli_fetch_array(mysqli_query($dbc, 'SELECT date, location, goal_time
            FROM goal
            WHERE date = "'.$date.'" AND location = "'.$location.'" AND goal_time = "'.$goal_time.'" AND goal_period = "'.$period.'"'))['date'] == $date) {
            // Goal already exists
            echo 'This goal already exists';
        } else {
            // Goal does not exist
            if ($assist1 == NULL && $assist2 != NULL) {
                $temp = $assist1;
                $assist1 = $assist2;
                $assist2 = $temp;
            }
            $query = "INSERT INTO goal VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "ssssssi", $date, $location, $name, $assist1, $assist2, $goal_time, $period);
            mysqli_stmt_execute($stmt);
            $affected_rows = mysqli_stmt_affected_rows($stmt);

            if ($affected_rows == 1){
                echo 'Goal Entered';
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

    <b>Add a New Goal</b><br>
    
    Location:<br>
    <select name="location" id="location" onchange="showDates(this.value)">
        <?php
        require_once('../../mysqli_connect.php');
        $query = "SELECT location
            FROM game";
        $response = mysqli_query($dbc, $query);
        if($response) {
            $locations = array();
            while($row = mysqli_fetch_array($response)) {
                $locations[] = $row['location'];
            }
            foreach (array_unique($locations) as $i => $location) {
                echo "<option>" . $location . "</option>";
            }
        } ?>
    </select><br>
    
    Date:<br>
    <select name="date" id="date">
        
    </select><br>
    
    <script>
    var dates = {};
    <?php
    require_once('../../mysqli_connect.php');
    $dates = array();
    foreach (array_unique($locations) as $i => $location) {
        $query = "SELECT date
            FROM game
            WHERE location = '$location'";
        $response = mysqli_query($dbc, $query);
        if($response) {
            $dates[$location] = array();
            while($row = mysqli_fetch_array($response)) {
                $dates[$location][] = $row['date'];
            }
        }
    }
    foreach ($dates as $location => $datesArray) {
        echo 'dates["'.$location.'"] = [];
        ';
        foreach ($datesArray as $i => $date) {
            echo 'dates["'.$location.'"].push("'.$date.'");';
        }
    }
    ?>
    function showDates(location) {
        var newDates = dates[location];
        var options = newDates.map(function (date) {
            var option = document.createElement("option");
            option.setAttribute("value", date);
            option.innerHTML = date;
            return option;
        });
        select = document.getElementById("date");
        select.innerHTML = "";
        for (option of options) {
            select.appendChild(option);
        }
    }
    </script>
    
    Period:<br>
    <select name="period">
        <option>1</option>
        <option>2</option>
        <option>3</option>
    </select><br>
    
    Minutes:<br>
    <select name="min">
    <?php for ($i = 0; $i <= 19; $i++) {
        echo '<option>'.$i.'</option>'; } ?>
    </select><br>
    
    Seconds:<br>
    <select name="sec">
    <?php for ($i = 0; $i <= 59; $i++) {
        echo '<option>'.$i.'</option>'; } ?>
    </select><br>
    
    Player:<br>
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
    
    Assist 1 (optional):<br>
    <select name="assist1">
        <option value="null" selected>Select a player</option>
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
    
    Assist 2 (optional):<br>
    <select name="assist2">
        <option value="null" selected>Select a player</option>
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
</body>
</html>
