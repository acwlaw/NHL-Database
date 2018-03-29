<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Query results:<h1>

<?php
$formattedGroupStatistic = array(
  'isskater' => 'skater',
  'isgoalie' => 'goalie'
);
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


if (isset($_POST)) {
  $group = $formattedGroupStatistic[$_POST['group_statistic']];
  $equality = $_POST['equality'];
  $number = $_POST['number'];
  $type = $_POST[$group.'_statistic'];

  $formattedEquality = array(
    '>' => "< $number",
    '<' => "> $number AND $type > 0",
  );

  require_once('../../mysqli_connect.php');

  $query = "SELECT team_name
   FROM team_statistic as T
   WHERE NOT EXISTS (SELECT name
                     FROM skater_statistic as S
                     WHERE $type $formattedEquality[$equality]
                        AND NOT EXISTS (SELECT *
                                       FROM Active as A
                                       WHERE T.team_name = A.team_name))";

  $response = mysqli_query($dbc, $query);

  if ($response) {
    echo '<table align="left" cellspacing="5" cellpadding="8">
          <tr>
            <td align="center"><b>Team</b></td>
            <td align="center"><b>Name</b></td>
            <td align="center"><b>'.$formattedName[$type].'</b><td>
          </tr>
          <tr>';
    while($row = mysqli_fetch_array($response)) {
      echo '<td align="center">'.$row['team_name'].'</td>
            </tr>';
    }
  } else {
    echo "Couldn't issue database query<br />";
    echo mysqli_error($dbc);
  }

}

 ?>
