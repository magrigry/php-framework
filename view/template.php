<?php

use Core\Config;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $this->getAttr('title', 'Mon titre par défaut') ?></title>

    <meta name="Description" content="<?= $this->getAttr('description', 'Ma description par défaut') ?>">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="<?= Config::url('/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= Config::url('/css/mdb.css') ?>" rel="stylesheet">
    <link href="<?= Config::url('/css/style.css') ?>" rel="stylesheet">
</head>

<body>

<?php
    $this->ifCurrentPage('home', 'ok');
?>

<div class="container">
    <?php foreach ($this->errors as $error): ?>
        <div class="alert alert-danger m-5" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
</div>

<?= $content ?>


<script type="text/javascript" src="<?= Config::url('/js/jquery-3.3.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= Config::url('/js/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?= Config::url('/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?= Config::url('/js/mdb.js') ?>"></script>

</body>

</html>