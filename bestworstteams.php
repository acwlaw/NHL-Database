<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Query results:<h1>

<?php

$formattedStatus = array(
  'best' => 'MAX',
  'worst' => 'MIN'
);


if (isset($_POST)) {
  $status = $_POST['status'];

  require_once('../../mysqli_connect.php');

  $query = "SELECT team_name, average
FROM (
		SELECT team_name, AVG(win) AS average
		FROM team_statistic as thing1
		GROUP BY team_name
		) AS thing2
WHERE average
	IN (
		SELECT $formattedStatus[$status](average)
		FROM (
		SELECT team_name, AVG(win) AS average
		FROM team_statistic as thing3
		GROUP BY team_name
	)
	AS wtf)";

  $response = mysqli_query($dbc, $query);

  if($response) {
    echo '<table align="left"
    cellspacing="5" cellpadding="8">
    <tr>
      <td align="center"><b>Team</b></td>
      <td align="center"><b>Average Wins</b></td>
    </tr>
    <tr>';
    while($row = mysqli_fetch_array($response)) {
      echo '<td align="center">'.$row['team_name'].'</td>
            <td align="center">'.$row['average'].'</td>';
      echo '</tr>';
    }
  } else {
    echo "Couldn't issue database query<br />";
    echo mysqli_error($dbc);
  }
}

?>
