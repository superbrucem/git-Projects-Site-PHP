<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table from&nbsp;<a href="https://frappe.io/charts">Frappe Charts</a>
                </p>
            </header>
            <div class="card-content">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Registration Date</th>
                            <th>Last Login</th>
                        </tr>
                    </thead>
                    <tbody id="frappe-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Frappe Charts CSS and JS -->
<link href="https://unpkg.com/frappe-charts@1.6.1/dist/frappe-charts.min.css" rel="stylesheet">
<script src="https://unpkg.com/frappe-charts@1.6.1/dist/frappe-charts.min.umd.js"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const customers = ' . json_encode($customers) . ';
    const tableBody = document.getElementById("frappe-table-body");
    
    // Populate table
    customers.forEach(customer => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${customer.CustomerID}</td>
            <td>${customer.FirstName}</td>
            <td>${customer.LastName}</td>
            <td><a href="mailto:${customer.Email}">${customer.Email}</a></td>
            <td>${customer.PhoneNumber}</td>
            <td>${customer.RegistrationDate}</td>
            <td>${customer.LastLogin}</td>
        `;
        tableBody.appendChild(row);
    });

    // Create a chart showing customer registrations over time
    const registrationData = processRegistrationData(customers);
    
    new frappe.Chart("#chart", {
        title: "Customer Registrations Over Time",
        data: {
            labels: registrationData.labels,
            datasets: [{
                name: "Registrations",
                values: registrationData.values
            }]
        },
        type: "line",
        height: 300,
        colors: ["#2E86C1"],
        lineOptions: {
            dotSize: 5,
            hideLine: 0,
            hideDots: 0,
            heatline: 0,
            regionFill: 1
        },
        axisOptions: {
            xAxisMode: "tick",
            yAxisMode: "span",
            xIsSeries: true
        }
    });
});

function processRegistrationData(customers) {
    // Group registrations by month
    const monthlyData = {};
    customers.forEach(customer => {
        const date = new Date(customer.RegistrationDate);
        const monthYear = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, "0")}`;
        monthlyData[monthYear] = (monthlyData[monthYear] || 0) + 1;
    });

    // Sort by date and prepare data for chart
    const sortedMonths = Object.keys(monthlyData).sort();
    return {
        labels: sortedMonths,
        values: sortedMonths.map(month => monthlyData[month])
    };
}
</script>

<style>
.card-content {
    padding: 1.5rem;
}

.table {
    margin-bottom: 2rem;
}

.table th {
    background-color: #f5f7fa;
    color: #363636;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
}

.table tr:hover {
    background-color: #f8f9fa;
}

#chart {
    margin-top: 2rem;
    padding: 1rem;
    background-color: white;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
</style>

<div id="chart"></div>';

require "views/layout.php";
?>

