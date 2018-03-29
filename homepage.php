<html>
<head>
  <title>NHL Database</title>
  <!-- <link rel="stylesheet" href="homepagestyles.css"> -->
</head>
<body>
  <h1>NHL Database</h1>
  <p><b>What would you like to see?<br></b></p>

  <b>Top 10 Stats:</b><br>
  <form action="top10results.php" method="post">
  Statistic group:
    <select id="top10SelectBox" name="group_statistic" onchange="top10SelectType()">
      <option value="skater">Skater Statistic</option>
      <option value="goalie">Goalie Statistic</option>
      <option value="team">Team Statistic</option>
    </select>

  <div id="skater">
    Type of statistic:
    <select name="skater_statistic">
      <option value=goals>Goals</option>
      <option value="assist">assist</option>
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

  <!-- <b>Interesting Stats:</b><br>
  <form action="interestingstats.php" method="post">
    Find teams where all
    <select id="ISGroupSelectBox" name="group_statistic" onchange="ISSelectType()">
      <option value="isskater">Skaters</option>
      <option value="isgoalie">Goalies</option>
    </select>
    have
    <select name="equality">
      <option>></option>
      <option><</option>
    </select>
    <select name="number">
      <option>1</option>
      <option>5</option>
      <option>10</option>
      <option>20</option>
      <option>30</option>
      <option>40</option>
      <option>50</option>
    </select>
    <select name="skater_statistic" id="isskater">
      <option value=goals>Goals</option>
      <option value="assist">assist</option>
      <option value="points">Points</option>
      <option>PIM</option>
      <option>SOG</option>
    </select>
    <select style="display: none" name="goalie_statistic" id="isgoalie">
      <option value="win">Win</option>
      <option value="loss">Loss</option>
      <option value="tie">Tie</option>
      <option>SO</option>
    </select>
    <input type="submit" name="submit" value="Submit">
  </form> -->

  <b>See who's on what team:</b><br>
  <form action="findplayers.php" method="post">
    Select team:
    <select name="team">
      <?php
        require_once('../../mysqli_connect.php');
        $query = "SELECT team_name
                  FROM team
                  ORDER BY team_name";
        $response = mysqli_query($dbc, $query);
        if($response) {
          while($row = mysqli_fetch_array($response)) {
            echo "<option>" .$row['team_name'] . "</option>";
          }
        } ?>
    </select><br>
    <input type="submit" name="submit" value="Submit">
  </form>

  <b>Who is performing the best/worst in the league this year?</b><br>
  <form action="bestworstplayers.php" method="post">
    Select:
    <br>
      <input type="radio" name="status" value="best" checked>Best<br>
      <input type="radio" name="status" value="worst">Worst<br>
    <input type="submit" name="submit" value="Submit"><br>
    <br>
  </form>

  <b>Which team has been performing the best/worst in recent years?</b><br>
  <form action="bestworstteams.php" method="post">
    Select:<br>
      <input type="radio" name="status" value="best" checked>Best<br>
      <input type="radio" name="status" value="worst" >Worst<br>
    <input type="submit" name="submit" value="Submit"><br>
  </form>

  <b>UH OH! Stat of the day ALERT!!</b><br>
  To find out all teams that have played a home game against every other team,
  click <a href="statoftheday.php">here</a>.<br>
  <br>

  <script>
    function top10SelectType() {
      var selectBox = document.getElementById("top10SelectBox");
      var selectedValue = selectBox.options[selectBox.selectedIndex].value;
      document.getElementById("skater").style.display = "none";
      document.getElementById("goalie").style.display = "none";
      document.getElementById("team").style.display = "none";
      document.getElementById(selectedValue).style.display = "";
    }

    function ISSelectType() {
      var selectBox = document.getElementById("ISGroupSelectBox");
      var selectedValue = selectBox.options[selectBox.selectedIndex].value;
      document.getElementById("isskater").style.display = "none";
      document.getElementById("isgoalie").style.display = "none";
      document.getElementById(selectedValue).style.display = "";
    }
  </script>

  <div style="position:absolute;right:0;bottom:0;width:144px;height:150px">
    <a style="display:block" href=""><span style="font:bold 15px Comic Sans">shh... only if you're an admin click here</span><br>
  <img src="shh.jpg" style="width:144px;height:81px">
</a>
</div>

</body>
</html>
