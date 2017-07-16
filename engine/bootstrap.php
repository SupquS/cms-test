<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Engine\App;
use Engine\DI\DI;

try {
    // Dependency Injection
    $di = new DI();

    $services = include __DIR__ . '/Config/Service.php';

    // Init services
    foreach ($services as $service) {
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new App($di);
    $cms->run();


} catch (\ErrorException $e) {
    echo $e->getMessage();
}
