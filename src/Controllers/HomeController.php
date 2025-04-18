<?php

namespace PHPAdvanced\Controllers;

class HomeController {
    private $conn;

    public function __construct()
    {
        $serverName = "DESKTOP-LVRTJMQ";
        $connectionInfo = array(
            "Database" => "ECOMMERCE_DB",
            "UID" => "ecommerceuser",
            "PWD" => "senators"
        );

        $this->conn = sqlsrv_connect($serverName, $connectionInfo);
        
        if (!$this->conn) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function index() {
        require "views/home.php";
    }

    public function datatables() {
        $customers = $this->getCustomers();
        require "views/datatables.php";
    }

    public function tabulator() {
        $customers = $this->getCustomers();
        require "views/tabulator.php";
    }

    public function webix() {
        $customers = $this->getCustomers();
        require "views/webix.php";
    }

    public function frappe() {
        $customers = $this->getCustomers();
        require "views/frappe.php";
    }

    public function zinggrid() {
        $customers = $this->getCustomers();
        require "views/zinggrid.php";
    }

    public function angular() {
        $customers = $this->getCustomers();
        require "views/angular.php";
    }

    public function agGrid() {
        $customers = $this->getCustomers();
        require "views/ag-grid.php";
    }

    public function jqGrid() {
        $customers = $this->getCustomers();
        require "views/jqgrid.php";
    }

    public function handsontable() {
        $customers = $this->getCustomers();
        require "views/handsontable.php";
    }

    public function simpleDatatables() {
        $customers = $this->getCustomers();
        require "views/simple-datatables.php";
    }

    private function getCustomers() {
        $sql = "SELECT CustomerID, FirstName, LastName, Email, PhoneNumber, 
                       RegistrationDate, LastLogin 
                FROM Customers";
        
        $stmt = sqlsrv_query($this->conn, $sql);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $customers = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Format datetime fields
            if ($row['RegistrationDate'] instanceof \DateTime) {
                $row['RegistrationDate'] = $row['RegistrationDate']->format('Y-m-d H:i:s');
            }
            if ($row['LastLogin'] instanceof \DateTime) {
                $row['LastLogin'] = $row['LastLogin']->format('Y-m-d H:i:s');
            }
            $customers[] = $row;
        }

        return $customers;
    }

    public function __destruct()
    {
        if ($this->conn) {
            sqlsrv_close($this->conn);
        }
    }
}




