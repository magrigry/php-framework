<p>Afficher chemin vers une route: <?= $controller->Router->showPath('test', ['test' => 'ohoho']) ?></p>
<p>Paramètre dans l'url: <?= $controller->Request->get('test'); ?></p>