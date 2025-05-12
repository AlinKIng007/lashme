<?php
// Include the file for database connection
include "connect.php";

if (!isset($_POST['searchTerm'])) {
    exit("No search term provided");
}

$searchTerm = '%' . $_POST['searchTerm'] . '%';

// Prepare SQL query with a WHERE clause for search
$sql = "SELECT o.*, s.state_name, s.delivery_cost
        FROM `order` o 
        INNER JOIN `state` s ON s.id = o.state_id
        WHERE o.name LIKE :searchTerm 
        OR o.city LIKE :searchTerm 
        OR o.address LIKE :searchTerm 
        OR o.phone_number LIKE :searchTerm 
        OR s.state_name LIKE :searchTerm";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
$stmt->execute();

// Output data of each row
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Output each row as table row
    $total = ($row["amount"] * 25000 + $row["delivery_cost"]) - ($row["discount"] / 100) * ($row["amount"] * 25000 + $row["delivery_cost"]);
    echo "
    <tr>
        <td>" . $row["id"] . "</td>
        <td>" . $row["name"] . "</td>
        <td>" . $row["state_name"] . "</td>
        <td>" . $row["city"] . "</td>
        <td>" . $row["address"] . "</td>
        <td>" . $row["phone_number"] . "</td>
        <td>" . $row["amount"] . "</td>
        <td>%" . $row["discount"] . "</td>
        <td>" . $total . "</td>
        <td>" . $row["time_of_order"] . "</td>
        <td>
            <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                <input type='hidden' name='id' value='" . $row["id"] . "'>
                <button name='delete' class='btn btn-danger'>Delete</button>
            </form>
            <form method='post' action='edit.php'>
                <input type='hidden' name='id' value='" . $row["id"] . "'>
                <input type='hidden' name='name' value='" . $row["name"] . "'>
                <input type='hidden' name='state_name' value='" . $row["state_name"] . "'>
                <input type='hidden' name='city' value='" . $row["city"] . "'>
                <input type='hidden' name='address' value='" . $row["address"] . "'>
                <input type='hidden' name='phone_number' value='" . $row["phone_number"] . "'>
                <input type='hidden' name='amount' value='" . $row["amount"] . "'>
                <input type='hidden' name='time_of_order' value='" . $row["time_of_order"] . "'>
                <input type='hidden' name='discount' value='" . $row["discount"] . "'>
                <button name='edit' class='btn btn-pink'>Edit</button>
            </form>
        </td>
    </tr>";
}
?>
