<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture 1</title>
</head>
<body>
 
<?php
// Challenge 1: Displaying Information
$name = "Gabrlel";
$age = 28;
$favorite_color = "grey";

echo "My name is $name. I am $age years old and my favorite color is $favorite_color.";
?>
<br><br>

<?php
// Challenge 2: Using Escape Characters
echo "He said, \"PHP is fun!\" and left.<br>";
echo "First line\nSecond line";
echo "<br>First line <br>Second line"; // When I run in my browser, \n did not work. So I used <br> for line break
?>
<br><br>

<?php
// Challenge 2:Correcting Syntax Errors
$age = 25;
echo "Welcome to the PHP world!\n";
Echo "Your age is $age";

echo "<br>Welcome to the PHP world!<br>"; 
Echo "Your age is $age";
?>
<br><br>

<?php 
// Challenge 3: Fix Error
echo "Welcome to PHP!\n"; // Missing semicolon, added a line break
$name = "John"; // String need double quotes
echo "Hello, $name"; // Single quotes do not express the variable
?>
<br><br>

<?php
// Challenge 4: Adding Comments to Code

# Original price of the item
$price = 50; 
$discount = 10; // The discount amount

/* Calculate the final price by subtracting the discount 
   from the original price */
$finalPrice = $price - $discount; 

# Display the final total price
echo "Total price: $" . $finalPrice;
?>  

</body>
</html>
