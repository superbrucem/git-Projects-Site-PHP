<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Table from&nbsp;<a href="https://fooplugins.github.io/FooTable/">https://fooplugins.github.io/FooTable/</a>
                </p>
            </header>
            <div class="card-content">
                <table id="footable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th data-breakpoints="xs">Email</th>
                            <th data-breakpoints="xs sm">Phone Number</th>
                            <th data-breakpoints="xs sm md">Registration Date</th>
                            <th data-breakpoints="xs sm md">Last Login</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- FooTable CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/footable/3.1.6/footable.bootstrap.min.css" rel="stylesheet">

<!-- FooTable JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/footable/3.1.6/footable.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#footable").footable({
        "columns": [
            { "name": "CustomerID", "title": "ID" },
            { "name": "FirstName", "title": "First Name" },
            { "name": "LastName", "title": "Last Name" },
            { "name": "Email", "title": "Email" },
            { "name": "PhoneNumber", "title": "Phone Number" },
            { "name": "RegistrationDate", "title": "Registration Date" },
            { "name": "LastLogin", "title": "Last Login" }
        ],
        "rows": ' . json_encode($customers) . '
    });
});
</script>';

require "views/layout.php";
?>