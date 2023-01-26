<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo env('APP_NAME') ?></title>
</head>

<body>
    <h1>Hello Home Page</h1>

    <ul>
        <?php foreach ($result as $value) : ?>
            <li><?php echo 'Name : '. $value["name"] .', Email : '. $value['email'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>