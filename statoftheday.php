<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Statistic of the day:<h1>

<?php

if (isset($_POST)) {

  require_once('../../mysqli_connect.php');

  $query = "SELECT team_name
            FROM team A
            WHERE NOT EXISTS (SELECT *
	                            FROM team B
                              WHERE NOT EXISTS (SELECT *
		                                            FROM game G
                                                WHERE G.teamA_name = B.team_name
                                                AND G.teamB_name = A.team_name)
                                                AND B.team_name != A.team_name)";

  $response = mysqli_query($dbc, $query);

  if ($response) {
    echo '<table align="left" cellspacing="5" cellpadding="8">
          <tr>
            <td align="left"><b>Team Name</b></td>
          </tr>
          <tr>';
    while($row = mysqli_fetch_array($response)) {
      echo '<td align="left">'.$row['team_name'].'</td>';
      echo '</tr>';
    }
  } else {
    echo "Couldn't issue database query<br />";
    echo mysqli_error($dbc);
  }
}
?>
