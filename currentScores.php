<!DOCTYPE html>
<head>
    <title>DTC - Scoring System</title>
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
</head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
        <a href="#about">About</a>
    </div>
    <div id="scoresPanel">
      <?php
      $myfile = fopen("scores.json", "r") or die("Unable to open file!");
      $jsonFileString = fread($myfile, filesize("scores.json"));
      fclose($myfile);
      foreach (json_decode($jsonFileString, true) as $competitionGroup) {
        echo join("", array('<div class="competitionGroup" id=', $competitionGroup["id"], '><h2>', $competitionGroup["Grade"], ' Scores', " (", $competitionGroup["id"],')</h2><table><tr><th>Team Name</th><th>Team Members</th><th>Knowledge Points</th><th>Simulation Points</th><th>Flight Points</th><th>Autonomous Points</th><th>Mission Possible Points</th><th>Total Points</th></tr>'));
        foreach ($competitionGroup["teamScores"] as $teamData) {
          echo join("", array("<tr><td>", $teamData['name'],"</td><td>", join(" + ", $teamData["TeamMembers"]),"</td><td>", $teamData['KnoP'],"</td><td>", $teamData['SimP'],"</td><td>", $teamData['FlyP'],"</td><td>", $teamData['AutP'],"</td><td>", $teamData['MisP'],"</td><td>", ($teamData['KnoP'] + $teamData['SimP'] + $teamData['FlyP'] + $teamData['AutP'] + $teamData['MisP']),"</td><td>"));
        }
        echo '</table></div>';
      }
      ?>
    <div>
</body>
</html>