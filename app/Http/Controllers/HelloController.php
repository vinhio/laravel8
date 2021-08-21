<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function hello(Request $request): Factory|View|Application
    {
        $param1 = $request->get('param1');

        return view('welcome');
    }
}
