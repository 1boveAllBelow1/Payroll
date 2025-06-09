<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee - Payroll System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="employee-style.css">
</head>
<body>
    <nav class="sidebar">
        <h2>Group 3</h2>
        <ul class="nav-links">
            <li><a href="#account-summary"><i class="fas fa-user-circle"></i> Account Summary</a></li>
            <li><a href="#leave"><i class="fas fa-calendar-alt"></i> Leave Request</a></li>
            <li><a href="#leave-report"><i class="fas fa-clipboard-list"></i> Leave Report</a></li>
            <li><a href="#salary-report"><i class="fas fa-chart-line"></i> Salary Report</a></li>
            <li><a href="#change-password"><i class="fas fa-key"></i> Change Password</a></li>
            <li><a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <!-- ac -->
        <section id="account-summary" class="content-section">
            <h1>Account Summary</h1>
            <div class="cards-container">
                <div class="card profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="profile-info">
                            <h3 id="employeeName">John Doe</h3>
                            <p id="employeePosition">Software Developer</p>
                            <p id="employeeId">EMP-001</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h3>Current Salary</h3>
                    <p id="currentSalary">₱45,000</p>
                </div>
                <div class="card">
                    <h3>Leave Balance</h3>
                    <p id="leaveBalance">15 days</p>
                </div>
                <div class="card">
                    <h3>Years of Service</h3>
                    <p id="yearsOfService">2.5 years</p>
                </div>
            </div>
            
            <div class="card">
                <h3>Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Full Name:</label>
                        <span id="fullName">John Doe</span>
                    </div>
                    <div class="info-item">
                        <label>Email:</label>
                        <span id="email">john.doe@company.com</span>
                    </div>
                    <div class="info-item">
                        <label>Phone:</label>
                        <span id="phone">+63 912 345 6789</span>
                    </div>
                    <div class="info-item">
                        <label>Address:</label>
                        <span id="address">123 Main Street, Makati City</span>
                    </div>
                    <div class="info-item">
                        <label>Department:</label>
                        <span id="department">IT Department</span>
                    </div>
                    <div class="info-item">
                        <label>Date Hired:</label>
                        <span id="dateHired">January 15, 2022</span>
                    </div>
                </div>
            </div>
        </section>

        <!--rl-->
        <section id="leave" class="content-section" style="display: none;">
            <h1>Leave Request</h1>
            <div class="card">
                <h3>Submit Leave Request</h3>
                <form id="leaveForm">
                    <div class="form-group">
                        <label for="leaveType">Leave Type</label>
                        <select id="leaveType" required>
                            <option value="">Select Leave Type</option>
                            <option value="vacation">Vacation Leave</option>
                            <option value="sick">Sick Leave</option>
                            <option value="emergency">Emergency Leave</option>
                            <option value="maternity">Maternity Leave</option>
                            <option value="paternity">Paternity Leave</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" id="endDate" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea id="reason" rows="4" placeholder="Please provide reason for leave request..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Submit Request
                    </button>
                </form>
            </div>

            <div class="card">
                <h3>Recent Leave Requests</h3>
                <div class="table-container">
                    <table id="recentLeaveTable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Applied Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Recent leave requests will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- lReport -->
        <section id="leave-report" class="content-section" style="display: none;">
            <h1>Leave Report</h1>
            <div class="cards-container">
                <div class="card">
                    <h3>Total Leave Days</h3>
                    <p id="totalLeaveDays">21 days</p>
                </div>
                <div class="card">
                    <h3>Used Leave Days</h3>
                    <p id="usedLeaveDays">6 days</p>
                </div>
                <div class="card">
                    <h3>Remaining Leave</h3>
                    <p id="remainingLeave">15 days</p>
                </div>
                <div class="card">
                    <h3>Pending Requests</h3>
                    <p id="pendingRequests">2 requests</p>
                </div>
            </div>

            <div class="card">
                <div class="filter-section">
                    <label for="yearFilter">Filter by Year:</label>
                    <select id="yearFilter">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                </div>
                <div class="table-container">
                    <table id="leaveReportTable">
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Approved By</th>
                                <th>Applied Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!--  sReport Section -->
        <section id="salary-report" class="content-section" style="display: none;">
            <h1>Salary Report</h1>
            <div class="card">
                <div class="filter-section">
                    <div class="form-group">
                        <label for="salaryYear">Year:</label>
                        <select id="salaryYear">
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="salaryMonth">Month:</label>
                        <select id="salaryMonth">
                            <option value="">All Months</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" onclick="filterSalaryReport()">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                
                <div class="table-container">
                    <table id="salaryReportTable">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Basic Pay</th>
                                <th>Allowances</th>
                                <th>Deductions</th>
                                <th>Gross Pay</th>
                                <th>Net Pay</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Salary history will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Change Password Section -->
        <section id="change-password" class="content-section" style="display: none;">
            <h1>Change Password</h1>
            <div class="card" style="max-width: 500px; margin: 0 auto;">
                <h3>Update Your Password</h3>
                <form id="changePasswordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" placeholder="Enter current password" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmNewPassword">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key"></i> Change Password
                    </button>
                </form>
            </div>
        </section>
    </div>

    <!-- Success/Error Messages Modal -->
    <div class="modal-overlay" id="messageModalOverlay"></div>
    <div class="modal" id="messageModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Success</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modalMessage">Operation completed successfully!</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModal()">OK</button>
            </div>
        </div>
    </div>

    <script src="employee-script.js"></script>
</body>
</html>