# Database Setup Guide

This guide will help you set up MySQL databases for the PHP practice exercises.

---

## Quick Info

| Setting | Value |
|---------|-------|
| **Username** | `test` |
| **Password** | `test` |
| **Databases** | day17_practice, day18_practice, day19_practice, day20_practice |

---

## Method 1: Using phpMyAdmin (Easiest)

This is the recommended method for beginners.

### Step 1: Open phpMyAdmin

Open your browser and go to:

| Software | URL |
|----------|-----|
| XAMPP | http://localhost/phpmyadmin |
| MAMP | http://localhost:8888/phpmyadmin |
| WAMP | http://localhost/phpmyadmin |

### Step 2: Run the SQL Script

1. Click on the **"SQL"** tab at the top
2. Open the file `setup_all_databases.sql` in a text editor
3. Copy ALL the SQL code (starting from `CREATE USER`)
4. Paste into the SQL text box in phpMyAdmin
5. Click the **"Go"** button

### Step 3: Verify

You should see success messages. Check the left sidebar - you should see:
- day17_practice
- day18_practice
- day19_practice
- day20_practice

---

## Method 2: Mac Terminal

### Step 1: Open Terminal

Press `Cmd + Space`, type "Terminal", press Enter

### Step 2: Navigate to Project Folder

```bash
cd /path/to/your/days
```

### Step 3: Run the Script

Choose ONE option based on your setup:

**Option A - MySQL root has NO password:**
```bash
mysql -u root < setup_all_databases.sql
```

**Option B - MySQL root HAS a password:**
```bash
mysql -u root -p < setup_all_databases.sql
```
Enter your root password when prompted.

**Option C - Using MAMP:**
```bash
/Applications/MAMP/Library/bin/mysql -u root -p < setup_all_databases.sql
```

**Option D - Using Homebrew MySQL:**
```bash
/opt/homebrew/bin/mysql -u root -p < setup_all_databases.sql
```

### Step 4: Verify

```bash
mysql -u test -ptest -e "SHOW DATABASES;"
```

---

## Method 3: Windows Command Prompt

### Step 1: Open Command Prompt as Administrator

1. Press the **Windows key**
2. Type "cmd"
3. Right-click on "Command Prompt"
4. Select **"Run as administrator"**

### Step 2: Navigate to MySQL bin Folder

Choose based on your setup:

**For XAMPP:**
```cmd
cd C:\xampp\mysql\bin
```

**For WAMP:**
```cmd
cd C:\wamp64\bin\mysql\mysql8.0.31\bin
```
(Note: version number may differ)

**For MySQL Installer:**
```cmd
cd "C:\Program Files\MySQL\MySQL Server 8.0\bin"
```

### Step 3: Run the Script

Choose ONE option:

**Option A - MySQL root has NO password:**
```cmd
mysql -u root < "C:\path\to\your\days\setup_all_databases.sql"
```

**Option B - MySQL root HAS a password:**
```cmd
mysql -u root -p < "C:\path\to\your\days\setup_all_databases.sql"
```
Enter your root password when prompted.

**Option C - Copy-Paste Method:**
1. Open MySQL command line:
   ```cmd
   mysql -u root -p
   ```
2. Open `setup_all_databases.sql` in Notepad
3. Copy all the SQL code
4. Right-click in the command prompt to paste
5. Press Enter

### Step 4: Verify

```cmd
mysql -u test -ptest -e "SHOW DATABASES;"
```

---

## What Gets Created

### Databases and Tables

| Database | Tables | Description |
|----------|--------|-------------|
| day17_practice | users (5 records) | Basic CRUD operations |
| day18_practice | users (3), products (3) | Forms and validation |
| day19_practice | contacts, users | Contact form and registration |
| day20_practice | users (30), products (25), categories (5), orders (15) | Full e-commerce practice |

### User Account

```
Username: test
Password: test
Host: localhost
```

This user has full access to all practice databases.

---

## Troubleshooting

### Error: "Access denied for user 'root'"

- Make sure MySQL is running
- Check your root password is correct
- Try without password: `mysql -u root` (if no password is set)

### Error: "'mysql' is not recognized" (Windows)

- You need to navigate to the MySQL bin folder first
- Or add MySQL to your system PATH:
  1. Search "Environment Variables" in Windows
  2. Edit PATH variable
  3. Add `C:\xampp\mysql\bin` (or your MySQL bin path)

### Error: "command not found: mysql" (Mac)

- Install MySQL via Homebrew: `brew install mysql`
- Or check if MAMP/XAMPP is installed correctly
- Make sure MySQL service is running

### Error: "User 'test' already exists"

- This is OK! The script uses `IF NOT EXISTS` so it will continue

### Error: "Database already exists"

- This is OK! The script will just use the existing database

### Error: "Table already exists"

- This is OK! The script uses `IF NOT EXISTS` for tables

---

## Testing Your Connection

Create a test file `test_connection.php`:

```php
<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=day20_practice;charset=utf8mb4",
        "test",
        "test"
    );
    echo "Connected successfully!";

    // Test query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch();
    echo "\nUsers in database: " . $result['count'];

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
```

Run it:
```bash
php test_connection.php
```

Expected output:
```
Connected successfully!
Users in database: 30
```

---

## Need Help?

If you're still having issues:

1. Make sure MySQL/MariaDB service is running
2. Check that you're using the correct port (usually 3306)
3. Verify XAMPP/MAMP/WAMP control panel shows MySQL as "Running"
4. Try restarting the MySQL service
