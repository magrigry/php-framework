<!DOCTYPE html>
<html>

<head>
    <title></title>

    <meta name="Description" content="">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="<?= App\Config::url('/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= App\Config::url('/css/mdb.css') ?>" rel="stylesheet">
    <link href="<?= App\Config::url('/css/style.css') ?>" rel="stylesheet">
</head>

<body>

<?= $content ?>


<script type="text/javascript" src="<?= App\Config::url('/js/jquery-3.3.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= App\Config::url('/js/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?= App\Config::url('/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?= App\Config::url('/js/mdb.js') ?>"></script>

</body>

</html>