<html>
<head>
  <title>NHL Database</title>
  <!-- <link rel="stylesheet" href="homepagestyles.css"> -->
</head>
<body>
  <h1>NHL Database</h1>
  <b>What would you like to see?<br></b>

  <form action="homepageresults.php" method="post">
  Statistic group:
    <select id="groupSelectBox" name="group_statistic" onchange="groupSelectType()">
      <option value="skater">Skater Statistic</option>
      <option value="goalie">Goalie Statistic</option>
      <option value="team">Team Statistic</option>
    </select>

  <div id="skater">
    Type of statistic:
    <select name="skater_statistic">
      <option value=goals>Goals</option>
      <option value="assist">Assists</option>
      <option value="points">Points</option>
      <option>PIM</option>
      <option>SOG</option>
      <option value="plusminus">+/-</option>
    </select>
  </div>

  <div style="display: none" id="goalie">
    Type of statistic:
      <select name="goalie_statistic">
        <option value="win">Win</option>
        <option value="loss">Loss</option>
        <option value="tie">Tie</option>
        <option>GAA</option>
        <option value=saving_percent>sv%</option>
        <option>SO</option>
      </select>
  </div>

  <div style="display: none" id="team">
    Type of statistic:
    <select name="team_statistic">
      <option value="win">Win</option>
      <option value="loss">Loss</option>
      <option value="goals_for">Goals For</option>
      <option value="goals_against">Goals Against</option>
    </select>
  </div>

  Select Time Frame:
  <select id"timeSelect" name="time_frame">
    <option value="currentYear">Current Year</option>
    <option value="lastFive">Last 5 Years</option>
    <option value="allTime">All time</option>
  </select> <br>

  <input type="submit" name="submit" value="Submit">
  </form>

  <script>
    function groupSelectType() {
      var selectBox = document.getElementById("groupSelectBox");
      var selectedValue = selectBox.options[selectBox.selectedIndex].value;
      document.getElementById("skater").style.display = "none";
      document.getElementById("goalie").style.display = "none";
      document.getElementById("team").style.display = "none";
      document.getElementById(selectedValue).style.display = "";
    }
  </script>

</body>
</html>
