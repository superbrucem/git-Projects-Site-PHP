<?php

namespace PHPAdvanced\Controllers;

class CustomerController
{
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

    public function listCustomers()
    {
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

        require 'views/customers_list.php';
    }

    public function __destruct()
    {
        if ($this->conn) {
            sqlsrv_close($this->conn);
        }
    }
}