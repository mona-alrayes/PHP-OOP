<?php
#########################################
//require'oop.php'; //we need this oop.php file to handle errors and print the results

####### check if the form is submitted then make new object of validator class to handle errors ######
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (count($_POST) > 0) {
        require 'oop.php';
        $car = new Validator();
        $CatchErrors = $car->CheckErrors($_POST);
        extract($_POST);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>car information</title>
</head>

<body>

    <div class="bg-img">
        <div class="content">
            <header>Car Information</header>
            <?php if (isset($CatchErrors) && is_array($CatchErrors) && count($CatchErrors) > 0) : ?>
                <div><?php foreach ($CatchErrors as $error) {
                            echo $error . "<br /><br>";
                        } ?></div><br>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="field">
                    <span><i class="fa-solid fa-building"></i> *</span>
                    <input type="text" placeholder=" Company Name" name="company" value="<?php echo isset($_POST['company']) ? $_POST['company'] : ''; ?>">
                </div>
                <div class="field space">
                    <span><i class="fa-solid fa-car"></i> *</span>
                    <input type="text" class="pass-key" placeholder=" Model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : ''; ?>">
                </div>
                <div class="field space">
                    <span><i class="fa-solid fa-calendar-days"></i> *</span>
                    <input type="text" placeholder=" Year of Production" name="year" value="<?php echo isset($_POST['year']) ? $_POST['year'] : ''; ?>">
                </div>
                <div class="field space">
                    <span><i class="fa-solid fa-money-check"></i> *</span>
                    <input type="text" class="pass-key" placeholder=" Price" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : ''; ?>">
                </div>
                <div class="pass">
                </div>
                <div class="field">
                    <input type="submit" value="Submit">
                </div>
            </form>

        </div>
    </div>
   
</body>

</html>