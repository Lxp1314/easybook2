<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', [
    'name' => 'World!!!',
    '_controller' => function(Request $request){

        $request->attributes->set('foo', 'bar');
        $response = render_template($request);
        
        $response->headers->set('Content-Type', 'text/plain');
        return $response;
    }
]));
$routes->add('bye', new Routing\Route('/bye'));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'App\\Controllers\\LeapYearController::indexAction'
)));

$routes->add('test', new Routing\Route('/test/{year}', array(
    'year' => null,
    '_controller' => array(new App\Controllers\LeapYearController(), 'testAction')
)));

return $routes;

function render_template($request){
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/Views/%s.php', $_route);
    echo $foo;
    return new Response(ob_get_clean());
}