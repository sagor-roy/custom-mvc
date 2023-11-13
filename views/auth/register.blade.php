<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h5>Register</h5>

    <?php if (!empty($_SESSION['errors'])) : ?>
        <br>
        <ul>
            <?php foreach ($_SESSION['errors'] as $attribute => $errorMessages) : ?>
                <?php foreach ($errorMessages as $errorMessage) : ?>
                    <li><?php echo $errorMessage; ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
        <br>
    <?php endif;
    unset($_SESSION['errors']);
    ?>

    <br>
    <p>
        <?php
        if (App\Base\Session::has('message')) :
            echo App\Base\Session::get('message');
            unset($_SESSION['message']);
        endif;
        ?>
    </p>
    <br>

    <form action="customer/store" method="post">
        <input type="text" name="name" placeholder="name"> <br><br>
        <input type="email" name="email" placeholder="email"> <br><br>
        <input type="password" name="password" placeholder="password"> <br><br>
        <button type="submit">register</button>
        <a href="/login">login</a>
    </form>
</body>

</html>