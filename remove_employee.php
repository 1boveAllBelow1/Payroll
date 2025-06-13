<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['employee_id'])) {
    
    $employee_id = $_POST['employee_id'];
    

    if (empty($employee_id)) {
        $_SESSION['error_message'] = "Invalid employee ID provided.";
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#employeeposition");
        exit;
    }
    

    $check_stmt = $conn->prepare("SELECT full_name FROM employee_credentials WHERE employee_id = ?");
    $check_stmt->bind_param("s", $employee_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows === 0) {
        $_SESSION['error_message'] = "Employee not found.";
        $check_stmt->close();
        $conn->close();
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#employeeposition");
        exit;
    }
    
    $employee_data = $result->fetch_assoc();
    $employee_name = $employee_data['full_name'];
    $check_stmt->close();
    
  
    $delete_stmt = $conn->prepare("DELETE FROM employee_credentials WHERE employee_id = ?");
    $delete_stmt->bind_param("s", $employee_id);
    
    if ($delete_stmt->execute()) {
        if ($delete_stmt->affected_rows > 0) {
            $_SESSION['success_message'] = "Employee '" . htmlspecialchars($employee_name) . "' has been successfully removed.";
        } else {
            $_SESSION['error_message'] = "No employee was removed. Please try again.";
        }
    } else {
        $_SESSION['error_message'] = "Error removing employee: " . $delete_stmt->error;
    }
    
    $delete_stmt->close();
    
} else {
    $_SESSION['error_message'] = "Invalid request. No employee ID provided.";
}

$conn->close();


$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
if (strpos($redirect_url, '#') === false) {
    $redirect_url .= '#employeeposition';
}
header("Location: " . $redirect_url);
exit;
?>