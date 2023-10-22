<?php
// deleteProducts.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

// Establish a database connection (replace with your database credentials)
$servername = "sql11.freemysqlhosting.net";
$username = "sql11654711";
$password = "RA23f72DPL";
$dbname = "sql11654711";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the item IDs to be deleted from the request
    $data = json_decode(file_get_contents("php://input"), true);
    $itemIdsToDelete = $data["itemIds"];

    // Prepare and execute a DELETE query for each item ID
    foreach ($itemIdsToDelete as $itemId) {
        $sql = "DELETE FROM products WHERE id = $itemId"; // Adjust table name and structure
        if ($conn->query($sql) === TRUE) {
            // Item deleted successfully
        } else {
            // Error occurred during deletion
            // You can log or handle the error as needed
            echo "Error deleting item with ID: $itemId";
        }
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
exit()
?>
