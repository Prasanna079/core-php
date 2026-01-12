<?php
/**
 * Day 7: Built-in PHP Functions
 * File 2: Math Functions
 *
 * Run: php 02-math-functions.php
 */

echo "=== Day 7: Math Functions ===\n\n";

// ============================================
// BASIC MATH
// ============================================
echo "1. Basic Math:\n";

echo "   abs(-15): " . abs(-15) . "\n";
echo "   abs(15): " . abs(15) . "\n";
echo "   abs(-3.5): " . abs(-3.5) . "\n\n";

// ============================================
// POWER AND ROOTS
// ============================================
echo "2. Power and Roots:\n";

echo "   pow(2, 8): " . pow(2, 8) . "\n";
echo "   pow(5, 3): " . pow(5, 3) . "\n";
echo "   2 ** 8: " . (2 ** 8) . " (same as pow)\n";
echo "   sqrt(144): " . sqrt(144) . "\n";
echo "   sqrt(2): " . sqrt(2) . "\n\n";

// ============================================
// ROUNDING
// ============================================
echo "3. Rounding:\n";

$num = 4.567;
echo "   Number: $num\n";
echo "   round(\$num): " . round($num) . "\n";
echo "   round(\$num, 1): " . round($num, 1) . "\n";
echo "   round(\$num, 2): " . round($num, 2) . "\n";

echo "\n   round(4.5): " . round(4.5) . " (rounds to even: 4)\n";
echo "   round(5.5): " . round(5.5) . " (rounds to even: 6)\n";

echo "\n   ceil(4.1): " . ceil(4.1) . " (round up)\n";
echo "   ceil(4.9): " . ceil(4.9) . "\n";
echo "   floor(4.1): " . floor(4.1) . " (round down)\n";
echo "   floor(4.9): " . floor(4.9) . "\n\n";

// ============================================
// MIN AND MAX
// ============================================
echo "4. Min and Max:\n";

echo "   min(2, 5, 1, 8): " . min(2, 5, 1, 8) . "\n";
echo "   max(2, 5, 1, 8): " . max(2, 5, 1, 8) . "\n";

$arr = [15, 3, 42, 7, 23];
echo "   Array: [" . implode(", ", $arr) . "]\n";
echo "   min(\$arr): " . min($arr) . "\n";
echo "   max(\$arr): " . max($arr) . "\n\n";

// ============================================
// RANDOM NUMBERS
// ============================================
echo "5. Random Numbers:\n";

echo "   rand(): " . rand() . " (random integer)\n";
echo "   rand(1, 100): " . rand(1, 100) . " (between 1-100)\n";
echo "   rand(1, 100): " . rand(1, 100) . " (another random)\n";

echo "\n   random_int(1, 100): " . random_int(1, 100) . " (cryptographically secure)\n";

// Random float between 0 and 1
$randomFloat = mt_rand() / mt_getrandmax();
echo "   Random float (0-1): " . round($randomFloat, 4) . "\n\n";

// ============================================
// MODULO
// ============================================
echo "6. Modulo (Remainder):\n";

echo "   17 % 5 = " . (17 % 5) . "\n";
echo "   20 % 4 = " . (20 % 4) . "\n";
echo "   15 % 7 = " . (15 % 7) . "\n";
echo "   fmod(17.5, 5): " . fmod(17.5, 5) . " (float modulo)\n\n";

// ============================================
// MATHEMATICAL CONSTANTS
// ============================================
echo "7. Mathematical Constants:\n";

echo "   M_PI: " . M_PI . "\n";
echo "   M_E: " . M_E . "\n";
echo "   M_SQRT2: " . M_SQRT2 . " (square root of 2)\n";
echo "   M_LOG2E: " . M_LOG2E . " (log base 2 of e)\n\n";

// ============================================
// TRIGONOMETRY
// ============================================
echo "8. Trigonometry:\n";

echo "   sin(0): " . sin(0) . "\n";
echo "   sin(M_PI/2): " . sin(M_PI / 2) . " (sin 90°)\n";
echo "   cos(0): " . cos(0) . "\n";
echo "   cos(M_PI): " . cos(M_PI) . " (cos 180°)\n";
echo "   tan(M_PI/4): " . tan(M_PI / 4) . " (tan 45°)\n";

// Degrees to radians and vice versa
echo "\n   deg2rad(180): " . deg2rad(180) . " (degrees to radians)\n";
echo "   rad2deg(M_PI): " . rad2deg(M_PI) . " (radians to degrees)\n\n";

// ============================================
// LOGARITHMS
// ============================================
echo "9. Logarithms:\n";

echo "   log(M_E): " . log(M_E) . " (natural log of e)\n";
echo "   log(100, 10): " . log(100, 10) . " (log base 10 of 100)\n";
echo "   log10(100): " . log10(100) . " (log base 10)\n";
echo "   log2(8): " . log2(8) . " (log base 2)\n";
echo "   exp(1): " . exp(1) . " (e^1)\n\n";

// ============================================
// NUMBER FORMATTING
// ============================================
echo "10. Number Formatting:\n";

$num = 1234567.891;
echo "    Number: $num\n";
echo "    number_format(\$num): " . number_format($num) . "\n";
echo "    number_format(\$num, 2): " . number_format($num, 2) . "\n";
echo "    number_format(\$num, 2, ',', ' '): " . number_format($num, 2, ",", " ") . "\n\n";

// ============================================
// PRACTICAL EXAMPLES
// ============================================
echo "11. Practical Examples:\n";

// Calculate percentage
function percentage($value, $total) {
    return round(($value / $total) * 100, 2);
}

echo "    75 out of 200 = " . percentage(75, 200) . "%\n";

// Calculate circle area
function circleArea($radius) {
    return M_PI * pow($radius, 2);
}

echo "    Circle area (r=5): " . round(circleArea(5), 2) . "\n";

// Distance between two points
function distance($x1, $y1, $x2, $y2) {
    return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
}

echo "    Distance (0,0) to (3,4): " . distance(0, 0, 3, 4) . "\n";

// Random password generator helper
echo "    Random 6-digit PIN: " . str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT) . "\n";

// Calculate compound interest
function compoundInterest($principal, $rate, $years, $n = 12) {
    return $principal * pow(1 + ($rate / $n), $n * $years);
}

echo "    \$1000 at 5% for 10 years: \$" . round(compoundInterest(1000, 0.05, 10), 2) . "\n";
