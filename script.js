
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetSection = this.getAttribute('href');
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector(targetSection).style.display = 'block';
    });
});


let incomeData = JSON.parse(localStorage.getItem('income')) || [];
let incomeChart;

function initChart() {
    const ctx = document.getElementById('incomeChart').getContext('2d');
    incomeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Income Trend',
                data: [],
                borderColor: '#2ecc71',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(46, 204, 113, 0.1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}


function updateDisplay() {
    const total = incomeData.reduce((sum, item) => sum + item.amount, 0);
    document.getElementById('totalIncome').textContent = `P${total.toFixed(2)}`;

    const avg = incomeData.length ? total / incomeData.length : 0;
    document.getElementById('avgIncome').textContent = `P${avg.toFixed(2)}`;

    const highest = Math.max(...incomeData.map(item => item.amount), 0);
    document.getElementById('highestIncome').textContent = `P${highest.toFixed(2)}`;

    const monthlyData = groupByMonth(incomeData);
    incomeChart.data.labels = Object.keys(monthlyData);
    incomeChart.data.datasets[0].data = Object.values(monthlyData);
    incomeChart.update();

    const tbody = document.getElementById('incomeTable');
    tbody.innerHTML = incomeData.map(item => `
        <tr>
            <td>${new Date(item.date).toLocaleDateString()}</td>
            <td>${item.source}</td>
            <td>P${item.amount.toFixed(2)}</td>
            <td>${capitalize(item.type)}</td>
            <td><span class="status ${item.status}">${capitalize(item.status)}</span></td>
            <td>
                <button onclick="deleteIncome('${item.id}')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    `).join('');
}


function addIncome(e) {
    e.preventDefault();
    const newIncome = {
        id: Date.now().toString(),
        date: document.getElementById('incomeDate').value,
        source: document.getElementById('incomeSource').value,
        amount: parseFloat(document.getElementById('incomeAmount').value),
        type: document.getElementById('incomeType').value,
        status: document.getElementById('incomeStatus').value
    };

    incomeData.push(newIncome);
    localStorage.setItem('income', JSON.stringify(incomeData));
    hideModal();
    updateDisplay();
}

function groupByMonth(data) {
    return data.reduce((acc, item) => {
        const month = new Date(item.date).toLocaleString('default', { month: 'short' });
        acc[month] = (acc[month] || 0) + item.amount;
        return acc;
    }, {});
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function showAddModal() {
    document.getElementById('incomeaddModal').style.display = 'block';
    document.getElementById('incomeDate').value = new Date().toISOString().split('T')[0];
}

function hideModal() {
    document.getElementById('incomeaddModal').style.display = 'none';
}

// Initialize chart when page loads
document.addEventListener('DOMContentLoaded', function() {
    initChart();
    updateDisplay();
});

// Attendance Section
let currentDate = new Date();
let attendanceData = JSON.parse(localStorage.getItem('attendance')) || {};
   
function updateMonthDisplay() {
    const options = { month: 'long', year: 'numeric' };
    document.getElementById('currentMonth').textContent = 
        currentDate.toLocaleDateString('en-US', options);
    generateAttendanceGrid();
}

function changeMonth(offset) {
    currentDate.setMonth(currentDate.getMonth() + offset);
    updateMonthDisplay();
}

function generateAttendanceGrid() {
    const table = document.getElementById('attendanceTable');
    table.innerHTML = '';

    const headerRow = table.createTHead().insertRow();
    headerRow.insertCell().textContent = 'Employee';
    
    const daysInMonth = new Date(
        currentDate.getFullYear(),
        currentDate.getMonth() + 1,
        0
    ).getDate();

    for (let day = 1; day <= daysInMonth; day++) {
        const th = document.createElement('th');
        th.textContent = day;
        headerRow.appendChild(th);
    }

    const employees = JSON.parse(localStorage.getItem('employees')) || [];
    const tbody = table.createTBody();
    
    employees.forEach((employee, index) => {
        const row = tbody.insertRow();
        row.insertCell().textContent = employee.name;

        for (let day = 1; day <= daysInMonth; day++) {
            const cell = row.insertCell();
            cell.className = 'status-cell';
            cell.dataset.employeeId = index;
            cell.dataset.date = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1}-${day}`;
            
            const status = getAttendanceStatus(index, day);
            cell.classList.add(status);
            cell.addEventListener('click', () => toggleAttendanceStatus(cell));
        }
    });
}

function getAttendanceStatus(employeeId, day) {
    const dateKey = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1}-${day}`;
    return attendanceData[dateKey]?.[employeeId] || 'none';
}

function toggleAttendanceStatus(cell) {
    const statuses = ['absent', 'present', 'late', 'none'];
    const currentStatus = statuses.find(s => cell.classList.contains(s));
    const nextStatus = statuses[(statuses.indexOf(currentStatus) + 1) % statuses.length];

    cell.className = `status-cell ${nextStatus}`;
    saveAttendanceData(cell.dataset.employeeId, cell.dataset.date, nextStatus);
}

function saveAttendanceData(employeeId, date, status) {
    if (!attendanceData[date]) attendanceData[date] = {};
    attendanceData[date][employeeId] = status;
    localStorage.setItem('attendance', JSON.stringify(attendanceData));
}


function showAddEmployeeModal() {
    document.getElementById('employeeModal').style.display = 'block';
    document.getElementById('employeeModalOverlay').style.display = 'block';
}

function closeEmployeeModal() {
    document.getElementById('employeeModal').style.display = 'none';
    document.getElementById('employeeModalOverlay').style.display = 'none';
}

function addEmployee(e) {
    e.preventDefault();
    const employees = JSON.parse(localStorage.getItem('employees')) || [];

    employees.push({
        name: document.getElementById('employeeName').value,
        position: document.getElementById('employeePosition').value
    });

    localStorage.setItem('employees', JSON.stringify(employees));
    closeEmployeeModal();
    generateAttendanceGrid();
    document.getElementById('employeeName').value = '';
    document.getElementById('employeePosition').value = '';
}

document.addEventListener('DOMContentLoaded', function() {
    updateMonthDisplay();
});