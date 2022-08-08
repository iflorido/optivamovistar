<?php
echo "Hello there, this is a PHP Apache container";
?>
<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'localhost';

// Database use name
$user = 'optima';

//database user password
$pass = 'Optima_123456';

// database name
$mydatabase = 'optima';
// check the mysql connection status

$conn = new mysqli($host, $user, $pass, $mydatabase);

// select query
$sql = 'SELECT * FROM movimientos';

if ($result = $conn->query($sql)) {
    echo "me he conectado correctamente";
    while ($data = $result->fetch_object()) {
        $users[] = $data;
    }
}

foreach ($users as $user) {
    echo "<br>";
    echo $user->tipo . " " . $user->cantidad;
    echo "<br>";
}
//test
?>

