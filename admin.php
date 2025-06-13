<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    function generatePassword($length = 10) {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
    }

    $password_plain = generatePassword();

   
    $year = date("Y");
    $result = $conn->query("SELECT employee_id 
                            FROM employee_credentials 
                            WHERE employee_id LIKE '$year%' 
                            ORDER BY employee_id DESC 
                            LIMIT 1");

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $lastId = $row['employee_id'];
        $lastNumber = (int)substr($lastId, 4);
        $newNumber = $lastNumber + 1;
        $newID = $year . str_pad($newNumber, 3, "0", STR_PAD_LEFT);
    } else {
        $newID = $year . "001";
    }

 
    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobileNo'];
    $branch = $_POST['branch'];
    $employee_id = $newID;
    $hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO employee_credentials 
                            (employee_id, full_name, email, mobile_no, branch, password) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $employee_id, $full_name, $email, $mobile_no, $branch, $hashed_password);

    if ($stmt->execute()) {
        
        $_SESSION['employee_added'] = true;
        $_SESSION['new_emp_id'] = $employee_id;
        $_SESSION['new_emp_password'] = $password_plain;
        $_SESSION['new_emp_name'] = $full_name;
        
        header("Location: " . $_SERVER['PHP_SELF'] . "#addemployee");
        exit;
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Employee Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Sidebar Navigation -->
    <nav class="sidebar">
        <h2>Group 3</h2>
            <ul class="nav-links">
                <li><a href="#dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="menu">
                    <a href="#transactions"><i class="fas fa-exchange-alt"></i> Transactions</a>
                    <ul class="nav-links sub">
                        <li><a href="#payoutreport">Payout Report</a></li>
                    </ul>
                </li>
                <li class="menu">
                    <a href="#employees"><i class="fas fa-users"></i> Employees</a>
                    <ul class="nav-links sub">
                        <li><a href="#addemployee"><i class="fas fa-user-plus"></i> Add Employees</a></li>
                        <li><a href="#employeeposition"><i class="fas fa-user-tie"></i> Employee Position</a></li>
                    </ul>
                </li>
                <li><a href="#attendance"><i class="fas fa-clipboard-list"></i> Attendance</a></li>
                <li><a href="#income"><i class="fas fa-chart-line"></i> Company's Income</a></li>
                <li class="menu">
                    <a href="#administration"><i class="fas fa-headset"></i> Administration</a>
                    <ul class="nav-links sub">
                        <li><a href="#addclass"><i class="fas fa-plus"></i> Add Class</a></li>
                    </ul>
                </li>
            <li>
                <form method="POST" action="logout.php" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-danger" style="width: 100%; padding: 8px 0;">
                          <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Section -->
        <section id="dashboard" class="content-section">
            <h1>Dashboard</h1>
            <div class="cards-container">
                <div class="card">
                    <h3>Total Employees</h3>
                    <p id="totalEmployees">0</p>
                </div>
                <div class="card">
                    <h3>Today's Attendance</h3>
                    <p id="todayAttendance">0%</p>
                </div>
                <div class="card">
                    <h3>Monthly Income</h3>
                    <p id="monthlyIncome">0</p>
                </div>
                <div class="card">
                    <h3>Pending Transactions</h3>
                    <p id="pendingTransactions">0</p>
                </div>
            </div>
        </section>

        <!-- Transactions Section -->
        <section id="transactions" class="content-section" style="display: none;">
            <h1>Transactions</h1>
        </section>
        
        <!-- Payout Report Section -->
        <section id="payoutreport" class="content-section" style="display: none;">
            <h1>Payout Report</h1>
            <div class="container">
                <div class="header">Salary Report</div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="2025">
                </div>
                <div class="form-group">
                    <label for="month">Month:</label>
                    <select id="month">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                </div>
                <button class="btn btn-primary">SELECT</button>
                <table>
                    <thead>
                        <tr>
                            <th>Basic Pay</th>
                            <th>Salary</th>
                            <th>Deduction</th>
                            <th>Allowance</th>
                            <th>Net Pay</th>
                            <th>View Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5000</td>
                            <td>40000</td>
                            <td>300</td>
                            <td>3000</td>
                            <td>42650</td>
                            <td class="receipt"><a href="#">View Receipt</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        
       
        <section id="employees" class="content-section" style="display: none;">
            <h1>Employees</h1>
        </section>
        
   
        <section id="addemployee" class="content-section" style="display: none;">
            <h1>Add Employee</h1>
            
           
            <?php if (isset($error_message)): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
        
            <?php if (isset($_SESSION['employee_added']) && $_SESSION['employee_added'] === true): ?>
                <div class="alert alert-success">
                    <h3><i class="fas fa-check-circle"></i> Employee Added Successfully!</h3>
                    <div class="employee-details">
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['new_emp_name']); ?></p>
                        <p><strong>Employee ID:</strong> 
                            <span class="employee-id"><?php echo htmlspecialchars($_SESSION['new_emp_id']); ?></span>
                        </p>
                        <p><strong>Generated Password:</strong> 
                            <span class="password"><?php echo htmlspecialchars($_SESSION['new_emp_password']); ?></span>
                        </p>
                    </div>
                    <p class="info-text">
                        <i class="fas fa-info-circle"></i> 
                        Please copy this password and provide it to the employee.
                    </p>
                </div>
                <?php
               
                unset($_SESSION['employee_added']);
                unset($_SESSION['new_emp_id']);
                unset($_SESSION['new_emp_password']);
                unset($_SESSION['new_emp_name']);
                ?>
            <?php endif; ?>
            
            <!-- Add Employee Form -->
            <div class="card form-card">
                <form id="addEmployeeForm" action="<?php echo $_SERVER['PHP_SELF']; ?>#addemployee" method="POST">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" placeholder="Enter full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mobileNo">Mobile Number</label>
                        <input type="tel" id="mobileNo" name="mobileNo" placeholder="Enter mobile number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="branch">Branch/Department</label>
                        <select id="branch" name="branch" required>
                            <option value="">Select Branch</option>
                            <option value="IT">Information Technology</option>
                            <option value="HR">Human Resources</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                            <option value="Sales">Sales</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Employee
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Clear Form
                        </button>
                    </div>
                </form>
            </div>
        </section>
        
        <!-- Employee Position Section -->
        <section id="employeeposition" class="content-section" style="display: none;">
            <h1>Employee Position</h1>
            <div class="table-container">
                <table class="employee-table">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Branch</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM employee_credentials ORDER BY employee_id DESC");

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['employee_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['mobile_no']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['branch']) . "</td>";
                                echo "<td>
                                        <form method='POST' action='remove_employee.php' class='inline-form' 
                                              onsubmit='return confirm(\"Are you sure you want to remove " . htmlspecialchars($row['full_name']) . "?\")'>
                                            <input type='hidden' name='employee_id' value='" . htmlspecialchars($row['employee_id']) . "'>
                                            <button type='submit' class='btn btn-danger btn-sm'>
                                                <i class='fas fa-trash'></i> Remove
                                            </button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='no-data'>No employees found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Attendance Section -->
        <section id="attendance" class="content-section" style="display: none;">
            <div class="attendance-header">
                <div class="month-navigation">
                    <button class="btn" onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                    <h2 id="currentMonth">January 2025</h2>
                    <button class="btn" onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button class="btn btn-primary" onclick="showAddEmployeeModal()">
                    <i class="fas fa-user-plus"></i> Add Employee
                </button>
            </div>
        
            <div class="attendance-table">
                <table id="attendanceTable">
                    <thead>
                        <tr>
                            <th>Employee</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        
            <div class="legend">
                <div class="legend-item">
                    <div class="status-cell none"></div>
                    <span>None</span>
                </div>
                <div class="legend-item">
                    <div class="status-cell present"></div>
                    <span>Present</span>
                </div>
                <div class="legend-item">
                    <div class="status-cell late"></div>
                    <span>Late</span>
                </div>
                <div class="legend-item">
                    <div class="status-cell absent"></div>
                    <span>Absent</span>
                </div>
            </div>
        </section>
        
        <!-- Employee Modal -->
        <div class="modal-overlay" id="employeeModalOverlay"></div>
        <div class="modal" id="employeeModal">
            <h3>Add New Employee</h3>
            <form onsubmit="addEmployee(event)">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="employeeName" required>
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" id="employeePosition" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEmployeeModal()">Cancel</button>
                </div>
            </form>
        </div>

        <!-- Company's Income Section -->
        <section id="income" class="content-section" style="display: none;">
            <div class="section-header">
                <h1>Income Management</h1>
                <button class="btn btn-primary" onclick="showAddModal()">
                    <i class="fas fa-plus"></i> Add Income
                </button>
            </div>
        
            <div class="summary-cards">
                <div class="summary-card total-income">
                    <h3>Total Income</h3>
                    <p id="totalIncome">$0</p>
                </div>
                <div class="summary-card avg-income">
                    <h3>Average Daily</h3>
                    <p id="avgIncome">$0</p>
                </div>
                <div class="summary-card highest-income">
                    <h3>Highest Income</h3>
                    <p id="highestIncome">$0</p>
                </div>
            </div>
        
            <div class="card">
                <h2>Income Trends</h2>
                <div class="chart-container">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        
            <div class="card">
                <div class="filter-section">
                    <select id="filterMonth" onchange="updateDisplay()">
                        <option value="all">All Months</option>
                    </select>
                </div>
                <div class="income-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Source</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="incomeTable">
                        </tbody>
                    </table>
                </div>
            </div>
        
            <!-- Income Modal -->
            <div class="modal" id="incomeaddModal" style="display: none;">
                <div class="modal-content">
                    <h3>Add New Income</h3>
                    <form onsubmit="addIncome(event)">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" id="incomeDate" required>
                        </div>
                        <div class="form-group">
                            <label>Source</label>
                            <input type="text" id="incomeSource" required>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" step="0.01" id="incomeAmount" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select id="incomeType" required>
                                <option value="basic">Basic</option>
                                <option value="premium">Premium</option>
                                <option value="subscription">Subscription</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select id="incomeStatus" required>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Income</button>
                            <button type="button" class="btn btn-secondary" onclick="hideModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Administration Section -->
        <section id="administration" class="content-section" style="display: none;">
            <h1>Administration</h1>
        </section>
          
        <!-- Add Class Section -->
        <section id="addclass" class="content-section" style="display: none;">
            <h1>Add Class</h1>
        </section>
    </div>

    
    <script src="script.js"></script>
    <script>
       
       document.addEventListener('DOMContentLoaded', function() {
           
            function showSection(sectionId) {
   
                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => section.style.display = 'none');
                
             
                const targetSection = document.getElementById(sectionId);
                if (targetSection) {
                    targetSection.style.display = 'block';
                }
                
            
                const navLinks = document.querySelectorAll('.nav-links a');
                navLinks.forEach(link => link.classList.remove('active'));
                
                const activeLink = document.querySelector(`a[href="#${sectionId}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
            
          
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                showSection('addemployee');
            <?php else: ?>
                const hash = window.location.hash.substring(1);
                showSection(hash || 'dashboard');
            <?php endif; ?>
            
         
            document.querySelectorAll('.nav-links a[href^="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('href').substring(1);
                    showSection(sectionId);
                    window.location.hash = sectionId;
                });
            });
            

            window.addEventListener('hashchange', function() {
                const hash = window.location.hash.substring(1);
                if (hash) showSection(hash);
            });
        });

    </script>

    <?php $conn->close(); ?>

</body>
</html>