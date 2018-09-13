<html>
<head>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<table class="striped">
        <thead>
          <tr>
              <th>Database</th>
               </tr>
        </thead>
<tbody>
          <tr>
            <td>
            
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
            echo  '<a href="http://localhost/backuptool/db.php?dbname='.$database[0].'" class=“waves-effect btn”><i class="waves-effect default btn-large">'.$database[0].'</i></a> <br /><br />';
        }
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

$conn = null;
?>
            
            
            
            </td>
          </tr>
           </tbody>
      </table>
            

</body>

</html>
