<?php
define('APP_START', microtime(true));

// 加载vendor
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

// 加载请求参数
$request = Request::createFromGlobals();
// 加载路由配置
$routes = include __DIR__.'/../app/routes.php';
 
$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
 
$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

include __DIR__.'/../framework/Framework.php';
$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);
 
$response->send();