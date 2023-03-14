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