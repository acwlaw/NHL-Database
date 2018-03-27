<html>
<head>
<title>Add Player</title>
</head>
<body>
<form action="playeradded.php" method="post">

<b>Add a New Player</b><br>
  Name:<br>
  <input type="text" name="name"><br>
  Position:<br>
  <input type="text" name="position"><br>
  <input type="radio" name="type" value="active" onclick="showTeam()" checked>Active Player<br>
  <input type="radio" name="type" value="retired" onclick="showYear()">Retired player<br>
  <input type="radio" name="type" value="free" onclick="showTeam()">Free Agent<br>
  
  <div id="team">
  Team:<br>
  <select name="team">
  <?php
        require_once('../../mysqli_connect.php');
  $query = "SELECT city, team_name
          FROM team
          ORDER BY city";
$response = @mysqli_query($dbc, $query);
if($response) {
  while($row = mysqli_fetch_array($response)) {
    echo "<option>" . $row['team_name'] . "</option>";
  }
}
?>
    </select>
  </div>





  <div id="year" style="display:none">
  Retirement Year:<br>
  <select name="year">
    <option selected>1917</option>
    <?php for ($i = 1918; $i <= 2018; $i++) {echo '<option>', $i, '</option>';} ?>
  </select><br>
  </div>
  
  <input type="submit" name="submit" value="Add Player">
</form>



  
  <script>
    function showTeam() {
        document.getElementById("team").style.display = "inline";
        document.getElementById("year").style.display = "none";
    }
    function showYear() {
        document.getElementById("year").style.display = "inline";
        document.getElementById("team").style.display = "none";
    }
  </script>
  </script>
</body>
</html>
