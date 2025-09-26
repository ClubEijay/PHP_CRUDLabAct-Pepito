# Club Eijay's ScholarBase 🎓
Club Eijay’s ScholarBase is a student management system built with PHP, MySQL, and Bootstrap. ScholarBase lets users add, view, edit, and delete student records in a clean, responsive interface. With validation, sorting, and modal confirmations, managing academic data becomes smooth and efficient!.
## Features 🌟

### Modern User Interface
- Beautiful glassmorphic design with blur effects
- Responsive Bootstrap 5 layout
- Interactive DataTables integration
- Font Awesome icons
- Modern form validation
- Success/error notifications

### Core Functionalities
1. **Student Management**
   - Add new students with validation
   - View all students in a sortable table
   - Edit student information
   - Delete students with confirmation
   
2. **Smart Features**
   - Intelligent ID assignment (reuses available IDs)
   - Real-time form validation
   - Email uniqueness checking
   - Sortable columns (by name, email, etc.)
   - Search functionality
   - Pagination

3. **Data Organization**
   - Student ID tracking
   - Full name management
   - Email verification
   - Course tracking
   - Creation timestamp

## Setup Instructions 🚀

### Prerequisites
- XAMPP, WAMP, or LAMP server
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser with modern CSS support

### Installation Steps

1. **Set up your web server**
   - Install XAMPP/WAMP/LAMP on your system
   - Start Apache and MySQL services

2. **Configure the database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named 'student_crud'
   - Execute the following SQL query:

```sql
CREATE DATABASE IF NOT EXISTS student_crud;
USE student_crud;

CREATE TABLE IF NOT EXISTS students (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

3. **Deploy the application**
   - Copy the entire 'student_lab_crud' folder to:
     - XAMPP: `C:\xampp\htdocs\` (Windows)
     - WAMP: `C:\wamp64\www\` (Windows)
     - LAMP: `/var/www/html/` (Linux)

4. **Configure database connection**
   - Open `db_connect.php`
   - Default credentials are:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'student_crud');
     ```
   - Modify if your setup uses different credentials

5. **Access the application**
   - Open your web browser
   - Navigate to: `http://localhost/student_lab_crud/select.php`

## File Structure 📁

- `db_connect.php` - Database connection handler
- `select.php` - Main dashboard & student listing
- `insert.php` - Add new student form
- `update.php` - Edit student information
- `delete.php` - Handle student deletion
- `database.sql` - Database schema

## Usage Guide 📖

### Adding a Student
1. Click "Add New Student" button
2. Fill in all required fields:
   - Full Name
   - Email Address (must be unique)
   - Course/Program
3. Submit the form

### Viewing Students
- All students are listed in the main table
- Use the search box to filter records
- Click column headers to sort
- Navigate pages using the pagination controls

### Updating Student Information
1. Click the Edit (pencil) icon for the student
2. Modify the required fields
3. Save changes

### Deleting a Student
1. Click the Delete (trash) icon
2. Confirm deletion in the modal dialog

## Technical Details 🔧

### Database Schema
```sql
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Features Implementation
- **ID Assignment**: System automatically finds and uses the lowest available ID
- **Form Validation**: Both client-side (JavaScript) and server-side (PHP) validation
- **Data Security**: Prepared statements for SQL injection prevention
- **UI Framework**: Bootstrap 5 with custom glassmorphic styling
- **DataTables**: Enhanced table functionality with sorting and searching

## Troubleshooting 🔍

### Common Issues

1. **Database Connection Failed**
   - Verify MySQL service is running
   - Check database credentials in db_connect.php
   - Ensure database 'student_crud' exists

2. **404 Not Found**
   - Verify correct folder placement in web server directory
   - Check Apache configuration
   - Ensure all files are present

3. **Add/Update Not Working**
   - Check file permissions
   - Verify database user has required privileges
   - Check for duplicate email addresses

### For Additional Help
- Verify XAMPP/WAMP/LAMP services are running
- Check server error logs
- Ensure proper file permissions

## Credits 👏
Developed by Eijay P. Pepito

Theme: Club Eijay's ScholarBase

Version: 1.0
