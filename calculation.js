function calculateSSS(salary) {
  return salary <= 19749 ? salary * 0.045 : 1000;
}

function previewSalary() {
  const employee = document.getElementById('employee').value;
  const empClass = document.getElementById('class').value;
  const year = document.getElementById('year').value;
  const month = document.getElementById('month').value;

  if (!employee || !empClass || !year || !month) {
    alert("Please fill in all fields.");
    return;
  }


  const classpay = Math.floor(Math.random() * 10001) + 10000; 

  const philhealthDeduction = classpay * 0.05;
  const sssDeduction = calculateSSS(classpay);
  const pagibigDeduction = 400;

  const totalDeductions = philhealthDeduction + sssDeduction + pagibigDeduction;
  const taxableIncome = classpay - totalDeductions;
  const tax = taxableIncome * 0.12;
  const netIncome = taxableIncome - tax;

  const payrollDate = `${year}-${month.padStart(2, '0')}-01`;

  document.getElementById('base_salary').value = classpay;
  document.getElementById('sss_deduction').value = sssDeduction.toFixed(2);
  document.getElementById('philhealth_deduction').value = philhealthDeduction.toFixed(2);
  document.getElementById('pagibig_deduction').value = pagibigDeduction.toFixed(2);
  document.getElementById('taxable_income').value = taxableIncome.toFixed(2);
  document.getElementById('tax').value = tax.toFixed(2);
  document.getElementById('net_income').value = netIncome.toFixed(2);


  const tbody = document.getElementById('salaryPreviewBody');
  tbody.innerHTML = `
    <tr>
      <td style="padding: 12px;">${employee}</td>
      <td style="padding: 12px;">${empClass}</td>
      <td style="padding: 12px;">₱${classpay.toLocaleString()}</td>
      <td style="padding: 12px;">₱${sssDeduction.toFixed(2)}</td>
      <td style="padding: 12px;">₱${philhealthDeduction.toFixed(2)}</td>
      <td style="padding: 12px;">₱${pagibigDeduction.toFixed(2)}</td>
      <td style="padding: 12px;">₱${taxableIncome.toFixed(2)}</td>
      <td style="padding: 12px;">₱${tax.toFixed(2)}</td>
      <td style="padding: 12px;">₱${netIncome.toFixed(2)}</td>
      <td style="padding: 12px;">${payrollDate}</td>
      <td style="padding: 12px;">
        <button type="button" onclick="submitSalaryForm()" style="padding: 8px 12px; background: #2ecc71; color: white; border: none; border-radius: 5px; cursor: pointer;">
          Generate Salary
        </button>
      </td>
    </tr>
  `;
}

function submitSalaryForm() {
  document.getElementById('payoutForm').submit();
}
