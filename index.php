<html>
<head>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Databases</title>

	</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backup-tool";

try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT DISTINCT SCHEMA_NAME AS `database`
        FROM information_schema.SCHEMATA
    WHERE  SCHEMA_NAME NOT IN ('information_schema', 'performance_schema', 'mysql')
    ORDER BY SCHEMA_NAME");
        $stmt->execute();
        $result = $stmt->fetchall();
        foreach($result as $database) {
            echo  '<a href="http://localhost/backuptool/db.php?dbname='.$database[0].'" class=“waves-effect waves-light btn”>'.$database[0].'</a> <br /><br />';
        
        }
        }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

$conn = null;
?>

</html>
