<?php
// Include the file for database connection
include "connect.php";
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

if (isset($_POST['logout'])) {
    header("location: logout.php");
    exit();
}

if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    try {
        // Prepare a delete statement
        $stmt = $conn->prepare("DELETE FROM `order` WHERE id = ?");

        // Bind the parameter
        $stmt->bindParam(1, $id);

        // Attempt to execute the statement
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record";
        }
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}

// Pagination variables
$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$start = ($page - 1) * $limit; // Offset

try {
    // Count total records
    $countQuery = "SELECT COUNT(*) AS total FROM `order`";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->execute();
    $row = $countStmt->fetch(PDO::FETCH_ASSOC);
    $totalRecords = $row['total'];

    // Fetch data from the database with pagination
    $sql = "SELECT o.*, s.state_name, s.delivery_cost
            FROM `order` o 
            INNER JOIN `state` s ON s.id = o.state_id";
    
    // Append WHERE clause for search
    if (isset($_POST['searchTerm'])) {
        $searchTerm = '%' . $_POST['searchTerm'] . '%';
        $sql .= " WHERE o.name LIKE :searchTerm 
                  OR o.city LIKE :searchTerm 
                  OR o.address LIKE :searchTerm 
                  OR o.phone_number LIKE :searchTerm 
                  OR s.state_name LIKE :searchTerm";
    }

    $sql .= " LIMIT :start, :limit";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    // Bind the search term parameter if set
    if (isset($_POST['searchTerm'])) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }
    
    $stmt->execute();

    // Output data of each row
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Your existing code here
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            padding: 20px;
        }

        .table {
            background-color: #ff7eb9; /* Pink background */
        }

        .table th {
            background-color: #ff1493; /* Pink header */
            color: white;
        }

        .table td, .table th {
            border-color: #ff1493; /* Pink border */
        }

        .btn-pink {
            background-color: #ff1493; /* Pink button */
            border-color: #ff1493; /* Pink border */
            color: white;
        }

        .btn-pink:hover {
            background-color: #c71585; /* Darker pink on hover */
            border-color: #c71585; /* Darker pink border on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Order Table</h2>
    <form method="post" class="text-end mb-4">
        <button name="logout" class="btn btn-pink">Log Out</button>
    </form>
    <!-- Search Bar -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="searchTerm" placeholder="Search for name or city...">
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Amount</th>
            <th>discount</th>
            <th>Total</th>
            <th>Time of Order</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="tableBody">

        <?php
        try {
            // Fetch data from the database
            $sql = "SELECT o.*, s.state_name ,s.delivery_cost
            FROM `order` o 
            INNER JOIN `state` s ON s.id = o.state_id
            LIMIT :start, :limit";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            // Output data of each row
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $total = 0;
                if ($row["discount"] === 0) {
                    $total = $row["amount"] * 25000 + $row["delivery_cost"];
                } else {
                    $total = ($row["amount"] * 25000 + $row["delivery_cost"]) - ($row["discount"] / 100) * ($row["amount"] * 25000 + $row["delivery_cost"]);
                }
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        </tbody>
    </table>
    <div class="pagination">
        <ul class="pagination">
            <?php
            $totalPages = ceil($totalRecords / $limit); // Calculate total pages
            $pagLink = "";
            for ($i = 1; $i <= $totalPages; $i++) {
                $pagLink .= "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
            };
            echo $pagLink;
            ?>
        </ul>
    </div>
</div>

<!-- Bootstrap JS Bundle (Popper.js included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#searchTerm").keyup(function () {
            var searchTerm = $(this).val().toLowerCase();
            $("tbody tr").each(function () {
                var name = $(this).find("td:nth-child(2)").text().toLowerCase();
                var city = $(this).find("td:nth-child(4)").text().toLowerCase();
                if (name.includes(searchTerm) || city.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

    $(document).ready(function () {
    $("#searchTerm").keyup(function () {
        var searchTerm = $(this).val().toLowerCase();
        $.ajax({
            type: "POST",
            url: "search.php", // Replace "search.php" with the file where your search logic is implemented
            data: { searchTerm: searchTerm },
            success: function (response) {
                $("#tableBody").html(response);
            }
        });
    });
});

</script>
</body>
</html>
