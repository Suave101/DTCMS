<?php session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true and $_SESSION["userData"]["role"]<2){$authenticated=true;}else{header("Location: login.php");die();}}else{header("Location: login.php");die();}?>
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
    <div class="verticalNav">
<?php 
$myfile = fopen("pswrds.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("pswrds.json"));
fclose($myfile);
$jsonData = json_decode($jsonFileString, true);
foreach(array_keys($jsonData) as $account) {
    // TODO: Make so Site Manager cannot see Hosts
    echo "<div class='account'><p>";
    echo $account;
    echo "</p></div>";
}
?>
    </div>
</body>
</html>
