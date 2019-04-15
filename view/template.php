<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $this->getAttr('title', 'Mon titre par défaut') ?></title>

    <meta name="Description" content="<?= $this->getAttr('description', 'Ma description par défaut') ?>">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="<?= $this->app->url('/public/framework/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= $this->app->url('/public/framework/css/mdb.css') ?>" rel="stylesheet">
    <link href="<?= $this->app->url('/public/framework/css/style.css') ?>" rel="stylesheet">
</head>

<body>

<?php
    $this->ifCurrentPage('home', '<h1>Welcome on Home Page</h1>');
?>

<div class="container">
    <?php foreach ($this->errors as $error): ?>
        <div class="alert alert-danger m-5" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
</div>

<?= $content ?>


<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/jquery-3.3.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/mdb.js') ?>"></script>

</body>

</html>