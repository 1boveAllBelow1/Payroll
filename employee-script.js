// pang future proof lng toh baka lagay ko pa sa database
const employeeData = {
    id: 'EMP-001',
    name: 'John Doe',
    position: 'Software Developer',
    department: 'IT Department',
    email: 'john.doe@company.com',
    phone: '+63 912 345 6789',
    address: '123 Main Street, Makati City',
    dateHired: 'January 15, 2022',
    currentSalary: 45000,
    leaveBalance: 15,
    yearsOfService: 2.5
};

let leaveRequests = JSON.parse(localStorage.getItem('employeeLeaveRequests')) || [];
let salaryData = JSON.parse(localStorage.getItem('employeeSalaryData')) || generateSampleSalaryData();


document.addEventListener('DOMContentLoaded', function() {
    initializeNavigation();
    loadAccountSummary();
    loadLeaveData();
    loadSalaryData();
    setupEventListeners();
});


function initializeNavigation() {
    const navLinks = document.querySelectorAll('.nav-links a');
    const contentSections = document.querySelectorAll('.content-section');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
        
            if (this.getAttribute('href') === '#logout') {
                handleLogout();
                return;
            }

            const targetSection = this.getAttribute('href').substring(1);
            
      
            contentSections.forEach(section => {
                section.style.display = 'none';
            });


            const target = document.getElementById(targetSection);
            if (target) {
                target.style.display = 'block';
            }

            
            navLinks.forEach(navLink => navLink.classList.remove('active'));
            this.classList.add('active');

            
        });
    });

   
    if (navLinks.length > 0) {
        navLinks[0].classList.add('active');
    }
}


function loadAccountSummary() {
    document.getElementById('employeeName').textContent = employeeData.name;
    document.getElementById('employeePosition').textContent = employeeData.position;
    document.getElementById('employeeId').textContent = employeeData.id;
    document.getElementById('currentSalary').textContent = `₱${employeeData.currentSalary.toLocaleString()}`;
    document.getElementById('leaveBalance').textContent = `${employeeData.leaveBalance} days`;
    document.getElementById('yearsOfService').textContent = `${employeeData.yearsOfService} years`;
    
    
    document.getElementById('fullName').textContent = employeeData.name;
    document.getElementById('email').textContent = employeeData.email;
    document.getElementById('phone').textContent = employeeData.phone;
    document.getElementById('address').textContent = employeeData.address;
    document.getElementById('department').textContent = employeeData.department;
    document.getElementById('dateHired').textContent = employeeData.dateHired;
}


function setupEventListeners() {
   
    document.getElementById('leaveForm').addEventListener('submit', handleLeaveSubmission);
    
 
    document.getElementById('changePasswordForm').addEventListener('submit', handlePasswordChange);
    
    
    document.getElementById('yearFilter').addEventListener('change', filterLeaveReport);
}


function handleLeaveSubmission(e) {
    e.preventDefault();
    
    const leaveType = document.getElementById('leaveType').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const reason = document.getElementById('reason').value;
    
    
    const start = new Date(startDate);
    const end = new Date(endDate);
    const timeDiff = end.getTime() - start.getTime();
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;}