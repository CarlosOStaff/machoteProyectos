<?php
class Core
{
  protected $controller;
  protected $method;
  protected $parameters = [];
  public function __construct()
{
    $url = $this->getUrl();

    // Controlador predeterminado
    $this->controller = isset($url[0]) ? ucwords($url[0]) : 'Views'; // Cambia 'Home' por tu controlador predeterminado
    unset($url[0]);

    // Verifica si el archivo del controlador existe
    if(file_exists('../app/controllers/' . $this->controller . '.php'))
    {
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
    } else {
        die("Error: El controlador '{$this->controller}' no existe.");
    }

    // Método predeterminado
    $this->method = isset($url[1]) ? $url[1] : 'inicio'; // Cambia 'index' si tienes un método predeterminado diferente
    unset($url[1]);

    // Comprueba si el método existe en el controlador
    if(!method_exists($this->controller, $this->method)) {
        die("Error: El método '{$this->method}' no existe en el controlador '{$this->controller}'.");
    }

    $this->parameters = $url ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method], $this->parameters);
}


public function getUrl()
{
    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
    return []; // Devuelve un arreglo vacío si no hay URL
}

}
