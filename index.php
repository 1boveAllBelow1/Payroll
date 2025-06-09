<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
        }
        input, select {
            margin-left: auto;
            margin-right: auto;
            display: block;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 5px;
        }
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-primary {
            background: #2ecc71;
            color: white;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .label {
            display: block;
            text-align: center;
            margin: 0 auto 5px auto;
        }
        h1 {
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Login</h1>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('connect.php');  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userType = $_POST['user_type']; 
        $userId = $_POST['user_id'];
        $userPass = $_POST['user_pass'];

        if ($userType === 'admin') {
            $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ? AND admin_pass = ?");
        } else {
            $stmt = $conn->prepare("SELECT * FROM employee WHERE employee_id = ? AND employee_pass = ?");
        }

        $stmt->bind_param("is", $userId, $userPass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            session_start();
            if ($userType === 'admin') {
                $_SESSION['admin_id'] = $userId;
                header("Location: admin.php");
            } else {
                $_SESSION['employee_id'] = $userId;
                header("Location: employee.php");
            }
            exit;
        } else {
            echo "<p style='color: red; text-align:center;'>❌ Invalid ID or password.</p>";
        }
    }
    ?>

    <form method="POST">
        <label class="label">User Type:</label>
        <select name="user_type" required>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
        </select><br>

        <label class="label">User ID:</label>
        <input type="text" name="user_id" placeholder="UserID" required><br>

        <label class="label">Password:</label>
        <input type="password" name="user_pass" placeholder="Password" required><br>

        <input type="submit" class="btn btn-primary label" value="Login">
    </form>
</div>

</body>
</html>
