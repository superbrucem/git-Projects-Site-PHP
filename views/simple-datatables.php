<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table from&nbsp;<a href="https://github.com/fiduswriter/Simple-DataTables">Simple-DataTables</a>
                </p>
            </header>
            <div class="card-content">
                <table id="myTable" class="table">
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
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Simple DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

<!-- Simple DataTables JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const dataTable = new simpleDatatables.DataTable("#myTable", {
        data: {
            headings: ["ID", "First Name", "Last Name", "Email", "Phone Number", "Registration Date", "Last Login"],
            data: ' . json_encode(array_map(function($row) {
                return array_values((array)$row);
            }, $customers)) . '
        }
    });
});
</script>';

require "views/layout.php";
?>