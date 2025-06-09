<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <nav class="sidebar">
        <h2>Group 3</h2>
        <ul class="nav-links">
            <li><a href="#dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="menu"><a href="#transactions"><i class="fas fa-exchange-alt"></i> Transactions</a>
            <ul class="nav-links sub">
                <li><a href="#payoutreport">Payout Report</a></li>
            </ul></li>
            <li class="menu"><a href="#employees"><i class="fas fa-users"></i> Employees</a>
            <ul class="nav-links sub">
                <li><a href="#addemployee"><i class="fas fa-user-plus"></i> Add Employees</a></li>
                <li><a href="#employeeposition"><i class="fas fa-user-tie"></i>  Employee Position</a></li>
            </ul></li>
            <li><a href="#attendance"><i class="fas fa-clipboard-list"></i> Attendance</a></li>
            <li><a href="#income"><i class="fas fa-chart-line"></i> Company's Income</a></li>
            <li class="menu"><a href="#administration"><i class="fas fa-headset"></i> Administration</a>
            <ul class="nav-links sub">
                <li><a href="#addclass"><i class="fas fa-plus"></i> Add Class</a></li>
            </ul></li>
        </ul>
    </nav>
    
    <div class="main-content">
        <!--Dashboard Section-->
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

        <!--Transactions Section-->
        <section id="transactions" class="content-section" style="display: none;">
            <h1>Transactions</h1>
        </section>
        
        <!--Payout report-->
        <section id="payoutreport" class="content-section" style="display: none;">
            <h1>Payout Report</h1>
            <div class="container">
                <div class="header">Salary Report</div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="2015">
                </div>
                <div class="form-group">
                    <label for="month">Month:</label>
                    <select id="month">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                    </select>
                </div>
                <button>SELECT</button>
                <table>
                    <tr>
                        <th>BasicPay</th>
                        <th>Salary</th>
                        <th>Deduction</th>
                        <th>Allowance</th>
                        <th>NetPay</th>
                        <th>View Receipt</th>
                    </tr>
                    <tr>
                        <td>5000</td>
                        <td>40000</td>
                        <td>300</td>
                        <td>3000</td>
                        <td>42650</td>
                        <td class="receipt"><a href="#">View Receipt</a></td><br><br>
                    </tr>
                </table>
            </div>
        </section>
        
        <!--Employees List Section-->
        <section id="employees" class="content-section" style="display: none;">
            <h1>Employees</h1>
        </section>
        
        <!--Add Employee-->
        <section id="addemployee" class="content-section" style="display: none;">
            <h1>Add Employee</h1>
            <div class="card" style="max-width: 600px; margin: 0 auto;">
                <form id="addEmployeeForm" action="#" method="post">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label for="mobileNo">Mobile No.</label>
                        <input type="tel" id="mobileNo" name="mobileNo" placeholder="Mobile No." required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <select id="branch" name="branch" required>
                            <option value="">Select Branch</option>
                            <option value="IT">IT</option>
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                            <option value="Sales">Sales</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select id="designation" name="designation" required>
                            <option value="">Select Designation</option>
                            <option value="Manager">Manager</option>
                            <option value="Accountant">Accountant</option>
                            <option value="HR Executive">HR Executive</option>
                            <option value="Developer">Developer</option>
                            <option value="Sales Executive">Sales Executive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="basicPay">Basic Pay</label>
                        <input type="number" id="basicPay" name="basicPay" placeholder="Basic Pay" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Employee
                    </button>
                    <button type="reset" class="btn">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </form>
            </div>
        </section>
        
        <!--Employee Position-->
        <section id="employeeposition" class="content-section" style="display: none;">
            <h1>Employee Position</h1>
        </section>

        <!--Attendance Section-->
        <section id="attendance" class="content-section" style="display: none;">
            <div class="attendance-header">
                <div class="month-navigation">
                    <button class="btn" onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                    <h2 id="currentMonth">January 2023</h2>
                    <button class="btn" onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button class="btn btn-primary" onclick="showAddEmployeeModal()"><i class="fas fa-user-plus"></i> Add Employee</button>
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
                    <span>none</span>
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
                <button type="submit" class="btn btn-primary">Add Employee</button>
                <button type="button" class="btn" onclick="closeEmployeeModal()">Cancel</button>
            </form>
        </div>

        <!--Company's Income Section-->
        <section id="income" class="content-section" style="display: none;">
            <div class="header">
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
                                <option value="black">Black</option>
                                <option value="Premium">Premium</option>
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
                        <button type="submit" class="btn btn-primary">Add Income</button>
                        <button type="button" class="btn" onclick="hideModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </section>

        <section id="administration" class="content-section" style="display: none;">
            <h1>Administration</h1>
        </section>
          
        <section id="addclass" class="content-section" style="display: none;">
            <h1>Add Class</h1>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>