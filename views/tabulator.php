<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card mb-4">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Grid from&nbsp;<a href="https://www.tabulator.info">https://www.tabulator.info</a>
                </p>
            </header>
            <div class="card-content">
                <div class="field is-grouped mb-4">
                    <p class="control">
                        <input type="text" id="filter-field" class="input" placeholder="Search customers...">
                    </p>
                    <p class="control">
                        <button id="view-toggle" class="button is-primary">Toggle View</button>
                    </p>
                    <p class="control">
                        <button id="download-csv" class="button is-info">Download CSV</button>
                    </p>
                </div>
                <div id="customers-grid"></div>
            </div>
        </div>
    </div>
</div>

<!-- Tabulator CSS -->
<link href="https://unpkg.com/tabulator-tables@5.5.2/dist/css/tabulator.min.css" rel="stylesheet">
<!-- Tabulator JavaScript -->
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.5.2/dist/js/tabulator.min.js"></script>

<style>
.customer-card {
    background: white;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.customer-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.customer-name {
    font-size: 1.2em;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 10px;
}

.customer-email {
    color: #3498db;
    margin-bottom: 8px;
}

.customer-phone {
    color: #7f8c8d;
    font-size: 0.9em;
}

.customer-dates {
    margin-top: 10px;
    font-size: 0.8em;
    color: #95a5a6;
}

.tabulator-row {
    transition: background-color 0.2s;
}

.tabulator-row:hover {
    background-color: #f5f6fa !important;
}

.view-toggle-active {
    background-color: #f1f5f9;
}
</style>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    var tableData = ' . json_encode($customers, JSON_HEX_APOS | JSON_HEX_QUOT) . ';
    var isCardView = true;
    
    // Card View Layout
    var cardFormatter = function(cell, formatterParams, onRendered) {
        var row = cell.getRow().getData();
        return `<div class="customer-card">
                    <div class="customer-name">${row.FirstName} ${row.LastName}</div>
                    <div class="customer-email">
                        <a href="mailto:${row.Email}">${row.Email}</a>
                    </div>
                    <div class="customer-phone">${row.PhoneNumber}</div>
                    <div class="customer-dates">
                        <div>Registered: ${row.RegistrationDate}</div>
                        <div>Last Login: ${row.LastLogin}</div>
                    </div>
                </div>`;
    };

    // Initialize Tabulator
    var table = new Tabulator("#customers-grid", {
        data: tableData,
        layout: "fitColumns",
        responsiveLayout: "collapse",
        pagination: "local",
        paginationSize: 12,
        paginationSizeSelector: [6, 12, 24, 48],
        columns: [{
            title: "Customer",
            field: "CustomerID",
            formatter: cardFormatter,
            width: "100%"
        }],
        rowFormatter: function(row) {
            // Add padding to rows in card view
            row.getElement().style.padding = "10px";
            row.getElement().style.boxSizing = "border-box";
        }
    });

    // Toggle between card and table view
    document.getElementById("view-toggle").addEventListener("click", function() {
        isCardView = !isCardView;
        this.classList.toggle("is-active");
        
        if (isCardView) {
            table.setColumns([{
                title: "Customer",
                field: "CustomerID",
                formatter: cardFormatter,
                width: "100%"
            }]);
        } else {
            table.setColumns([
                {title: "ID", field: "CustomerID", width: 70},
                {title: "First Name", field: "FirstName"},
                {title: "Last Name", field: "LastName"},
                {title: "Email", field: "Email", formatter: "link", formatterParams: {urlPrefix: "mailto:"}},
                {title: "Phone", field: "PhoneNumber"},
                {title: "Registration", field: "RegistrationDate"},
                {title: "Last Login", field: "LastLogin"}
            ]);
        }
    });

    // Search functionality
    document.getElementById("filter-field").addEventListener("keyup", function(e) {
        table.setFilter([
            {field: "FirstName", type: "like", value: e.target.value},
            {field: "LastName", type: "like", value: e.target.value},
            {field: "Email", type: "like", value: e.target.value}
        ], "or");
    });

    // Download CSV
    document.getElementById("download-csv").addEventListener("click", function() {
        table.download("csv", "customers_data.csv");
    });
});
</script>';

require "views/layout.php";
?>








