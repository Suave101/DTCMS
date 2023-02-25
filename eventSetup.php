<?php session_start();if(isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])){if($_SESSION["authenticated"]==true and $_SESSION["userData"]["role"]<2){$authenticated=true;}else{header("Location: login.php");die();}}else{header("Location: login.php");die();}?>
<!DOCTYPE html>
<head>
    <title>DTC - Scoring System</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
        <a href="#about">About</a>
    </div>
    <h1>Event Setup</h1>
    <form action="submitEvent.php" method="post">
        <div class="container">
          <label for="Event_ID"><b>Event ID</b></label>
          <input type="number" placeholder="Enter Event ID Number" name="Event_ID" min="1" required>
          <label for="Event_Grade"><b>Event Grade</b></label>
          <select name="Event_Grade">
            <option value="High School">High School</option>
            <option value="Middle School">Middle School</option>
            <option value="Elementry School">Elementry School</option>
          </select>
          <label for="Event_Date"><b>Event Date</b></label>
          <input type="date" name="Event_Date" required>
          <label for="Start_Time"><b>Start Time</b></label>
          <input type="time" name="Start_Time" required>
          <label for="End_Time"><b>End Time</b></label>
          <input type="time" name="End_Time" required>
          <button type="submit">Create</button>
        </div>
      </form>
</body>
</html>