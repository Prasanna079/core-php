<?php
/**
 * Day 7: Built-in PHP Functions
 * File 3: Date and Time Functions
 *
 * Run: php 03-date-functions.php
 */

echo "=== Day 7: Date and Time Functions ===\n\n";

// ============================================
// CURRENT DATE AND TIME
// ============================================
echo "1. Current Date and Time:\n";

echo "   time(): " . time() . " (Unix timestamp)\n";
echo "   date('Y-m-d'): " . date("Y-m-d") . "\n";
echo "   date('H:i:s'): " . date("H:i:s") . "\n";
echo "   date('Y-m-d H:i:s'): " . date("Y-m-d H:i:s") . "\n\n";

// ============================================
// DATE FORMAT CHARACTERS
// ============================================
echo "2. Date Format Examples:\n";

$timestamp = time();
echo "   date('Y'): " . date("Y", $timestamp) . " (4-digit year)\n";
echo "   date('y'): " . date("y", $timestamp) . " (2-digit year)\n";
echo "   date('m'): " . date("m", $timestamp) . " (month 01-12)\n";
echo "   date('n'): " . date("n", $timestamp) . " (month 1-12)\n";
echo "   date('F'): " . date("F", $timestamp) . " (full month name)\n";
echo "   date('M'): " . date("M", $timestamp) . " (short month name)\n";
echo "   date('d'): " . date("d", $timestamp) . " (day 01-31)\n";
echo "   date('j'): " . date("j", $timestamp) . " (day 1-31)\n";
echo "   date('l'): " . date("l", $timestamp) . " (full day name)\n";
echo "   date('D'): " . date("D", $timestamp) . " (short day name)\n";
echo "   date('N'): " . date("N", $timestamp) . " (day of week 1-7)\n";
echo "   date('H'): " . date("H", $timestamp) . " (hour 00-23)\n";
echo "   date('h'): " . date("h", $timestamp) . " (hour 01-12)\n";
echo "   date('A'): " . date("A", $timestamp) . " (AM/PM)\n\n";

// ============================================
// COMMON DATE FORMATS
// ============================================
echo "3. Common Date Formats:\n";

echo "   ISO 8601: " . date("Y-m-d\TH:i:sP") . "\n";
echo "   RFC 2822: " . date("r") . "\n";
echo "   US Format: " . date("m/d/Y") . "\n";
echo "   European: " . date("d/m/Y") . "\n";
echo "   Full: " . date("l, F jS, Y") . "\n";
echo "   Time: " . date("g:i A") . "\n\n";

// ============================================
// CREATING TIMESTAMPS
// ============================================
echo "4. Creating Timestamps:\n";

// mktime(hour, minute, second, month, day, year)
$christmas = mktime(0, 0, 0, 12, 25, 2024);
echo "   Christmas 2024: " . date("l, F j, Y", $christmas) . "\n";

$newYear = mktime(0, 0, 0, 1, 1, 2025);
echo "   New Year 2025: " . date("l, F j, Y", $newYear) . "\n\n";

// ============================================
// STRTOTIME - PARSE STRINGS
// ============================================
echo "5. strtotime() - Parse Date Strings:\n";

echo "   strtotime('2024-12-25'): " . date("Y-m-d", strtotime("2024-12-25")) . "\n";
echo "   strtotime('December 25, 2024'): " . date("Y-m-d", strtotime("December 25, 2024")) . "\n";
echo "   strtotime('next Monday'): " . date("Y-m-d (l)", strtotime("next Monday")) . "\n";
echo "   strtotime('last Friday'): " . date("Y-m-d (l)", strtotime("last Friday")) . "\n";
echo "   strtotime('+1 week'): " . date("Y-m-d", strtotime("+1 week")) . "\n";
echo "   strtotime('-3 days'): " . date("Y-m-d", strtotime("-3 days")) . "\n";
echo "   strtotime('+2 months'): " . date("Y-m-d", strtotime("+2 months")) . "\n";
echo "   strtotime('first day of next month'): " . date("Y-m-d", strtotime("first day of next month")) . "\n";
echo "   strtotime('last day of this month'): " . date("Y-m-d", strtotime("last day of this month")) . "\n\n";

