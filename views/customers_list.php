<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    DataTables.net Example
                </p>
            </header>
            <div class="card-content">
                <div class="table-container">
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
</div>';

require 'views/layout.php';
?>