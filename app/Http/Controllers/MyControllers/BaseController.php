<?php
namespace App\Http\Controllers\MyControllers;
use App\Http\Controllers\Controller;
use Config;


class BaseController extends Controller
{
    protected $response;

    public function __construct(){
        $this->response = Config::get('error_code');
    }
}