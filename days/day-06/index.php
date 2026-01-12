<?php
/**
 * Day 06: PHP Functions
 */
?>

<h1>Day 06: PHP Functions</h1>

<!-- 1. Basic Function -->
<h3>1. Basic Function</h3>
<pre><?php
function sayHello() {
    echo "Hello, World!\n";
}

sayHello();
sayHello();
?></pre>

<!-- 2. Function with Parameter -->
<h3>2. Function with Parameter</h3>
<pre><?php
function greet($name) {
    echo "Hello, $name!\n";
}

greet("Alice");
greet("Bob");
?></pre>

<!-- 3. Multiple Parameters -->
<h3>3. Multiple Parameters</h3>
<pre><?php
function introduce($name, $age) {
    echo "I'm $name, $age years old.\n";
}

introduce("Alice", 25);
introduce("Bob", 30);
?></pre>

<!-- 4. Default Parameter -->
<h3>4. Default Parameter</h3>
<pre><?php
function greetUser($name, $msg = "Hello") {
    echo "$msg, $name!\n";
}

greetUser("Alice");
greetUser("Bob", "Hi");
?></pre>

<!-- 5. Return Value -->
<h3>5. Return Value</h3>
<pre><?php
function add($a, $b) {
    return $a + $b;
}

$sum = add(5, 3);
echo "Sum: $sum\n";
echo "10 + 20 = " . add(10, 20);
?></pre>
