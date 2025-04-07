<?php
$content = '
<div class="main-content">
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Kanban from&nbsp;<a href="https://webix.com">https://webix.com</a>
                </p>
            </header>
            <div class="card-content">
                <div class="buttons mb-4">
                    <button class="button is-info" id="exportExcel">
                        <span class="icon">
                            <i class="mdi mdi-microsoft-excel"></i>
                        </span>
                        <span>Export Excel</span>
                    </button>
                    <button class="button is-success" id="exportCSV">
                        <span class="icon">
                            <i class="mdi mdi-file-delimited"></i>
                        </span>
                        <span>Export CSV</span>
                    </button>
                    <button class="button is-danger" id="exportPDF">
                        <span class="icon">
                            <i class="mdi mdi-file-pdf"></i>
                        </span>
                        <span>Export PDF</span>
                    </button>
                </div>
                <div id="webix-kanban" style="height:600px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Webix CSS -->
<link rel="stylesheet" href="https://cdn.webix.com/edge/webix.css" type="text/css">
<link rel="stylesheet" href="https://cdn.webix.com/materialdesignicons/5.8.95/css/materialdesignicons.min.css" type="text/css">

<!-- Webix JavaScript -->
<script src="https://cdn.webix.com/edge/webix.js" type="text/javascript"></script>
<!-- Webix Export Modules -->
<script src="https://cdn.webix.com/edge/xlsx.core.min.js"></script>
<script src="https://cdn.webix.com/edge/pdfjs.js"></script>

<style>
.customer-card {
    background: #fff;
    padding: 10px;
    margin: 5px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.customer-name {
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 5px;
}

.customer-email {
    color: #3498db;
    font-size: 0.9em;
    margin-bottom: 5px;
}

.customer-phone {
    color: #7f8c8d;
    font-size: 0.9em;
}

.webix_kanban_list {
    background: #f5f7fa !important;
}

.status-header {
    text-align: center;
    font-weight: bold;
    padding: 10px;
    background: #eef2f7;
    border-radius: 4px;
}

.buttons {
    display: flex;
    gap: 10px;
}

.button .icon {
    margin-right: 5px;
}
</style>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const customers = ' . json_encode($customers) . ';
    let webixGrid; // Reference to store the Webix grid
    
    // Group customers by registration year and month
    const groupedCustomers = {};
    customers.forEach(customer => {
        const date = new Date(customer.RegistrationDate);
        const yearMonth = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, "0")}`;
        if (!groupedCustomers[yearMonth]) {
            groupedCustomers[yearMonth] = [];
        }
        groupedCustomers[yearMonth].push(customer);
    });

    // Create kanban lists configuration
    const lists = Object.keys(groupedCustomers)
        .sort((a, b) => b.localeCompare(a))
        .slice(0, 4)
        .map(yearMonth => {
            const date = new Date(yearMonth + "-01");
            return {
                header: webix.Date.dateToStr("%F %Y")(date),
                body: {
                    view: "list",
                    id: `list_${yearMonth}`,
                    css: "webix_kanban_list",
                    type: {
                        height: "auto",
                        template: function(customer) {
                            return `<div class="customer-card">
                                        <div class="customer-name">${customer.FirstName} ${customer.LastName}</div>
                                        <div class="customer-email">
                                            <i class="mdi mdi-email"></i> 
                                            <a href="mailto:${customer.Email}">${customer.Email}</a>
                                        </div>
                                        <div class="customer-phone">
                                            <i class="mdi mdi-phone"></i> ${customer.PhoneNumber}
                                        </div>
                                    </div>`;
                        }
                    },
                    data: groupedCustomers[yearMonth]
                }
            };
        });

    // Initialize Webix UI
    webixGrid = webix.ui({
        container: "webix-kanban",
        view: "scrollview",
        scroll: "auto",
        body: {
            type: "clean",
            cols: lists.map(list => ({
                gravity: 1,
                rows: [
                    { template: `<div class="status-header">${list.header}</div>`, height: 40 },
                    list.body
                ]
            }))
        }
    });

    // Export functions
    function exportData(format) {
        // Flatten the grouped data for export
        const exportData = Object.values(groupedCustomers)
            .flat()
            .map(customer => ({
                "Customer ID": customer.CustomerID,
                "First Name": customer.FirstName,
                "Last Name": customer.LastName,
                "Email": customer.Email,
                "Phone Number": customer.PhoneNumber,
                "Registration Date": customer.RegistrationDate,
                "Last Login": customer.LastLogin
            }));

        if (format === "excel") {
            webix.toExcel(exportData, {
                filename: "customers_export",
                name: "Customers",
                columns: [
                    { id: "Customer ID", width: 100 },
                    { id: "First Name", width: 120 },
                    { id: "Last Name", width: 120 },
                    { id: "Email", width: 200 },
                    { id: "Phone Number", width: 150 },
                    { id: "Registration Date", width: 150 },
                    { id: "Last Login", width: 150 }
                ]
            });
        } else if (format === "csv") {
            webix.toCSV(exportData, {
                filename: "customers_export"
            });
        } else if (format === "pdf") {
            webix.toPDF(exportData, {
                filename: "customers_export",
                orientation: "landscape",
                autowidth: true
            });
        }
    }

    // Export button event listeners
    document.getElementById("exportExcel").addEventListener("click", () => exportData("excel"));
    document.getElementById("exportCSV").addEventListener("click", () => exportData("csv"));
    document.getElementById("exportPDF").addEventListener("click", () => exportData("pdf"));
});
</script>';

require "views/layout.php";
?>

