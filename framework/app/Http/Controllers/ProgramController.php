<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Programs\ProgramService;

class ProgramController extends Controller
{
    public function index(ProgramService $programService)
    {
        $today = $programService->getTargetDay();
        $programs = $programService->getTodaysPrograms($today);
        $weekDays = $programService->getWeekDays();
        return view('programs.index', ['programs' => $programs, 'weekDays' => $weekDays, 'targetDay' => strVal($today)]);
    }

    public function show(Request $request, ProgramService $programService)
    {
        $targetDay = $request->input('targetDay');
        $programs = $programService->getTodaysPrograms($targetDay);
        $weekDays = $programService->getWeekDays();
        return view('programs.index', ['programs' => $programs, 'weekDays' => $weekDays, 'targetDay' => strVal($targetDay)]);
    }
}
