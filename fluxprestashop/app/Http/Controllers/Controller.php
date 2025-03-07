<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function response($data, $status = 200)
    {
        return response()->json($data, $status);
    }
}
