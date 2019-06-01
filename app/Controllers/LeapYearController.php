<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Capsule\Manager as DB;

class LeapYearController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($this->is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year~~~!');
        }
 
        return new Response('Nope, this is not a leap year~~~~.');
    }

    public function testAction(Request $request, $year)
    {
        $data = DB::select("select * from test");
        var_dump($data);die;
        return new Response('testAction ~~~~');
    }

    private function is_leap_year($year = null) {
        if (null === $year) {
            $year = date('Y');
        }
    
        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}