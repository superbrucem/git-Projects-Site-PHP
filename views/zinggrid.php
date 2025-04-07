<?php
$content = '
<div class="main-content">
    <div class="container">
        <!-- Controls Section -->
        <div class="card mb-4">
            <header class="card-header">
                <p class="card-header-title">
                    Grid Controls
                </p>
            </header>
            <div class="card-content">
                <div class="columns is-vcentered">
                    <div class="column">
                        <div class="field">
                            <label class="label">View Mode</label>
                            <div class="control">
                                <div class="select">
                                    <select id="viewMode">
                                        <option value="kanban">Kanban Board</option>
                                        <option value="cards">Card View</option>
                                        <option value="timeline">Timeline View</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Export Data</label>
                            <div class="buttons">
                                <button class="button is-info is-small" onclick="exportGrid(\'csv\')">
                                    <span class="icon is-small">
                                        <i class="fas fa-file-csv"></i>
                                    </span>
                                    <span>CSV</span>
                                </button>
                                <button class="button is-success is-small" onclick="exportGrid(\'xlsx\')">
                                    <span class="icon is-small">
                                        <i class="fas fa-file-excel"></i>
                                    </span>
                                    <span>Excel</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Views Container -->
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Customers Data
                </p>
            </header>
            <div class="card-content">
                <div id="grid-container">
                    <zing-grid 
                        id="zing-grid"
                        sort
                        search
                        pager
                        page-size="10"
                        page-size-options="10,25,50"
                        viewport-stop="500"
                        loading
                        theme="default"
                        class="custom-grid"
                    >
                    </zing-grid>
                    <div id="kanban-view" class="is-hidden"></div>
                    <div id="timeline-view" class="is-hidden"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ZingGrid JavaScript -->
<script src="https://cdn.zinggrid.com/zinggrid.min.js"></script>

<style>
.custom-grid {
    --zg-header-bg: #f5f7fa;
    --zg-header-color: #363636;
    --zg-cell-padding: 12px;
    --zg-row-hover-bg: #f8f9fa;
    --zg-odd-row-bg: #fafbfc;
    --zg-font-size: 14px;
    --zg-border-color: #dbdbdb;
    --zg-button-primary-bg: #3273dc;
    --zg-caption-bg: #fff;
    border-radius: 4px;
    overflow: hidden;
}

.card-view {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
    padding: 1rem;
}

.customer-card {
    background: white;
    border: 1px solid var(--zg-border-color);
    border-radius: 6px;
    padding: 1rem;
    transition: box-shadow 0.3s ease;
}

.customer-card:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.customer-card-header {
    border-bottom: 1px solid var(--zg-border-color);
    margin-bottom: 0.8rem;
    padding-bottom: 0.8rem;
}

.customer-card-content div {
    margin-bottom: 0.5rem;
}

.label {
    font-weight: 600;
    color: #363636;
}

/* Kanban View Styles */
.kanban-board {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    padding: 1rem;
    min-height: 600px;
}

.kanban-column {
    flex: 0 0 300px;
    background: #f5f7fa;
    border-radius: 6px;
    padding: 1rem;
}

.kanban-column-header {
    font-weight: bold;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #dbdbdb;
}

.kanban-card {
    background: white;
    border-radius: 4px;
    padding: 1rem;
    margin-bottom: 0.5rem;
    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
}

/* Timeline View Styles */
.timeline {
    position: relative;
    padding: 2rem 0;
}

.timeline::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 100%;
    background: #dbdbdb;
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
    width: 50%;
}

.timeline-item:nth-child(odd) {
    left: 0;
    padding-right: 2rem;
}

.timeline-item:nth-child(even) {
    left: 50%;
    padding-left: 2rem;
}

.timeline-content {
    background: white;
    border-radius: 6px;
    padding: 1rem;
    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
}

.timeline-date {
    font-weight: bold;
    color: #3273dc;
    margin-bottom: 0.5rem;
}
</style>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const grid = document.querySelector("#zing-grid");
    const customers = ' . json_encode($customers) . ';
    const gridContainer = document.getElementById("grid-container");
    const kanbanView = document.getElementById("kanban-view");
    const timelineView = document.getElementById("timeline-view");

    // Initialize grid with data but keep it hidden
    initializeGrid(grid, customers);
    grid.style.display = "none";  // Hide the grid explicitly
    
    // Show kanban view as default
    kanbanView.classList.remove("is-hidden");
    renderKanbanView(customers);

    // View mode switching
    document.getElementById("viewMode").addEventListener("change", function(e) {
        hideAllViews();
        switch(e.target.value) {
            case "cards":
                renderCardView(gridContainer, customers);
                break;
            case "kanban":
                kanbanView.classList.remove("is-hidden");
                renderKanbanView(customers);
                break;
            case "timeline":
                timelineView.classList.remove("is-hidden");
                renderTimelineView(customers);
                break;
        }
    });
});

