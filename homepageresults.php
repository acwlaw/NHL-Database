<html>
<head>
  <title>NHL Database</title>
</head>
<body>
<h1>Here's your fucking results<h1>

<?php
if (isset($_POST)) {
    $group = $_POST['group_statistic'];
    $type = $_POST[$group.'_statistic'];


    if($group){
      require_once('../../mysqli_connect.php');
      $query = "SELECT $type
                FROM ".$group."_statistic
                ORDER BY $type";
      $response = mysqli_query($dbc, $query);
      if($response) {
        echo '<table align="left"
        cellspacing="5" cellpadding="8">
        <tr>';

        while($row = mysqli_fetch_array($response)) {
          echo '<td align="left"><b>' . $row[$type] . '</b></td>';
        }
          echo '</tr>';
      } else {
        echo "Couldn't issue database query1<br />";
        echo mysqli_error($dbc);
      }
    }

    mysqli_close($dbc);
}
?>
