<?php
include('connect.php');
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $userinput = $_POST['username'];
    $passinput = $_POST['password'];
    $select_salt = $conn->prepare("
    SELECT 
    *
    FROM
    admin
    WHERE 
    username = ?;
    ");
    $select_salt->execute([$userinput]); // Pass an array containing the user input twice
    $salt_row = $select_salt->fetch(PDO::FETCH_ASSOC);
    if ($select_salt->rowCount() > 0) {
        $hash = $salt_row['hash'];
        $salt = $salt_row['salt'];
        $user_id = $salt_row['id'];

        // Combine salt, password, and a pepper string
        $fullhash = $salt . $passinput . "kjhKDSA374bsdakjnt2ijdfldajy";
        // Verify the password
        if (password_verify($fullhash, $hash)) {

            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $userinput;

            header('location:admin.php');
            exit(); // Always exit after redirecting

        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form1 {
            background-color: #ff7eb9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .username,
        .password {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ff1493; /* Pink border */
        }

        .submit {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff1493; /* Pink background */
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit:hover {
            background-color: #c71585; /* Darker pink on hover */
        }

        /* Animation */
        @keyframes slideIn {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form1 {
            animation: slideIn 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="main">
        <form class="form1" method="post">
            <input name="username" class="username form-control" type="text" placeholder="Username" required>
            <input name="password" class="password form-control" type="password" placeholder="Password" required>
            <button class="submit btn btn-primary" type="submit" name="login">Sign in</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle (Popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
