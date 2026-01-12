<?php
/**
 * Day 7: Built-in PHP Functions
 * File 1: String Functions
 *
 * Run: php 01-string-functions.php
 */

echo "=== Day 7: String Functions ===\n\n";

// ============================================
// STRING LENGTH
// ============================================
echo "1. String Length:\n";

$str = "Hello World";
echo "   String: '$str'\n";
echo "   strlen(): " . strlen($str) . " characters\n";
echo "   mb_strlen(): " . mb_strlen($str) . " characters\n\n";

// ============================================
// CASE CONVERSION
// ============================================
echo "2. Case Conversion:\n";

$text = "Hello World";
echo "   Original: '$text'\n";
echo "   strtoupper(): '" . strtoupper($text) . "'\n";
echo "   strtolower(): '" . strtolower($text) . "'\n";
echo "   ucfirst('hello'): '" . ucfirst("hello") . "'\n";
echo "   lcfirst('HELLO'): '" . lcfirst("HELLO") . "'\n";
echo "   ucwords('hello world'): '" . ucwords("hello world") . "'\n\n";

// ============================================
// SUBSTRING
// ============================================
echo "3. Substring Extraction:\n";

$str = "Hello World";
echo "   String: '$str'\n";
echo "   substr(\$str, 0, 5): '" . substr($str, 0, 5) . "'\n";
echo "   substr(\$str, 6): '" . substr($str, 6) . "'\n";
echo "   substr(\$str, -5): '" . substr($str, -5) . "'\n";
echo "   substr(\$str, -5, 3): '" . substr($str, -5, 3) . "'\n\n";

// ============================================
// STRING SEARCH
// ============================================
echo "4. String Search:\n";

$str = "Hello World, Hello PHP";
echo "   String: '$str'\n";
echo "   strpos(\$str, 'World'): " . strpos($str, "World") . "\n";
echo "   strpos(\$str, 'Hello', 7): " . strpos($str, "Hello", 7) . "\n";
echo "   strrpos(\$str, 'Hello'): " . strrpos($str, "Hello") . "\n";
echo "   strpos(\$str, 'Python'): " . (strpos($str, "Python") === false ? "false (not found)" : strpos($str, "Python")) . "\n";

// PHP 8+ functions
if (function_exists('str_contains')) {
    echo "   str_contains(\$str, 'World'): " . (str_contains($str, "World") ? "true" : "false") . "\n";
    echo "   str_starts_with(\$str, 'Hello'): " . (str_starts_with($str, "Hello") ? "true" : "false") . "\n";
    echo "   str_ends_with(\$str, 'PHP'): " . (str_ends_with($str, "PHP") ? "true" : "false") . "\n";
}
echo "\n";

// ============================================
// STRING REPLACE
// ============================================
echo "5. String Replace:\n";

$str = "Hello World";
echo "   Original: '$str'\n";
echo "   str_replace('World', 'PHP', \$str): '" . str_replace("World", "PHP", $str) . "'\n";

// Multiple replacements
$search = ["Hello", "World"];
$replace = ["Hi", "PHP"];
echo "   Replace multiple: '" . str_replace($search, $replace, $str) . "'\n";

// Case-insensitive
echo "   str_ireplace('WORLD', 'PHP', \$str): '" . str_ireplace("WORLD", "PHP", $str) . "'\n\n";

// ============================================
// TRIM FUNCTIONS
// ============================================
echo "6. Trim Functions:\n";

$str = "   Hello World   ";
echo "   Original: '$str' (with spaces)\n";
echo "   trim(): '" . trim($str) . "'\n";
echo "   ltrim(): '" . ltrim($str) . "'\n";
echo "   rtrim(): '" . rtrim($str) . "'\n";

$special = "###Hello###";
echo "   trim('###Hello###', '#'): '" . trim($special, "#") . "'\n\n";

// ============================================
// STRING PADDING
// ============================================
echo "7. String Padding:\n";

echo "   str_pad('42', 5, '0', STR_PAD_LEFT): '" . str_pad("42", 5, "0", STR_PAD_LEFT) . "'\n";
echo "   str_pad('42', 5, '0', STR_PAD_RIGHT): '" . str_pad("42", 5, "0", STR_PAD_RIGHT) . "'\n";
echo "   str_pad('Hi', 10, '-', STR_PAD_BOTH): '" . str_pad("Hi", 10, "-", STR_PAD_BOTH) . "'\n";
echo "   str_repeat('*', 10): '" . str_repeat("*", 10) . "'\n\n";

// ============================================
// SPLIT AND JOIN
// ============================================
echo "8. Split and Join:\n";

$csv = "apple,banana,cherry,date";
echo "   String: '$csv'\n";

$fruits = explode(",", $csv);
echo "   explode(',', \$csv): ";
print_r($fruits);

echo "   implode(' | ', \$fruits): '" . implode(" | ", $fruits) . "'\n";

$chars = str_split("Hello", 2);
echo "   str_split('Hello', 2): ";
print_r($chars);
echo "\n";

// ============================================
// FORMATTING
// ============================================
echo "9. Formatting:\n";

$name = "John";
$age = 25;
$price = 19.99;

echo "   printf(\"Name: %s, Age: %d\", \$name, \$age): ";
printf("Name: %s, Age: %d\n", $name, $age);

echo "   sprintf(\"Price: \$%.2f\", \$price): '" . sprintf("Price: $%.2f", $price) . "'\n";
echo "   number_format(1234567.891, 2): '" . number_format(1234567.891, 2) . "'\n";
echo "   number_format(1234567.891, 2, ',', ' '): '" . number_format(1234567.891, 2, ",", " ") . "'\n\n";

// ============================================
// CHARACTER FUNCTIONS
// ============================================
echo "10. Character Functions:\n";

echo "   ord('A'): " . ord('A') . " (ASCII code)\n";
echo "   chr(65): '" . chr(65) . "' (character from ASCII)\n";
echo "   ord('a'): " . ord('a') . "\n";
echo "   chr(97): '" . chr(97) . "'\n\n";

// ============================================
// PRACTICAL EXAMPLES
// ============================================
echo "11. Practical Examples:\n";

// Slugify function
function slugify($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

// Truncate function
function truncate($text, $length, $suffix = "...") {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $suffix;
}

// Format title
function formatTitle($title) {
    return ucwords(strtolower(trim($title)));
}

$title = "  HELLO WORLD! welcome to PHP  ";
echo "   Original: '$title'\n";
echo "   formatTitle(): '" . formatTitle($title) . "'\n";
echo "   slugify(): '" . slugify($title) . "'\n";
echo "   truncate(20): '" . truncate(trim($title), 20) . "'\n";
