# Day 15: Capstone Project - User Dashboard
## 50-Minute Lesson Plan

### Project Overview
Build a complete user management system combining all previous lessons:
- File handling (JSON storage)
- Sessions (authentication)
- Cookies (theme preference)
- Password hashing (security)
- Form validation

### Learning Objectives
By the end of this lesson, students will be able to:
1. Integrate multiple PHP concepts into one application
2. Structure a multi-page PHP application
3. Create reusable helper functions
4. Build a complete authentication flow

### Project Structure

```
day15-project-lesson/
├── index.php          # Landing page
├── register.php       # User registration
├── login.php          # User login
├── dashboard.php      # Protected user area
├── logout.php         # Session destruction
├── functions.php      # Shared helper functions
└── data/
    └── users.json     # User storage
```

### Lesson Structure (50 minutes)

| Time | Topic | Focus |
|------|-------|-------|
| 0-5 min | Project overview | Architecture |
| 5-15 min | functions.php | Helper functions |
| 15-25 min | Registration flow | Form → Hash → Save |
| 25-35 min | Login flow | Verify → Session |
| 35-45 min | Dashboard | Protected page |
| 45-50 min | Testing & Q&A | - |

### Key Integration Points

1. **functions.php** - Central helper functions
   - `loadUsers()` / `saveUsers()` - File I/O
   - `findUserByUsername()` - User lookup
   - `createUser()` - Registration logic
   - `isLoggedIn()` - Session check

2. **Session Flow**
   - Login → `session_regenerate_id()` → Store user data
   - Each page → Check `$_SESSION['user']`
   - Logout → Destroy session

3. **Security Practices**
   - `password_hash()` on registration
   - `password_verify()` on login
   - `htmlspecialchars()` on output
   - Vague error messages

### Running the Project
```bash
cd /Users/kiran/Developer/codephp/days/day15-project-lesson
php -S localhost:8015
# Open browser to http://localhost:8015
```

### Extension Ideas
- Add profile editing
- Implement "remember me" with cookies
- Add password change feature
- Create admin user role
