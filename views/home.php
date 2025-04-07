<?php 
$gridDescriptions = "<p><a href='/datatables'>DataTables.net</a>: A highly flexible and feature-rich jQuery plugin for adding advanced interaction controls to HTML tables. It provides features like sorting, filtering, pagination, and theming.</p>" .
                    "<p><a href='/tabulator'>Tabulator</a>: A powerful and customizable JavaScript library for creating interactive tables and data grids. It supports various JavaScript frameworks (jQuery, Vue, React, Angular) and offers extensive features like sorting, filtering, grouping, editing, and more.</p>" .
                    "<p><a href='/ag-grid'>ag-Grid</a>: A feature-rich and high-performance JavaScript data grid library available in both a free (Community) and commercial (Enterprise) version. It supports all major JavaScript frameworks and is known for its advanced features like pivoting, aggregation, and excellent performance with large datasets.</p>" .
                    "<p><a href='/handsontable'>Handsontable</a>: A JavaScript grid component that provides an Excel-like interface for web applications. It focuses on data editing capabilities and offers features like data validation, formulas, and custom renderers.</p>" .
                    "<p><a href='/jqgrid'>jQGrid</a>: A mature jQuery plugin for creating AJAX-enabled, interactive grids. It supports features like sorting, filtering, paging, inline editing, and customizable appearances.</p>" .
                    "<p><a href='/footable'>FooTable</a>: A jQuery plugin focused on creating responsive HTML tables. It provides different ways to handle columns on smaller screens, such as hiding columns or creating expandable rows.</p>" .
                    "<p><a href='/simple-datatables'>Simple-DataTables</a>: A lightweight and dependency-free JavaScript HTML table plugin. As the name suggests, it aims for simplicity while providing essential features like sortable columns, pagination, and a search feature. It does not rely on jQuery.</p>" .
                    "<p><a href='/webix'>Webix DataTable</a>: A component within the Webix JavaScript UI library. It's a powerful DataTable with a wide range of features including sorting, filtering, editing, grouping, pivoting, and integration with other Webix widgets.</p>" .
                    "<p><a href='/frappe'>Frappe DataTable</a>: A modern and interactive DataTable library originally built for the ERPNext open-source ERP system. It's designed to handle large datasets efficiently and offers features like sorting, filtering, and column customization.</p>" .
                    "<p><a href='/zinggrid'>ZingGrid</a>: A JavaScript Web Component library for creating interactive data tables. It's designed to be responsive and compatible with various frameworks like Angular, jQuery, React, and Vue, emphasizing customization and performance.</p>" .
                    "<p><a href='/angular'>Angular</a>: A comprehensive open-source front-end web application framework written in TypeScript and led by Google. It provides a structured way to build dynamic single-page applications (SPAs) and includes features like component-based architecture, data binding, routing, and dependency injection. While not a grid library itself, many powerful grid libraries (like ag-Grid and Angular Material Table) are specifically designed for or integrate well with Angular.</p>";

$content = '
<div class="main-content">
    <div class="hero is-fullheight-with-navbar">
        <div class="hero-body">
            <div class="container">
                <div class="content has-text-left">
                    ' . $gridDescriptions . '
                </div>
            </div>
        </div>
    </div>
</div>
';

require 'views/layout.php';
?>








