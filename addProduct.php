<?php
    require_once('includes/db.php');
    // Create a new database instance
    $db = new Database();
    // Get the database connection
    $connection = $db->getConnection();

    