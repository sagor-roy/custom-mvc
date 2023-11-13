<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/user/update" method="post">
        <input type="hidden" name="id" value="<?= $result[0]['id'] ?>">
        <input type="email" value="<?= $result[0]['email'] ?>" name="email">
        <input type="text" value="<?= $result[0]['name'] ?>" name="name">
        <button type="submit">Update</button>
        <a href="/">Back</a>
    </form>
</body>

</html>