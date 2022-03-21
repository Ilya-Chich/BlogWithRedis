<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as User;
use App\Http\Middleware\CheckAge as CheckAge;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware(CheckAge::class);
    }

    public function init(string $id)
    {
        return __METHOD__;
    }

    public function store(...$args)
    {
        $request = array_shift($args);
        $name = $request->input('name');
    }
}
