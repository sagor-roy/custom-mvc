<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo env('APP_NAME') ?></title>
</head>

<body>

    <br>

    <?php if (!empty($_SESSION['errors'])) : ?>
        <ul>
            <?php foreach ($_SESSION['errors'] as $attribute => $errorMessages) : ?>
                <?php foreach ($errorMessages as $errorMessage) : ?>
                    <li><?php echo $errorMessage; ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    <?php endif;
    unset($_SESSION['errors']);
    ?>

    <br>

    <form action="/user/create" method="post">
        <input type="text" name="email">
        <input type="text" name="name">
        <button type="submit">Submit</button>
    </form>

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

    <ol>
        <?php foreach ($result as $value) : ?>
            <li><?php echo 'Name : ' . $value["name"] . ', Email : ' . $value['email'] ?> <a href="/user/delete/<?= $value['id'] ?>">Delete</a> <a href="/view/<?= $value['id'] ?>">Edit</a></li>
        <?php endforeach; ?>
    </ol>
</body>

</html>