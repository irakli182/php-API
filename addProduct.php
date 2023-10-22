<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

$data = file_get_contents('php://input');
$skuData = json_decode($data, true);

if ($skuData !== null) {

    $servername = "sql11.freemysqlhosting.net";
    $username = "sql11654711";
    $password = "RA23f72DPL";
    $dbname = "sql11654711";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sku = $skuData['sku'];
        $name = $skuData['name'];
        $price = $skuData['price'];
        $size = $skuData['size'];
        $height = $skuData['height'];
        $width = $skuData['width'];
        $length = $skuData['length'];
        $weight = $skuData['weight'];

        // Create a prepared statement
        $stmt = $conn->prepare("INSERT INTO products (sku, name, price, size, height, width, length, weight) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the parameters and execute the statement
        $stmt->execute([$sku, $name, $price, $size, $height, $width, $length, $weight]);

        echo "Data inserted successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo 'Invalid data received from the client.';
}
exit()
?>
