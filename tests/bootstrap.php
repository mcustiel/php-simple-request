<?php
$loader = require __DIR__ . '/../vendor/autoload.php';

$loader->addPsr4('Unit\\', __DIR__ . '/unit');
$loader->addPsr4('Integration\\', __DIR__ . '/integration');
$loader->addPsr4('Fixtures\\', __DIR__ . '/fixtures');

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));