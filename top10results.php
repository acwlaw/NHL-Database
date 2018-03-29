<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Here's your fucking results:<h1>

<?php
$formattedName = array(
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
            'goals_against' => 'Goals Against'
        );
$formattedPrint = array(
    'name' => '',
    'year' => '',
    'win' => 'DESC',
    'loss' => '',
    'tie' => '',
    'GAA' => '',
    'saving_percent' => '',
    'SO' => 'DESC',
    'PIM' => 'DESC',
    'points' => 'DESC',
    'assist' => 'DESC',
    'goals' => 'DESC',
    'SOG' => 'DESC',
    'plusminus' => '',
    'team_name' => 'DESC',
    'goals_for' => 'DESC',
    'goals_against' => ''
);
$formattedTime = array(
    'currentYear' => 'WHERE year = 2018',
    'lastFive' => 'WHERE year < 2019 AND year > 2012',
    'allTime' => ''
);

if (isset($_POST)) {
    $group = $_POST['group_statistic'];
    $type = $_POST[$group.'_statistic'];
    $time = $_POST['time_frame'];

    require_once('../../mysqli_connect.php');

    $headerName = $group == "team" ? "team_name" : "name";

    $query = "SELECT $headerName, $type, year
              FROM ".$group."_statistic
              $formattedTime[$time]
              ORDER BY $type $formattedPrint[$type]";
    $response = mysqli_query($dbc, $query);

    if($response) {
      echo '<table align="left"
      cellspacing="5" cellpadding="8">
      <tr>
        <td align="center"><b>Year</b></td>
        <td align="center"><b>Name</b></td>
        <td align="center"><b>'.$formattedName[$type].'</b><td>
      </tr>
      <tr>';
      while($row = mysqli_fetch_array($response)) {
        echo '<td align="center">'.$row['year'].'</td>
              <td align="center">'.$row[$headerName].'</td>
              <td align="center">'.$row[$type] . '</td>';
        echo '</tr>';
      }
    } else {
      echo "Couldn't issue database query<br />";
      echo mysqli_error($dbc);
    }
}
mysqli_close($dbc);


?>
