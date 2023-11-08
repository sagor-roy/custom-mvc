<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo env('APP_NAME') ?></title>
</head>

<body>

    <ol>
        <?php foreach ($student as $value) : ?>
            <li><?php echo 'Name : ' . $value["name"] . ', Email : ' . $value['email'] ?></li>
        <?php endforeach; ?>
    </ol>
</body>

</html>