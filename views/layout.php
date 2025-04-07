<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Advanced - Data Tables Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar-menu {
            justify-content: center;
        }
        .navbar-start {
            margin-right: 0 !important; /* Override Bulma's default margin */
            flex-grow: 0;              /* Prevent growing */
        }
    </style>
</head>
<body>
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
        <div class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">Home</a>
                <a class="navbar-item" href="/datatables">DataTables</a>
                <a class="navbar-item" href="/tabulator">Tabulator</a>
                <a class="navbar-item" href="/webix">Webix</a>
                <a class="navbar-item" href="/frappe">Frappe</a>
                <a class="navbar-item" href="/zinggrid">ZingGrid</a>
                <a class="navbar-item" href="/angular">Angular</a>
                <a class="navbar-item" href="/ag-grid">AG Grid</a>
                <a class="navbar-item" href="/jqgrid">jqGrid</a>
                <a class="navbar-item" href="/handsontable">Handsontable</a>
                <a class="navbar-item" href="/simple-datatables">Simple DataTables</a>
            </div>
        </div>
    </nav>

    <?php echo $content; ?>

    <?php include 'views/partials/footer.php'; ?>
</body>
</html>





