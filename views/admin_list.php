<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Users Database</title>
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Admin Users Database
                    </p>
                    <button class="card-header-icon" aria-label="more options">
                        <span class="icon">
                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </button>
                </header>
                <div class="table-container">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th><abbr title="AdminID">ID</abbr></th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $admin): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($admin['AdminID'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($admin['Username'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($admin['Email'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($admin['FirstName'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($admin['LastName'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($admin['LastLogin'] ?? ''); ?></td>
                                <td>
                                    <div class="buttons are-small">
                                        <button class="button is-info">View</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <footer class="card-footer">
                    <a href="#" class="card-footer-item">
                        <span class="icon-text">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Add New Admin</span>
                        </span>
                    </a>
                    <a href="#" class="card-footer-item">Export</a>
                </footer>
            </div>
        </div>
    </section>

    <?php include 'views/partials/footer.php'; ?>
</body>
</html>


