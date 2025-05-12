<?php
// Include the file for database connection
include "connect.php";

// Retrieve the state ID and amount from the POST request
$stateID = $_POST['state_id'] ?? 0;
$amount = $_POST['amount'] ?? 0;

// Initialize delivery cost variable
$deliveryCost = 0;

try {
    // Prepare and execute the SQL query to fetch delivery_cost from the state table
    $sql = "SELECT delivery_cost FROM state WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$stateID]);

    // Fetch the delivery_cost
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $deliveryCost = $row['delivery_cost'] ?? 0;
} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}

// Send the total cost back as the response
echo $deliveryCost;
?>
