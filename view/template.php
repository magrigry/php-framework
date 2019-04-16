<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= (isset($_content_title)) ? $_content_title : 'Mon titre' ?></title>

    <meta name="Description" content="<?= (isset($_content_description)) ? $_content_description : 'Ma description' ?>">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="<?= $this->app->url('/public/framework/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= $this->app->url('/public/framework/css/mdb.css') ?>" rel="stylesheet">
    <link href="<?= $this->app->url('/public/framework/css/style.css') ?>" rel="stylesheet">
</head>

<body>

<?= (isset($_content_errors)) ? $_content_errors : '' ?>

<?= (isset($_content_body)) ? $_content_body : '' ?>

<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/jquery-3.3.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?= $this->app->url('/public/framework/js/mdb.js') ?>"></script>

</body>

</html>