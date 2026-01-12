# Day 11: File Handling in PHP
## 50-Minute Lesson Plan

### Learning Objectives
By the end of this lesson, students will be able to:
1. Read and write text files using PHP
2. Work with CSV files (create, read, search)
3. Handle JSON data (encode, decode, CRUD operations)

### Lesson Structure (50 minutes)

| Time | Topic | File |
|------|-------|------|
| 0-5 min | Introduction to file handling | Lecture |
| 5-15 min | Reading & Writing Files | 01_files.php |
| 15-30 min | CSV File Operations | 02_csv.php |
| 30-45 min | JSON File Operations | 03_json.php |
| 45-50 min | Practice & Q&A | - |

### File Modes Quick Reference

| Mode | Description |
|------|-------------|
| `r` | Read only (file must exist) |
| `w` | Write only (creates/overwrites) |
| `a` | Append only (creates if needed) |
| `r+` | Read and write |
| `w+` | Read and write (creates/overwrites) |
| `a+` | Read and append |

### Key Functions to Remember

**Basic Files:**
- `file_get_contents()` - Read entire file
- `file_put_contents()` - Write entire file
- `file()` - Read file into array

**CSV:**
- `fgetcsv()` - Read CSV row
- `fputcsv()` - Write CSV row

**JSON:**
- `json_encode()` - PHP to JSON
- `json_decode()` - JSON to PHP

### Running the Examples
```bash
cd /Users/kiran/Developer/codephp/days/day11-files-lesson
php 01_files.php
php 02_csv.php
php 03_json.php
```

### Homework
Complete the mini-project in `04_practice.php`
