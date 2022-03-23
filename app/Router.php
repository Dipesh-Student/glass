<?php

namespace App;

class Router
{
  private array $handlers;
  private $noHandler;
  private Request $request;
  private const METHOD_GET = 'GET';
  private const METHOD_POST = 'POST';
  private string $prefix = '';

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  /**
   * Undocumented function
   *
   * @param string $method
   * @param string $path
   * @param [type] $handlers
   * @return void
   */
  private function addHandler(string $method, string $path, $handlers)
  {
    $this->handlers[$method . $this->prefix . $path] = [
      'path' => $this->prefix . $path,
      'method' => $method,
      'handler' => $handlers,
    ];
  }

  /**
   * function to handle pageNotFound|404 error
   *
   * @param array $handler
   * @return void
   */
  public function addNotFoundHandler($handler)
  {
    $this->noHandler = $handler;
  }

  /**
   * function to handle GET request
   *
   * @param string $path
   * @param array|mixed $handlers
   * @return void
   */

  public function get($path, $handlers)
  {
    $this->addHandler(self::METHOD_GET, $path, $handlers);
  }

  /**
   * function to handle POST request
   *
   * @param string $path
   * @param array|mixed $handlers
   * @return void
   */
  public function post(string $path, $handlers)
  {
    $this->addHandler(self::METHOD_POST, $path, $handlers);
  }

  public function groupPrefix(string $prefix, callable $callback)
  {
    $this->prefix = $prefix;
    $callback($this);
    $this->prefix = '';
  }

  public function groupControllers(string $prefix, $controllerClass, callable $callback)
  {
    //echo "<pre>";
    //echo $prefix;
    //echo $callback($this);
    //print_r($controllerClass);

    $this->prefix = $prefix;
    $controller = $controllerClass;
    $xarray = [];
    foreach ($this->handlers as $handler) {
      if (is_array($handler)) {
        //echo (array) $handler['handler'][0];
        foreach ((array) $handler['handler'] as $values) {
          if (!is_object($values)) {
            echo $values;
          }
          array_push($xarray, $values);
        }
      }
      //print_r($handler);
    }
    //print_r($xarray);
    $callback($this);

    // $oldGlobalFilters = $this->globalFilters;

    // $oldGlobalPrefix = $this->globalRoutePrefix;

    // $this->globalFilters = array_merge_recursive($this->globalFilters, array_intersect_key($filters, [Route::AFTER => 1, Route::BEFORE => 1]));

    // $newPrefix = isset($filters[Route::PREFIX]) ? $this->trim($filters[Route::PREFIX]) : null;

    // $this->globalRoutePrefix = $this->addPrefix($newPrefix);

    // $callback($this);

    // $this->globalFilters = $oldGlobalFilters;

    // $this->globalRoutePrefix = $oldGlobalPrefix;
  }

  public function getRegisteredRoutes()
  {
    return $this->handlers;
  }

  /**
   * Dispatch/execute callback handlers
   * WARNING :: using echo or print to print statement in the following function may result in
   *            headers already sent error
   *
   * @return void
   */
  public function run()
  {
    $requestUri = parse_url($_SERVER['REQUEST_URI']);

    if ($requestUri['path'] === '/') {
      $requestPath = $requestUri['path'];
    } else {
      $requestPath = rtrim($requestUri['path'], '/');
    }

    $method = $_SERVER['REQUEST_METHOD'];

    $callback = null;

    $routeNames = [];

    $routeParams = array();

    foreach ($this->handlers as $handler) {
      if (($handler['path'] === $requestPath) && ($method === $handler['method'])) {
        $callback = $handler['handler'];
      }
    }

    //echo "<pre>";
    //print_r($this->handlers);

    /**
     * get callback path and handlers
     */

    if ($callback == null) {
      foreach ($this->handlers as $handler) {

        if ($handler['path'] == '/') {

          //todo path uri null
          //skip

        } else {

          $route = trim($handler['path'], '/');

          if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) { // Find all route names from route and save in $routeNames
            $routeNames = $matches[1];
          }

          $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn ($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

          if (preg_match_all($routeRegex, trim($requestPath, '/'), $valueMatches)) {
            $values = [];
            for ($i = 1; $i < count($valueMatches); $i++) {
              $values[] = $valueMatches[$i][0];
            }
            $routeParams = array_combine($routeNames, $values);
            $this->request->setRouteParams($routeParams);
            //$finalvalue = $this->request->getRouteParams();
            $handler = $handler['handler'];
            return call_user_func_array(array($handler['0'], $handler[1]), array($routeParams));
          }
        }
      }
    }

    /**
     * case if callback is not an anonymous function
     */
    if (!is_string($callback)) {
      // $parts = explode('::', $callback);
      // if (is_array($parts)) {
      //   $className = array_shift($parts);
      //   $handler = new $className;

      //   $method = array_shift($parts);
      //   $callback = [$handler, $method];
      // }
      //print_r($callback);
    }

    if (is_string($callback)) {
      echo $callback;
      die;
    }

    if (is_array($callback)) {
      //echo "handler is array";
      $params = array();
      if (!empty($callback[2])) {
        $params[] = $callback[2];
      }
      return call_user_func_array(array('\\' . $callback[0], $callback[1]), $params);
    }

    /**
     * case if route not found|invalid route|route not set
     * @return mixed error
     */
    if (!$callback && !(is_callable($callback))) {
      header("HTTP/1.0 404 Not Found");
      if (!empty($this->noHandler)) {
        $callback = $this->noHandler;
      }
    }

    /**
     * @method mixed call_user_func_array()
     * @param mixed $callback path in url
     * @param mixed @method mixed array_merge() handle if route request is GET or POST
     * @return void
     */
    return call_user_func_array($callback, [
      array_merge($_GET, $_POST)
    ]);
  }
}
