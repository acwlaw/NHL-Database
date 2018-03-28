<?php
// Get a connection for the database
require_once('../../mysqli_connect.php');

// Create queries for the database
$skaterquery = "SELECT name, year, PIM, points, assists, goals, SOG, plusminus
          FROM skater_statistic
          ORDER BY points";
$goaliequery = "SELECT name, year, win, loss, tie, GAA, saving_percent, SO
                FROM goalie_statistic
                ORDER BY win";
// Get a response from the database by sending the connection
// and the query
$skaterresponse = @mysqli_query($dbc, $skaterquery);
$goalieresponse = @mysqli_query($dbc, $goaliequery);

// If the query executed properly proceed
if($skaterresponse){

  echo '<table align="left"
  cellspacing="5" cellpadding="8">

  <tr>
  	<td align="left"><b>Name</b></td>
    <td align="left"><b>Year</b></td>
    <td align="left"><b>Goals</b></td>
    <td align="left"><b>Assists</b></td>
    <td align="left"><b>Points</b></td>
    <td align="left"><b>SOG</b></td>
    <td align="left"><b>PIM</b></td>
    <td align="left"><b>+/-</b></td>

  </tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
  while($row = mysqli_fetch_array($skaterresponse)){

  echo '<tr><td align="left">' .$row['name'] .
      '</td><td align="left">' .$row['year'] .
      '</td><td align="left">' .$row['goals'] .
      '</td><td align="left">' .$row['assists'] .
      '</td><td align="left">' .$row['points'] .
      '</td><td align="left">' .$row['SOG'] .
      '</td><td align="left">' .$row['PIM'] .
      '</td><td align="left">' .$row['plusminus'] .
      '</td>';

  echo '</tr>';
  }
  echo '</table>';
  } else {
    echo "Couldn't issue database query1<br />";
    echo mysqli_error($dbc);
}

if ($goalieresponse) {

  echo '<table align="left"
  cellspacing="5" cellpadding="8">

  <tr>
  	<td align="left"><b>Name</b></td>
    <td align="left"><b>Year</b></td>
    <td align="left"><b>Win</b></td>
    <td align="left"><b>Loss</b></td>
    <td align="left"><b>Tie</b></td>
    <td align="left"><b>GAA</b></td>
    <td align="left"><b>Sv%</b></td>
    <td align="left"><b>SO</b></td>
  </tr>';

  while($row = mysqli_fetch_array($goalieresponse)) {
    echo '<tr><td align="left">' .$row['name'] .
        '</td><td align="left">' .$row['year'] .
        '</td><td align="left">' .$row['win'] .
        '</td><td align="left">' .$row['loss'] .
        '</td><td align="left">' .$row['tie'] .
        '</td><td align="left">' .$row['GAA'] .
        '</td><td align="left">' .$row['saving_percent'] .
        '</td><td align="left">' .$row['SO'] .
        '</td>';

    echo '</tr>';
    }
    echo '</table>';
    } else {
      echo "Couldn't issue database query<br />";
      echo mysqli_error($dbc);
  }


// Close connection to the database
mysqli_close($dbc);

?>
