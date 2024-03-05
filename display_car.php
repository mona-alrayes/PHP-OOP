
<?php
require_once 'oop.php';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Car Information</title>
</head>

<body>
<div class="bg-img">
      <div class="content">
         <header>Car Information</header>
         <?php
         if (isset($_SESSION['car_object'])) {
            // Retrieve Car object from session global variable and put it in car1 so it became an object 
            // and since I required oop.php in the head of the page so car1 can call method print() to print the result
            $car1 = $_SESSION['car_object'];
            $car1->print();
            session_unset();
            session_destroy();
         } else {
            echo "لا توجد معلومات للعرض ";
         }
         
         ?>
      </div>
   </div>
</body>

</html>