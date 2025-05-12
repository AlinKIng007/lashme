<?php
// Include the file for database connection
include "connect.php";
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
    
}
else{
    header("location: index.php");
    exit();
}

if(isset($_POST['logout'])){
    header("location: logout.php");
    exit();
}

if(isset($_POST['update'])) {
    try {
        // Prepare an update statement
        $stmt = $conn->prepare("UPDATE `order` SET name = ?, state_id = ?, city = ?, address = ?, phone_number = ?, time_of_order = ?,amount = ? ,discount =? WHERE id = ?");

        // Bind parameters
        $stmt->bindParam(1, $_POST['name']);
        $stmt->bindParam(2, $_POST['state_id']); // Assuming you have state_id in your form
        $stmt->bindParam(3, $_POST['city']);
        $stmt->bindParam(4, $_POST['address']);
        $stmt->bindParam(5, $_POST['phone_number']);
        $stmt->bindParam(6, $_POST['time_of_order']);
        $stmt->bindParam(7, $_POST['amount']);
        $stmt->bindParam(8, $_POST['discount']);
        $stmt->bindParam(9, $_POST['id']); // Assuming the id is present in your form

        // Attempt to execute the statement
        if ($stmt->execute()) {
            echo "Record updated successfully";
            header("location: admin.php");
            exit();
        } else {
            echo "Error updating record";
        }
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Order</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $_POST['id'] ?? ''; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $_POST['name'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>
            <div class="mb-3">
                <label class="form-label">State:</label>
                <select class="form-select" name="state_id" style="background-color: #ff7eb9; color: white;">
                    <?php
                    // Fetch state names from the database
                    $sql = "SELECT id, state_name FROM state";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Check if the state name matches the one in $_POST, and mark it as selected
                        $selected = ($_POST['state_name'] ?? '') == $row['state_name'] ? 'selected' : '';
                        echo "<option value='".$row['id']."' ".$selected.">".$row['state_name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" name="city" value="<?php echo $_POST['city'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" name="address" value="<?php echo $_POST['address'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" class="form-control" name="phone_number" value="<?php echo $_POST['phone_number'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Amount:</label>
                <input type="text" class="form-control" name="amount" value="<?php echo $_POST['amount'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Discount:</label>
                <input type="number" min="0" max="100" class="form-control" name="discount" value="<?php echo $_POST['discount'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time of Order:</label>
                <input type="text" class="form-control" name="time_of_order" value="<?php echo $_POST['time_of_order'] ?? ''; ?>" style="background-color: #ff7eb9; color: white;">
            </div>
            <button type="submit" name="update" class="btn btn-primary" style="background-color: #ff1493; border-color: #ff1493;">Update</button>
            <button class="btn btn-secondary"><a href="admin.php" class="text-white" style="text-decoration: none;">Back to Orders</a></button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle (Popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
