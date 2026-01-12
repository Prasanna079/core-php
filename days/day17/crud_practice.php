<?php
/**
 * Day 17: CRUD Practice
 *
 * Complete CRUD (Create, Read, Update, Delete) operations
 * combined in a single practical example
 */

require_once 'db_config.php';

echo "=== CRUD Practice: User Management System ===\n\n";

/**
 * CREATE - Add a new user
 */
function createUser($pdo, $name, $email, $age) {
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (:name, :email, :age)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'age' => $age
        ]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Error: Email already exists!\n";
        } else {
            echo "Error: " . $e->getMessage() . "\n";
        }
        return false;
    }
}

/**
 * READ - Get user(s)
 */
function getUser($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function getAllUsers($pdo) {
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id");
    return $stmt->fetchAll();
}

function searchUsers($pdo, $searchTerm) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE :term OR email LIKE :term");
    $stmt->execute(['term' => "%$searchTerm%"]);
    return $stmt->fetchAll();
}

/**
 * UPDATE - Modify a user
 */
function updateUser($pdo, $id, $data) {
    $fields = [];
    $params = ['id' => $id];

    foreach ($data as $key => $value) {
        $fields[] = "$key = :$key";
        $params[$key] = $value;
    }

    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->rowCount();
}

/**
 * DELETE - Remove a user
 */
function deleteUser($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->rowCount();
}

/**
 * Helper - Display users
 */
function displayUsers($users) {
    if (empty($users)) {
        echo "No users found.\n";
        return;
    }

    echo str_repeat("-", 60) . "\n";
    printf("%-4s | %-20s | %-25s | %s\n", "ID", "Name", "Email", "Age");
    echo str_repeat("-", 60) . "\n";

    foreach ($users as $user) {
        printf("%-4s | %-20s | %-25s | %s\n",
            $user['id'],
            substr($user['name'], 0, 20),
            substr($user['email'], 0, 25),
            $user['age']
        );
    }
    echo str_repeat("-", 60) . "\n";
}

// =====================
// DEMONSTRATION
// =====================

// 1. READ - Show all current users
echo "1. READ - Current users in database:\n";
displayUsers(getAllUsers($pdo));

// 2. CREATE - Add a new user
echo "\n2. CREATE - Adding new user:\n";
$newId = createUser($pdo, 'Sam Wilson', 'sam@example.com', 28);
if ($newId) {
    echo "Created user with ID: $newId\n";
    $newUser = getUser($pdo, $newId);
    echo "New user: {$newUser['name']} ({$newUser['email']})\n";
}

// 3. READ - Search for users
echo "\n3. READ - Search for users with 'a' in name:\n";
$results = searchUsers($pdo, 'a');
displayUsers($results);

// 4. UPDATE - Modify a user
echo "\n4. UPDATE - Updating user ID $newId:\n";
$updated = updateUser($pdo, $newId, [
    'name' => 'Samuel Wilson',
    'age' => 29
]);
echo "Rows updated: $updated\n";
$updatedUser = getUser($pdo, $newId);
echo "Updated user: {$updatedUser['name']}, Age: {$updatedUser['age']}\n";

// 5. DELETE - Remove the user
echo "\n5. DELETE - Removing user ID $newId:\n";
$deleted = deleteUser($pdo, $newId);
echo "Rows deleted: $deleted\n";

// Final state
echo "\n6. Final state of users table:\n";
displayUsers(getAllUsers($pdo));

echo "\n=== CRUD Practice Complete! ===\n";
