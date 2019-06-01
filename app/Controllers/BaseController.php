<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController{
    private $request;
    public function __construct(){
        // $this->request = $request;

        include __DIR__.'/../../framework/db.php';
    }

    function viewString($request){
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__.'/../Views/%s.php', $_route);
        echo $foo;
        return new ob_get_clean();
    }

    public function view($request){
        return new Response($this->viewString($request));
    }
}