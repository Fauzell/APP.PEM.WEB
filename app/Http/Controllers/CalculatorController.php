<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function calculate(Request $request)
    {
        $expression = $request->input('expression');

        try {
            $result = eval("return $expression;");
        } catch (\Throwable $e) {
            $result = 'Error';
        }

        return response()->json(['result' => $result]);
    }
}
