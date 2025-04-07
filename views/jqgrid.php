<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table from&nbsp;<a href="https://www.guriddo.net">https://www.guriddo.net</a>
                </p>
            </header>
            <div class="card-content">
                <table id="jqGrid"></table>
                <div id="jqGridPager"></div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and jqGrid CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/css/ui.jqgrid.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Custom CSS for jqGrid -->
<style>
.ui-jqgrid,
.ui-jqgrid .ui-jqgrid-view,
.ui-jqgrid .ui-jqgrid-htable th,
.ui-jqgrid .ui-jqgrid-btable td {
    font-size: 16px !important;  /* Increase base font size */
}

.ui-jqgrid .ui-jqgrid-pager {
    font-size: 15px !important;  /* Pager font size */
}

.ui-jqgrid .ui-pg-input,
.ui-jqgrid .ui-pg-selbox {
    font-size: 15px !important;  /* Input fields font size */
    height: 25px !important;     /* Make inputs slightly taller */
}
</style>

<!-- jQuery and jqGrid JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/jquery.jqgrid.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#jqGrid").jqGrid({
        data: ' . json_encode($customers) . ',
        datatype: "local",
        colModel: [
            { label: "ID", name: "CustomerID", width: 75 },
            { label: "First Name", name: "FirstName", width: 150 },
            { label: "Last Name", name: "LastName", width: 150 },
            { label: "Email", name: "Email", width: 250 },
            { label: "Phone Number", name: "PhoneNumber", width: 150 },
            { label: "Registration Date", name: "RegistrationDate", width: 150 },
            { label: "Last Login", name: "LastLogin", width: 150 }
        ],
        viewrecords: true,
        width: "auto",
        height: "auto",
        rowNum: 10,
        pager: "#jqGridPager",
        rowHeight: 35  // Increase row height to accommodate larger font
    });
});
</script>';

require "views/layout.php";
?>
