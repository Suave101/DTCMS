<?php 
// Auth User
date_default_timezone_set("America/Chicago");session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true and $_SESSION["userData"]["role"]<4){$authenticated=true;}else{header("Location: login.php");die();}}else{header("Location: login.php");die();}
// Read Files
$myfile = fopen("scores.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("scores.json"));
fclose($myfile);
$jsonData = json_decode($jsonFileString, true);
// Check for POST Submission

?>
<!DOCTYPE html>
<head>
    <title>DTC - Scoring System</title>
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
    </div>
    <?php 
        foreach(array_keys($jsonData) as $account) {
            $eventData = $jsonData[$account];
            $pvat = $eventData['pointValuesAndTollerances'];
            echo'<div class="verticalNav"><form action="eventManager.php" class="account" method="post"><h1>';
            echo $account;
            echo '</h1><p class="largeDataInput">Knowledge Weight:<input type="number" name="KnowPVal" min="0"';
            // Point Value
            if (isset($pvat["KnowPVal"])) {echo 'value="';echo $pvat["KnowPVal"];echo '"';}
            echo '><br>Simulation Weight:<input type="number" name="SimPVal" min="0"';
            if (isset($pvat["SimPVal"])) {echo 'value="';echo $pvat["SimPVal"];echo '"';}
            echo '><br>Flight Weight:<input type="number" name="FlyPVal" min="0"';
            if (isset($pvat["FlyPVal"])) {echo 'value="';echo $pvat["FlyPVal"];echo '"';}
            echo '><br>Autonomous Weight:<input type="number" name="AutPVal" min="0"';
            if (isset($pvat["AutPVal"])) {echo 'value="';echo $pvat["AutPVal"];echo '"';}
            echo '><br>Mission Possible Weight:<input type="number" name="MisPVal" min="0"';
            if (isset($pvat["MisPVal"])) {echo 'value="';echo $pvat["MisPVal"];echo '"';}
            // Chances
            echo '><br>Knowledge Chances:<input type="number" name="KnowPChn" min="1"';
            if (isset($pvat["KnowPChn"])) {echo 'value="';echo $pvat["KnowPChn"];echo '"';}
            echo '><br>Simulation Chances:<input type="number" name="SimPChn" min="1"';
            if (isset($pvat["SimPChn"])) {echo 'value="';echo $pvat["SimPChn"];echo '"';}
            echo '><br>Flight Chances:<input type="number" name="FlyPChn" min="1"';
            if (isset($pvat["FlyPChn"])) {echo 'value="';echo $pvat["FlyPChn"];echo '"';}
            echo '><br>Autonomous Chances:<input type="number" name="AutPChn" min="1"';
            if (isset($pvat["AutPChn"])) {echo 'value="';echo $pvat["AutPChn"];echo '"';}
            echo '><br>Mission Possible Chances:<input type="number" name="MisPChn" min="1"';
            if (isset($pvat["MisPChn"])) {echo 'value="';echo $pvat["MisPChn"];echo '"';}
            echo '</p>';
            // Teams
            foreach(array_keys($eventData['teamScores']) as $team) {
                $teamData = $eventData['teamScores'][$team];
                echo join('', array('<div class="accountTeam"><h2>', $team, '</h2><input name="OGteamName" type="hidden" value="', $team, '"><p>Team Name: <input class="generalTeamInput" type="text" name="teamName" value="', $team, '"><br>Team Members: <input class="generalTeamInput" type="text" name="teamMembers" value="', $teamData["TeamMembers"], '"><br></p></div>'));
            }
            echo '<input type="submit" class="generalTeamInput" style="width:100%;margin:1em;padding:0.5em;"></form>';
        }
        if ($_SESSION["userData"]["role"] < 3) {echo '<a href="eventSetup.php" class="account" style="text-align: center;">Create New Event</a>';}
        ?>
</body>