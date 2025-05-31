<?php
// link to config.php
require_once ('config.php');
// connect to the database
function db_connect() {
    try {
        $dbh = new PDO(
            'mysql:host=' . DB_HOST . 
            ';port=' . DB_PORT . 
            ';dbname=' . DB_NAME, 
            DB_USER, 
            DB_PASS);
        // return if successful
        return $dbh;  
    } catch (PDOException $e) {
        // write any errors here
    }
}
?>
