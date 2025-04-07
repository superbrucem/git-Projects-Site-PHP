<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Datatables.net example
                </p>
            </header>
            <div class="card-content">
                <div class="table-container">
                    <table id="customersTable" class="table is-striped is-hoverable is-fullwidth">
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
                        <tbody>';

foreach ($customers as $customer) {
    $content .= '
                            <tr>
                                <td>' . htmlspecialchars($customer['CustomerID']) . '</td>
                                <td>' . htmlspecialchars($customer['FirstName']) . '</td>
                                <td>' . htmlspecialchars($customer['LastName']) . '</td>
                                <td>' . htmlspecialchars($customer['Email']) . '</td>
                                <td>' . htmlspecialchars($customer['PhoneNumber'] ?? '') . '</td>
                                <td>' . htmlspecialchars($customer['RegistrationDate'] ?? '') . '</td>
                                <td>' . htmlspecialchars($customer['LastLogin'] ?? '') . '</td>
                            </tr>';
}

$content .= '
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<!-- jQuery and DataTables JavaScript -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#customersTable").DataTable({
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            "copy", "csv", "excel", "pdf", "print"
        ],
        pageLength: 10,
        order: [[0, "desc"]],
        columns: [
            { data: "CustomerID" },
            { data: "FirstName" },
            { data: "LastName" },
            { data: "Email" },
            { data: "PhoneNumber" },
            { data: "RegistrationDate" },
            { data: "LastLogin" }
        ],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
});
</script>';

require 'views/layout.php';
?>



