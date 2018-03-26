<?php
// Get a connection for the database
require_once('../mysqli_connect.php');

// Create a query for the database
$query = "SELECT TOP 10 name, year, PIM, points, assists, goals, SOG, plusminus
          FROM skater_statistic
          ORDER BY points";

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){

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
while($row = mysqli_fetch_array($response)){

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
echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);
}

// Close connection to the database
mysqli_close($dbc);

?>
