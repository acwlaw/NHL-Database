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

  $headerName = $status == "best" ? " is killing it. He will go far in life. He currently
  has ":
    " is not doing so hot. Maybe hockey is not the right thing for him. He currently
    has ";

  $query = "SELECT name, points, year
            FROM skater_statistic
            WHERE points = (SELECT $formattedStatus[$status](points)
                            FROM skater_statistic
                            WHERE year = 2018)";

  $response = mysqli_query($dbc, $query);

  if($response) {
    $row = mysqli_fetch_array($response);
    echo '<b>'.$row['name']. $headerName . $row['points'].' points.'.'</b>';
  } else {
    echo "Couldn't issue database query<br />";
    echo mysqli_error($dbc);
  }
}

?>
