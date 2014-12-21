<?php

$loader = require __DIR__ . '/../vendor/autoload.php';

$loader->add('Mcustiel\\SimpleRequest', __DIR__ . '/../src');
$loader->add('Mcustiel\\SimpleCache', __DIR__ . '/../vendor/mcustiel/php-simple-cache/src');
$loader->add('Unit\\', __DIR__ . '/unit');
$loader->add('Integration\\', __DIR__ . '/integration');
$loader->add('Fixtures\\', __DIR__ . '/fixtures');
$loader->add('Doctrine\\', __DIR__ . '/../vendor/doctrine/annotations/lib');

$loader->register();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));