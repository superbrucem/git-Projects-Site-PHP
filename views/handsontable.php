<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table from&nbsp;<a href="https://handsontable.com">https://handsontable.com</a>
                </p>
            </header>
            <div class="card-content">
                <div id="handsontable"></div>
            </div>
        </div>
    </div>
</div>

<!-- Handsontable CSS -->
<link href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" rel="stylesheet">

<!-- Handsontable JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("handsontable");
    const data = ' . json_encode($customers) . ';
    
    new Handsontable(container, {
        data: data,
        columns: [
            { data: "CustomerID", title: "ID" },
            { data: "FirstName", title: "First Name" },
            { data: "LastName", title: "Last Name" },
            { data: "Email", title: "Email" },
            { data: "PhoneNumber", title: "Phone Number" },
            { data: "RegistrationDate", title: "Registration Date" },
            { data: "LastLogin", title: "Last Login" }
        ],
        rowHeaders: true,
        colHeaders: true,
        filters: true,
        dropdownMenu: true,
        licenseKey: "non-commercial-and-evaluation"
    });
});
</script>';

require "views/layout.php";
?>