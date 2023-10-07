<?php
// Get the requested URL
$url = isset($_GET['url']) ? $_GET['url'] : '/';

// Define routes and their corresponding actions
$routes = [
    '/' => ['home', 'GET'],
    
    'contact' => ['contact', 'GET'],
    'api/product/add' => ['addForm', 'GET'],
    
];
// Include the database class file
require_once('includes/db.php');
// Create a new database instance
$db = new Database();
// Get the database connection
$connection = $db->getConnection();

// Check if the requested URL is in the list of routes
if (isset($routes[$url])) {
    $action = $routes[$url];
    
    // Include and execute the corresponding PHP file or function
    include "$action[0].php";
    if($action[0] == "home"){
        echo "<table border='1'>";
        echo "<tr><th>Routes</th><th>Method</th></tr>";
        foreach ($routes as $url => $action) {
            echo "<tr><td><a href='$url' target='_blank'>$url</a></td><td>$action[1]</td></tr>";
        }
        echo "</table>";
    }
} else {
    // Handle a 404 Not Found error
    print_r($url);
    include "404.php";
}
?>
