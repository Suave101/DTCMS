<?php
date_default_timezone_set("America/Chicago");
session_start();
$myfile = fopen("scores.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("scores.json"));
fclose($myfile);
$jsonData = json_decode($jsonFileString, true);
if (isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])) {
    if ($_SESSION["authenticated"] == true and $_SESSION["userData"]["role"] < 3) {
        $authenticated = true;
    } else {
        header("Location: login.php");
        die();
    }
} else {
    header("Location: login.php");
    die();
}
// Event_ID, Event_Grade, Event_Date, Start_Time, End_Time
if (isset($_POST["Event_ID"]) and isset($_POST["Event_Grade"]) and isset($_POST["Event_Date"]) and isset($_POST["Start_Time"]) and isset($_POST["End_Time"])) {
    if (strtotime(join(array($_POST["Event_Date"], " ", $_POST["Start_Time"]))) < strtotime(join(array($_POST["Event_Date"], " ", $_POST["End_Time"])))) {
        if (array_key_exists(join(array($_POST["Event_Grade"], "#", $_POST["Event_ID"])), $jsonData)) {
            header("Location: eventSetup.php?invalid=1");
            die();
        } else {
            // TODO: Generate Event Skeleton
            $successful = true;
        }
    } else {
        header("Location: eventSetup.php?invalid=1");
        die();
    }
} else {
    header("Location: eventSetup.php?invalid=0");
    die();
}
//{
//    "HS#0": {
//        "id": "HS#0",
//        "Grade": "High School",
//        "teamScores": {
//            "Vikings": {"name": "Vikings", "TeamMembers": ["Rooster", "Mavrick"], "KnoP": [{"Name": "A_Doyle", "Points": 1390}, {"Name": "A_Doyle", "Points": 90}, {"Name": "A_Doyle", "Points": 20000}], "SimP": 100, "FlyP": {"Pilot": "Sam", "Navigator": "Joe", "Run Time 1": 21, "Run Time 2": -1}, "AutP": 1.5, "MisP": 93.76},
//            "Indians": {"name": "Indians", "TeamMembers": ["Oversight", "Bob"], "KnoP": [{"Name": "AD_Doyle", "Points": 6543}, {"Name": "AD_Doyle", "Points": 7654}, {"Name": "AD_Doyle", "Points": 7543}], "SimP": 100, "FlyP": {"Pilot": "Big", "Navigator": "YoYo", "Run Time 1": 21, "Run Time 2": 30}, "AutP": 3, "MisP": 93.76}
//        },
//        "pointValuesAndTollerances": {
//            "KnowPVal": -1,
//            "SimPVal": -1,
//            "FlyPVal": -1,
//            "AutPVal": -1,
//            "MisPVal": -1,
//            "KnowPChn": -2,
//            "SimPChn": -2,
//            "FlyPChn": -2,
//            "AutPChn": -2,
//            "MisPChn": -2
//        },
//        "date": "#",
//        "comments": "This is a Fake Group"
//    }
//  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
    </div>
    <h1><?php if ($authenticated and isset($successful)) {echo "Event Created Successfully";}?></h1>
    <p>Timestamp(Day-Month-Year - Hour:Minute:Second (Ante meridiem or Post meridiem)): <?php if ($authenticated and isset($successful)) {echo date("m/d/Y - h:i:s A");}?></p>
</body>
</html>