// ============================================
// DATE CALCULATIONS
// ============================================
echo "6. Date Calculations:\n";

$date1 = strtotime("2024-01-01");
$date2 = strtotime("2024-12-31");
$diff = $date2 - $date1;
$days = $diff / (60 * 60 * 24);

echo "   Days between 2024-01-01 and 2024-12-31: " . $days . " days\n";

$futureDate = strtotime("2025-01-01");
$daysUntil = ($futureDate - time()) / (60 * 60 * 24);
echo "   Days until 2025-01-01: " . floor($daysUntil) . " days\n\n";

// ============================================
// DATETIME CLASS
// ============================================
echo "7. DateTime Class:\n";

$now = new DateTime();
echo "   Current: " . $now->format("Y-m-d H:i:s") . "\n";

$date = new DateTime("2024-12-25");
echo "   Christmas: " . $date->format("l, F j, Y") . "\n";

// Modify date
$date->modify("+1 month");
echo "   +1 month: " . $date->format("Y-m-d") . "\n";

// Add interval
$date->add(new DateInterval("P10D"));  // Add 10 days
echo "   +10 days: " . $date->format("Y-m-d") . "\n\n";

// ============================================
// DATE DIFFERENCE
// ============================================
echo "8. Date Difference (DateInterval):\n";

$d1 = new DateTime("2024-01-15");
$d2 = new DateTime("2025-06-20");
$diff = $d1->diff($d2);

echo "   From: " . $d1->format("Y-m-d") . "\n";
echo "   To: " . $d2->format("Y-m-d") . "\n";
echo "   Difference: " . $diff->format("%y years, %m months, %d days") . "\n";
echo "   Total days: " . $diff->days . "\n\n";

// ============================================
// TIMEZONE HANDLING
// ============================================
echo "9. Timezone Handling:\n";

echo "   Default timezone: " . date_default_timezone_get() . "\n";

$utc = new DateTime("now", new DateTimeZone("UTC"));
echo "   UTC: " . $utc->format("Y-m-d H:i:s T") . "\n";

$ny = new DateTime("now", new DateTimeZone("America/New_York"));
echo "   New York: " . $ny->format("Y-m-d H:i:s T") . "\n";

$tokyo = new DateTime("now", new DateTimeZone("Asia/Tokyo"));
echo "   Tokyo: " . $tokyo->format("Y-m-d H:i:s T") . "\n\n";

// ============================================
// PRACTICAL EXAMPLES
// ============================================
echo "10. Practical Examples:\n";

// Calculate age
function getAge($birthDate) {
    $birth = new DateTime($birthDate);
    $now = new DateTime();
    return $birth->diff($now)->y;
}

echo "    Age (born 1990-05-15): " . getAge("1990-05-15") . " years\n";

// Is weekend?
function isWeekend($date = null) {
    $day = date("N", $date ? strtotime($date) : time());
    return $day >= 6;
}

echo "    Is today weekend? " . (isWeekend() ? "Yes" : "No") . "\n";

// Days until event
function daysUntil($targetDate) {
    $now = new DateTime();
    $target = new DateTime($targetDate);
    $diff = $now->diff($target);
    return $target > $now ? $diff->days : -$diff->days;
}

echo "    Days until 2025-01-01: " . daysUntil("2025-01-01") . "\n";

// Format relative time
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) return "$diff seconds ago";
    if ($diff < 3600) return floor($diff / 60) . " minutes ago";
    if ($diff < 86400) return floor($diff / 3600) . " hours ago";
    if ($diff < 604800) return floor($diff / 86400) . " days ago";
    return date("M j, Y", $time);
}

$pastDate = date("Y-m-d H:i:s", strtotime("-2 hours"));
echo "    Time ago ($pastDate): " . timeAgo($pastDate) . "\n";
