# Drone Team Challenge Managment System (DTCMS)
This system is a web based system meant to manage the Drone Team Challenge events and the scoring of those events. This system is based in PHP, Javascript, HTML, and CSS. Due to the use of PHP, you must download a PHP server to develop and contribute to the project.
> Here is the link to the [Windows PHP Server](https://windows.php.net/download#php-8.2)
The webservice has the following criteria:
- [ ] Security
- [X] Event Managment
- [ ] Point Managment and Display
- [ ] Ease of Use

Each of these points has a criteria under them but these are the four items that should be contributed to.
## Security
The webservice uses strictly PHP on the server side therefore, these are the encryption standards that should be implemented:
- Passwords must be hashed with [PBKDF2](https://www.php.net/manual/en/function.hash-pbkdf2.php) and passwords and user data should be encrypted with RSA. The desired RSA functions can be found [here](https://www.php.net/manual/en/book.openssl.php).
- User Data must be encrypted with AES-256
- All encryption should use an [Open SSL Certificate](https://www.php.net/manual/en/class.opensslcertificate.php) for authentication.

Due to security of the data on the webservice, the site will use the following trust structure:
| Title | Access | Access # |
| ----- | ----- | ----- |
| Host | Elevated Account Managment | 0 |
| Site Manager | Account Managment | 1 |
| Site Technician | Event Setup | 2 
| Event Manager | Event Managment | 3 |
| Event Technician | Score Managment | 4 |
| Event Judge | Score Input | 5 |
| Team Leader | My Account Details | 6 |
## Event Managment
The webservice should be able to manage events and store the scores, scoring criteria, and allowed attempts for every mission for that specific event and some comments on that event. Here is the data structure of an event:

Event Tag
- Event ID
- Event Grade (Ex. High School, Middle School, and Elementry School)
- Event Scores ([Data is strustured here](https://github.com/Suave101/DTCMS/tree/main#point-managment-and-display))
- Event Point Values and Tollerances
  - Knowledge Point Value
  - Simulation Point Value
  - Flight Point Value
  - Autonomous Point Value
  - Mission Possible Point Value
  - Knowledge Attempts
  - Simulation Attempts
  - Flight Attempts
  - Autonomous Attempts
  - Mission Possible Attempts
## Point Managment and Display
The webservice should be able to manage points scored at an event live and handle input conflicts.
Here is the datastructure for points scored at an event:

Team Name
- Team Members
- Knowledge Attempts
  - Name of Pilot
  - Points
- Simulation Attempts
  - Pilots
  - Run Time
- Flight Attempts
  - Pilot
  - Navigator
  - Points
- Autonomous Attempts
  - Cheif Programmer
  - Programmers
  - Points
- Mission Possible
  - Team Members
  - Points
## Ease of Use
The webservice should be easy to use.
