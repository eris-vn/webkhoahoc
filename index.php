<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

require_once 'model/model.php';
require_once 'model/connection.php';
require_once 'core.php';

$conn = (new DB())->connect();


$controller = isset($_GET['controller']) ? $_GET['controller'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$middleware = isset($_GET['middleware']) ? $_GET['middleware'] : null;

// xử lý middleware
if ($middleware) {
    $middlewareFile = "middleware/$middleware.php";
    if (file_exists($middlewareFile)) {
        require_once $middlewareFile;
    } else {
        exit('Không tìm thấy middleware');
    }
}

// xử lý controller
$controllerFile = "controllers/$controller.php";
if ($controller && file_exists($controllerFile)) {
    require_once $controllerFile;
} else {
    exit('Không tìm thấy controller');
}


// xử lý action
$splitClass = explode('/', $controller);
$class = count($splitClass) > 1 ? end($splitClass) : $splitClass;

$controllerInstance = new $class();

if (method_exists($controllerInstance, $action)) {
    $result = $controllerInstance->$action();
    echo $result;
} else {
    echo "Action không tồn tại";
}
