<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['user_type']; // 'admin' or 'employee'
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
        echo "<p style='color: red;'>❌ Invalid ID or password.</p>";
    }
}
?>

<form method="POST">
    <label>User Type:
        <select name="user_type" required>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
        </select>
    </label><br><br>

    <label>User ID:
        <input type="text" name="user_id" placeholder="UserID" required>
    </label><br><br>

    <label>Password:
        <input type="password" name="user_pass" placeholder="Password" required>
    </label><br><br>

    <input type="submit" value="Login">
</form>
