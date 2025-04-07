<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table from&nbsp;<a href="https://www.ag-grid.com">https://www.ag-grid.com</a>
                </p>
            </header>
            <div class="card-content">
                <!-- Debug info -->
                <div id="debug-info" style="margin-bottom: 10px;"></div>
                
                <!-- Grid container -->
                <div id="ag-grid-table" style="height: 500px; width: 100%;" class="ag-theme-material"></div>
            </div>
        </div>
    </div>
</div>

<!-- AG Grid CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@30.0.6/styles/ag-grid.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@30.0.6/styles/ag-theme-material.css">

<!-- AG Grid JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community@30.0.6/dist/ag-grid-community.min.js"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const debugDiv = document.getElementById("debug-info");
    const gridDiv = document.querySelector("#ag-grid-table");
    const rowData = ' . json_encode($customers) . ';
    
    const columnDefs = [
        { field: "CustomerID", headerName: "ID", width: 100, sortable: true, filter: true },
        { field: "FirstName", headerName: "First Name", sortable: true, filter: true },
        { field: "LastName", headerName: "Last Name", sortable: true, filter: true },
        { field: "Email", headerName: "Email", sortable: true, filter: true },
        { field: "PhoneNumber", headerName: "Phone Number", sortable: true, filter: true },
        { field: "RegistrationDate", headerName: "Registration Date", sortable: true, filter: true },
        { field: "LastLogin", headerName: "Last Login", sortable: true, filter: true }
    ];

    try {
        const gridOptions = {
            columnDefs: columnDefs,
            rowData: rowData,
            defaultColDef: {
                flex: 1,
                minWidth: 100,
                resizable: true,
                floatingFilter: true // Adds filter inputs below headers
            },
            pagination: true,
            paginationPageSize: 10,
            domLayout: "normal",
            rowHeight: 48, // Slightly bigger rows
            headerHeight: 48, // Matching header height
            suppressMovableColumns: false, // Allow column reordering
            animateRows: true // Smooth animations when sorting
        };

        new agGrid.Grid(gridDiv, gridOptions);
    } catch (error) {
        debugDiv.innerHTML = `<div style="color: red;">Error initializing grid: ${error.message}</div>`;
    }
});
</script>';

require "views/layout.php";
?>



