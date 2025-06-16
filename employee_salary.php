<?php

include 'connect.php';
echo "<pre>";
print_r($_POST);
echo "</pre>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee = $_POST['employee'] ?? '';
    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? '';
    $class = $_POST['class'] ?? '';

    $base_salary = (float)$_POST['base_salary'];
    $sss = (float)$_POST['sss_deduction'];
    $philhealth = (float)$_POST['philhealth_deduction'];
    $pagibig = (float)$_POST['pagibig_deduction'];
    $taxable = (float)$_POST['taxable_income'];
    $tax = (float)$_POST['tax'];
    $net = (float)$_POST['net_income'];

    if (!$employee || !$month || !$year || !$class) {
        echo "Missing fields.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO employee_payroll (
        employee_id, class_name, payroll_month, payroll_year,
        base_salary, sss_deduction, philhealth_deduction,
        pagibig_deduction, taxable_income, tax, net_income
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssiddddddd",
        $employee, $class, $month, $year,
        $base_salary, $sss, $philhealth,
        $pagibig, $taxable, $tax, $net
    );

    if ($stmt->execute()) {
        echo "✅ Payroll saved!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
