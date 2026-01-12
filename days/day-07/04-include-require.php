<?php
/**
 * Day 7: Built-in PHP Functions
 * File 4: Include and Require
 *
 * Run: php 04-include-require.php
 */

echo "=== Day 7: Include and Require ===\n\n";

// ============================================
// DEMONSTRATION WITHOUT ACTUAL FILES
// ============================================
echo "1. Include vs Require Differences:\n";
echo str_repeat("-", 50) . "\n";

echo "
   include vs require:
   ┌──────────────────────┬──────────────────────┐
   │       include        │       require        │
   ├──────────────────────┼──────────────────────┤
   │ File not found:      │ File not found:      │
   │ Warning, continues   │ Fatal error, stops   │
   ├──────────────────────┼──────────────────────┤
   │ Use for:             │ Use for:             │
   │ Optional files       │ Essential files      │
   │ (sidebar, ads)       │ (config, database)   │
   └──────────────────────┴──────────────────────┘
\n";

// ============================================
// ONCE VARIANTS
// ============================================
echo "2. include_once and require_once:\n";
echo str_repeat("-", 50) . "\n";

echo "
   _once variants prevent duplicate includes:

   // Without _once (BAD - may cause errors)
   include 'functions.php';  // Loaded
   include 'functions.php';  // Loaded AGAIN! (function redefinition error)

   // With _once (GOOD - prevents duplicates)
   include_once 'functions.php';  // Loaded
   include_once 'functions.php';  // Skipped (already loaded)

   // Same applies to require_once
   require_once 'config.php';  // Recommended for config files
\n";

// ============================================
// MAGIC CONSTANTS
// ============================================
echo "3. Magic Constants for Paths:\n";
echo str_repeat("-", 50) . "\n";

echo "   __FILE__: " . __FILE__ . "\n";
echo "   __DIR__: " . __DIR__ . "\n";
echo "   __LINE__: " . __LINE__ . "\n";

echo "\n   Best practice:\n";
echo "   require_once __DIR__ . '/includes/config.php';\n";
echo "   (More reliable than relative paths)\n\n";

// ============================================
// PROJECT STRUCTURE EXAMPLE
// ============================================
echo "4. Typical Project Structure:\n";
echo str_repeat("-", 50) . "\n";

echo "
   project/
   ├── index.php           <- Main entry point
   ├── includes/
   │   ├── config.php      <- Database config, constants
   │   ├── functions.php   <- Helper functions
   │   └── database.php    <- Database connection
   ├── templates/
   │   ├── header.php      <- HTML header
   │   └── footer.php      <- HTML footer
   └── pages/
       ├── home.php
       └── about.php
\n";

// ============================================
// CODE EXAMPLES
// ============================================
echo "5. Example Code:\n";
echo str_repeat("-", 50) . "\n";

echo "\n   --- config.php ---\n";
echo '   <?php
   define("SITE_NAME", "My Website");
   define("DB_HOST", "localhost");
   $config = ["debug" => true];
   ?>
';

echo "\n   --- functions.php ---\n";
echo '   <?php
   function sanitize($input) {
       return htmlspecialchars(trim($input), ENT_QUOTES, "UTF-8");
   }

   function formatPrice($price) {
       return "$" . number_format($price, 2);
   }
   ?>
';

echo "\n   --- header.php ---\n";
echo '   <!DOCTYPE html>
   <html>
   <head><title><?php echo SITE_NAME; ?></title></head>
   <body>
   <header><h1><?php echo SITE_NAME; ?></h1></header>
';

echo "\n   --- footer.php ---\n";
echo '   <footer>
       <p>&copy; <?php echo date("Y"); ?> <?php echo SITE_NAME; ?></p>
   </footer>
   </body></html>
';

echo "\n   --- index.php ---\n";
echo '   <?php
   require_once __DIR__ . "/includes/config.php";
   require_once __DIR__ . "/includes/functions.php";
   include __DIR__ . "/templates/header.php";
   ?>
   <main>
       <h2>Welcome!</h2>
       <p>Price: <?php echo formatPrice(99.99); ?></p>
   </main>
   <?php include __DIR__ . "/templates/footer.php"; ?>
';

echo "\n\n";

// ============================================
// RETURN VALUES FROM INCLUDES
// ============================================
echo "6. Include with Return Values:\n";
echo str_repeat("-", 50) . "\n";

echo "\n   --- prices.php ---\n";
echo '   <?php
   return [
       "apple" => 1.50,
       "banana" => 0.75,
       "orange" => 2.00
   ];
   ?>
';

echo "\n   --- main.php ---\n";
echo '   <?php
   $prices = include "prices.php";
   echo $prices["apple"];  // 1.50
   ?>
';

echo "\n\n";

// ============================================
// SIMULATED FUNCTIONS.PHP
// ============================================
echo "7. Simulating an Included Functions File:\n";
echo str_repeat("-", 50) . "\n";

// Simulating what would be in functions.php
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function formatPrice($price) {
    return "$" . number_format($price, 2);
}

function formatDate($date, $format = "F j, Y") {
    return date($format, strtotime($date));
}

function isActive($status) {
    return $status ? "Active" : "Inactive";
}

// Using the functions
echo "\n   Using functions (as if included):\n";
echo "   sanitize('<script>alert(1)</script>'): " . sanitize("<script>alert(1)</script>") . "\n";
echo "   formatPrice(1234.5): " . formatPrice(1234.5) . "\n";
echo "   formatDate('2024-12-25'): " . formatDate("2024-12-25") . "\n";
echo "   isActive(true): " . isActive(true) . "\n\n";

// ============================================
// BEST PRACTICES
// ============================================
echo "8. Best Practices:\n";
echo str_repeat("-", 50) . "\n";

echo "
   ✓ Use require_once for essential files (config, database)
   ✓ Use include for optional content (sidebar, ads)
   ✓ Always use __DIR__ for reliable paths
   ✓ Use _once variants to prevent duplicate loading
   ✓ Keep includes organized in folders (includes/, templates/)
   ✓ Use meaningful file names
   ✗ Avoid deeply nested includes
   ✗ Don't include user-provided file names (security risk!)
\n";

// ============================================
// SECURITY WARNING
// ============================================
echo "9. Security Warning:\n";
echo str_repeat("-", 50) . "\n";

echo "
   NEVER do this (vulnerable to path traversal):
   include \$_GET['page'] . '.php';  // DANGEROUS!

   ALWAYS validate and whitelist:
   \$allowed = ['home', 'about', 'contact'];
   \$page = \$_GET['page'] ?? 'home';
   if (in_array(\$page, \$allowed)) {
       include __DIR__ . '/pages/' . \$page . '.php';
   }
\n";
