<html>
<head>
<title>Delete Goal</title>
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
    // $date, $location, $min, $sec, $period // are set now
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
            // Goal exists
            $query = 'DELETE FROM goal WHERE date = "'.$date.'" AND location = "'.$location.'" AND goal_time = "'.$goal_time.'" AND goal_period = "'.$period.'"';
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_execute($stmt);
            echo 'Goal Removed';
        } else {
            // Goal does not exist
            // Do nothing
            echo 'Goal does not exist.';
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

    <b>Delete a Goal</b><br>
    
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
  
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
