<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo env('APP_NAME') ?></title>
    <style>
        table {
            width: 30%;
            text-align: center;
            border: 1px solid #ddd;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
</head>

<body>

    <br>

    <img src="<?= asset('uploads/avatar.png') ?>" width="50" alt="img">

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

    <!-- <ul>
        <?php foreach ($result as $value) : ?>
            <li><?= $value['name'] ?></li>
        <?php endforeach; ?>
    </ul> -->

    <table>
        <tr>
            <th>no</th>
            <th>name</th>
            <th>email</th>
            <th>amount</th>
        </tr>
        <?php foreach ($result as $key => $value) : ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['email'] ?></td>
                <td><?= $value['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>