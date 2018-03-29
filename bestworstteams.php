<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Here's your fucking results:<h1>

<?php

$formattedStatus = array(
  'best' => 'MAX',
  'worst' => 'MIN'
);


if (isset($_POST)) {
  $status = $_POST['status'];

  require_once('../../mysqli_connect.php');

  $query = "SELECT *
FROM (SELECT *
	FROM (
		SELECT *, AVG(win) AS average
		FROM team_statistic AS kappa
		GROUP BY team_name
	) AS kappapride )
	AS kreygasm
WHERE (team_name, average)
	IN (
		SELECT team_name, max(average)
		FROM (SELECT *
	FROM (
		SELECT team_name, AVG(win) AS average
		FROM team_statistic AS pogchamp
		GROUP BY team_name
	)
	AS biblethump)
	AS wtf)";

  $response = mysqli_query($dbc, $query);

  if($response) {
    echo '<table align="left"
    cellspacing="5" cellpadding="8">
    <tr>
      <td align="center"><b>Team</b></td>
      <td align="center"><b>Wins</b></td>
    </tr>
    <tr>';
    while($row = mysqli_fetch_array($response)) {
      echo '<td align="center">'.$row['team_name'].'</td>
            <td align="center">'.$row['win'].'</td>';
      echo '</tr>';
    }
  } else {
    echo "Couldn't issue database query<br />";
    echo mysqli_error($dbc);
  }
}

?>