function initializeGrid(grid, customers) {
    grid.data = customers;
    grid.columns = [
        { 
            index: "CustomerID", 
            header: "ID",
            width: "80px"
        },
        { 
            index: "FirstName", 
            header: "First Name",
            search: true
        },
        { 
            index: "LastName", 
            header: "Last Name",
            search: true
        },
        { 
            index: "Email", 
            header: "Email",
            search: true,
            template: (record) => `<a href="mailto:${record.Email}">${record.Email}</a>`
        },
        { 
            index: "PhoneNumber", 
            header: "Phone Number"
        },
        { 
            index: "RegistrationDate", 
            header: "Registration Date",
            type: "date"
        },
        { 
            index: "LastLogin", 
            header: "Last Login",
            type: "date"
        }
    ];
}

function hideAllViews() {
    const grid = document.querySelector("#zing-grid");
    const kanbanView = document.getElementById("kanban-view");
    const timelineView = document.getElementById("timeline-view");
    const cardView = document.querySelector(".card-view");

    grid.style.display = "none";
    kanbanView.classList.add("is-hidden");
    timelineView.classList.add("is-hidden");
    if (cardView) cardView.remove();
}

function renderCardView(container, customers) {
    const cardView = document.createElement("div");
    cardView.className = "card-view";
    
    customers.forEach(customer => {
        const card = document.createElement("div");
        card.className = "customer-card";
        card.innerHTML = `
            <div class="customer-card-header">
                <h3 class="is-size-5">${customer.FirstName} ${customer.LastName}</h3>
                <small class="has-text-grey">ID: ${customer.CustomerID}</small>
            </div>
            <div class="customer-card-content">
                <div><span class="label">Email:</span> <a href="mailto:${customer.Email}">${customer.Email}</a></div>
                <div><span class="label">Phone:</span> ${customer.PhoneNumber}</div>
                <div><span class="label">Registered:</span> ${customer.RegistrationDate}</div>
                <div><span class="label">Last Login:</span> ${customer.LastLogin}</div>
            </div>
        `;
        cardView.appendChild(card);
    });
    
    container.appendChild(cardView);
}

function renderKanbanView(customers) {
    const kanbanView = document.getElementById("kanban-view");
    kanbanView.innerHTML = "";

    // Group customers by registration month
    const groups = groupCustomersByMonth(customers);
    
    const board = document.createElement("div");
    board.className = "kanban-board";

    Object.entries(groups).forEach(([month, monthCustomers]) => {
        const column = document.createElement("div");
        column.className = "kanban-column";
        column.innerHTML = `
            <div class="kanban-column-header">${month}</div>
            ${monthCustomers.map(customer => `
                <div class="kanban-card">
                    <div class="has-text-weight-bold">${customer.FirstName} ${customer.LastName}</div>
                    <div class="has-text-grey">${customer.Email}</div>
                    <div class="has-text-grey-light">${customer.RegistrationDate}</div>
                </div>
            `).join("")}
        `;
        board.appendChild(column);
    });

    kanbanView.appendChild(board);
}

function renderTimelineView(customers) {
    const timelineView = document.getElementById("timeline-view");
    timelineView.innerHTML = "";

    const timeline = document.createElement("div");
    timeline.className = "timeline";

    const sortedCustomers = [...customers].sort((a, b) => 
        new Date(a.RegistrationDate) - new Date(b.RegistrationDate)
    );

    sortedCustomers.forEach((customer, index) => {
        const item = document.createElement("div");
        item.className = "timeline-item";
        item.innerHTML = `
            <div class="timeline-content">
                <div class="timeline-date">${formatDate(customer.RegistrationDate)}</div>
                <div class="has-text-weight-bold">${customer.FirstName} ${customer.LastName}</div>
                <div>${customer.Email}</div>
                <div class="has-text-grey-light">Last login: ${formatDate(customer.LastLogin)}</div>
            </div>
        `;
        timeline.appendChild(item);
    });

    timelineView.appendChild(timeline);
}

function groupCustomersByMonth(customers) {
    return customers.reduce((groups, customer) => {
        const date = new Date(customer.RegistrationDate);
        const month = date.toLocaleString("default", { month: "long", year: "numeric" });
        if (!groups[month]) groups[month] = [];
        groups[month].push(customer);
        return groups;
    }, {});
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString("default", {
        year: "numeric",
        month: "short",
        day: "numeric"
    });
}

function exportGrid(format) {
    const grid = document.querySelector("#zing-grid");
    if (format === "csv") {
        grid.executeCommand("csv");
    } else if (format === "xlsx") {
        grid.executeCommand("xlsx");
    }
}
</script>';

require "views/layout.php";
?>




