<?php

namespace App\Http\Controllers;

use App\Models\Calculated;
use Illuminate\Http\Request;
use Calculate;

/**
 * Class CalculateController
 * @package App\Http\Controllers
 */
class CalculateController extends Controller
{
    /**
     * Метод возврата данных по зарплате без сохранения
     * @param Request $request
     * @return mixed
     */
    public function show(Request $request)
    {
        return Calculate::init($request->all())->calculate();
    }

    public function store(Request $request)
    {
        $dataResult = Calculate::init($request->all())->calculate();
        $resultCalculate = Calculated::create($dataResult);
        return response()->json($resultCalculate, 201);
    }
}
