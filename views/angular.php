<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table using Angular Material
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
                    <tbody id="customer-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const customers = ' . json_encode($customers) . ';
    const tableBody = document.getElementById("customer-table-body");
    
    customers.forEach(customer => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${customer.CustomerID}</td>
            <td>${customer.FirstName}</td>
            <td>${customer.LastName}</td>
            <td>${customer.Email}</td>
            <td>${customer.PhoneNumber}</td>
            <td>${customer.RegistrationDate}</td>
            <td>${customer.LastLogin}</td>
        `;
        tableBody.appendChild(row);
    });
});
</script>';

require "views/layout.php";
?>

