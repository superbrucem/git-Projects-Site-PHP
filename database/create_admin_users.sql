CREATE TABLE AdminUsers (
    AdminID INT IDENTITY(1,1) PRIMARY KEY,
    Username NVARCHAR(50) NOT NULL UNIQUE,
    Email NVARCHAR(100) NOT NULL UNIQUE,
    FirstName NVARCHAR(50) NOT NULL,
    LastName NVARCHAR(50) NOT NULL,
    LastLogin DATETIME NULL
);

-- Insert some sample data
INSERT INTO AdminUsers (Username, Email, FirstName, LastName, LastLogin)
VALUES 
    ('admin1', 'admin1@example.com', 'John', 'Doe', '2024-01-20 10:30:00'),
    ('admin2', 'admin2@example.com', 'Jane', 'Smith', '2024-01-19 15:45:00');