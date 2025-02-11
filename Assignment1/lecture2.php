<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture 2</title>
</head>
<body>
    
<?php
// Challenge 1 
$number1 = 10;
$number2 = 5;

echo "Number 1: " . $number1;
echo "<br>Number 2: " . $number2;
echo "<br>Addition: " . $number1 + $number2;
echo "<br>Subtraction: " . $number1 - $number2;
echo "<br>Multiplication: " . $number1 * $number2;
echo "<br>Division: " . $number1 / $number2;
echo "<br>Modulus: " . $number1 % $number2;
/*
Again, I have to use <br> for line breaks
because \n does not work on my browser
*/
?>
<br><br>

<?php
// Challenge 2
$input = 7;

if(($input % 2) == 0){
    $output = "even";
} else {
    $output = "odd";
}

echo "$input is an $output number.";
?>
<br><br>

<?php
// Challenge 3
$myNumber = 10;
echo "Starting number: " . $myNumber;
echo "<br>After increment: " .  ++$myNumber;
echo "<br>After decrement: " .  --$myNumber;
?>
<br><br>

<?php
// Challenge 4
$grade = 85;
if($grade >= 90){
    $letterGrade = "A";
} elseif($grade >= 80){
    $letterGrade = "B";
} elseif($grade >= 70){
    $letterGrade = "C";
} elseif($grade >= 60){
    $letterGrade = "D";
}else{
    $letterGrade = "F";
} 

echo "You got a " . $letterGrade . "!";
?>
<br><br>

<?php
// Challenge 5
$year = 2024;

if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
    echo "$year is a leap year.";
} else {
    echo "$year is not a leap year.";
}
?>
</body>
</html>
