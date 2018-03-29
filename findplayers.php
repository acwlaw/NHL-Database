<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Here's your fucking results:<h1>

<?php
if(isset($_POST)) {
  $teamName = $_POST['team'];


  require_once('../../mysqli_connect.php');

  $query = "SELECT name, position, team_name, city
            FROM active
            NATURAL JOIN players
            WHERE team_name='$teamName'";

  $response = mysqli_query($dbc, $query);

  if($response) {
    echo "<b>"$row['city']
    echo '<table align="left" cellspacing="5" cellpadding="8">
    <tr>
      <td align="left"><b>Name</b></td>
      <td align="left"><b>Position</b></td>
    </tr>
    <tr>';
    while($row = mysqli_fetch_array($response)) {
      echo '<td align="left">'.$row['name'].'</td>
            <td align="left">'.$row['position'].'</td>';
      echo '</tr>';
    }
  } else {
    echo "Couldn't issue database query<br />";
    echo mysqli_error($dbc);
  }

}



?>
