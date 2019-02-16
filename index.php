<?php

define("__APP__", __DIR__);

require_once __APP__ . '/Kernel/bootstrap.php';

try {

    $app = new \Kernel\App();
    $app->render();

} catch (Exception $exception) {

    echo "Error code: {$exception->getCode()} <br/>Error message: {$exception->getMessage()}";

}
