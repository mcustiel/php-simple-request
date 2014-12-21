<?php
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('Mcustiel\\', __DIR__ . '/../src');
$loader->add('Unit\\', __DIR__ . '/unit');
$loader->add('Integration\\', __DIR__ . '/integration');
$loader->add('Fixtures\\', __DIR__ . '/fixtures');
$loader->add('Doctrine\\', __DIR__ . '/../vendor/doctrine/annotations/lib');

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));