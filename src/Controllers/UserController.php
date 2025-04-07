<?php

namespace PHPAdvanced\Controllers;

class UserController
{
    private $conn;

    public function __construct()
    {
        // Replace these with your actual SQL Server connection details
        $serverName = "DESKTOP-LVRTJMQ"; // e.g., "localhost" or "DESKTOP-ABC\SQLEXPRESS"
        $connectionInfo = array(
            "Database" => "ECOMMERCE_DB",
            "UID" => "ecommerceuser",
            "PWD" => "senators"
        );

        // Connect to SQL Server
        $this->conn = sqlsrv_connect($serverName, $connectionInfo);
        
        if (!$this->conn) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function listUsers()
    {
        $sql = "SELECT AdminID, Username, Email, FirstName, LastName, LastLogin 
                FROM AdminUsers";
        
        $stmt = sqlsrv_query($this->conn, $sql);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $admins = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Handle LastLogin datetime
            if ($row['LastLogin'] instanceof DateTime) {
                $row['LastLogin'] = $row['LastLogin']->format('Y-m-d H:i:s');
            } else if (is_object($row['LastLogin'])) {
                // For SQL Server datetime objects
                $row['LastLogin'] = date_format($row['LastLogin'], 'Y-m-d H:i:s');
            } else if ($row['LastLogin'] === null) {
                $row['LastLogin'] = '';
            }
            $admins[] = $row;
        }

        require 'views/admin_list.php';
    }

    public function getUser(array $vars)
    {
        $id = $vars['id'];
        
        // Query to fetch specific admin user
        $sql = "SELECT AdminID, Username, Email, FirstName, LastName, LastLogin 
                FROM AdminUsers 
                WHERE AdminID = ?";
        
        $params = array($id);
        $stmt = sqlsrv_query($this->conn, $sql, $params);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $admin = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        
        if ($admin) {
            // Convert LastLogin datetime to string if it's a DateTime object
            if ($admin['LastLogin'] instanceof DateTime) {
                $admin['LastLogin'] = $admin['LastLogin']->format('Y-m-d H:i:s');
            }
            
            echo "<h1>Admin Details</h1>";
            echo "<p>ID: {$admin['AdminID']}</p>";
            echo "<p>Username: {$admin['Username']}</p>";
            echo "<p>Email: {$admin['Email']}</p>";
            echo "<p>Name: {$admin['FirstName']} {$admin['LastName']}</p>";
            echo "<p>Last Login: {$admin['LastLogin']}</p>";
        } else {
            echo "Admin not found.";
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            sqlsrv_close($this->conn);
        }
    }
}



