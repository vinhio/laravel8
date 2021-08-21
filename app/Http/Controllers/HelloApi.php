<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloApi extends Controller
{
    public function hello(Request $request): array
    {
        $param1 = $request->get('param1');

        return [];
    }
}
