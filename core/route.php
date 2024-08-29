<?php
class Route
{
    private static $routes = [];

    public static function add($uri, $callback)
    {
        self::$routes[$uri] = $callback;
    }

    public static function dispatch()
    {
        $requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($requestedUri, self::$routes)) {
            $callback = self::$routes[$requestedUri];

            if (is_array($callback) && count($callback) == 2) {
                list($class, $method) = $callback;
                if (class_exists($class) && method_exists($class, $method)) {
                    call_user_func([new $class, $method]);
                } else {
                    echo "Classe ou método não encontrado!";
                }
            } else {
                echo "Callback inválido!";
            }
        } else {
            self::handleNotFound();
        }
    }

    public static function handleNotFound()
    {
        http_response_code(404);
        echo 'Página não encontrada!';
    }
}
