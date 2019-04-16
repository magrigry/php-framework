<?php

$_content_title = "Test Page";
$_content_description = "Test description";

?>

<?php ob_start(); ?>

    <p>Afficher chemin vers une route: <?= $route->showPath('test', ['test' => 'ohoho']) ?></p>
    <p>Afficher paramètre de la route: <?= $route->getParameter('test') ?></p>

<?php $_content_body = ob_get_clean(); ?>



<?php if(isset($errors['testError'])): ob_start(); ?>

    <h1>Test error !</h1>

<?php $_content_errors = ob_get_clean();  endif; ?>