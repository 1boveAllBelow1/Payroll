<?php

print_r($_POST);
exit;

session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $class_name = $_POST['className'];
    $Salary = $_POST['Salary'];

    $stmt = $conn->prepare("INSERT INTO classes (class_name, Salary) VALUES (?, ?)");
    $stmt->bind_param("si", $class_name, $Salary);

    if ($stmt->execute()) {
        $_SESSION["class_added"] = true;
        $_SESSION["new_Salary"] = $Salary;
        $_SESSION["new_class_name"] = $class_name;

        $_SESSION['show_section'] = 'addclass';
        header("Location: admin.php#addclass");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
