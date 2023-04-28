<?php

namespace App\Http\Controllers;

use App\Services\Programs\ProgramService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request, ProgramService $programService)
    {
        $today = $programService->getTargetDay();

        return $this->returnView($request, $programService, $today);
    }

    public function show(Request $request, ProgramService $programService)
    {
        $selectedDay = $request->input('targetDay');

        return $this->returnView($request, $programService, $selectedDay);
    }

    public function update(Request $request, ProgramService $programService)
    {
        $programids = $request->input('programs', []);
        $targetDay = $request->input('hidTargetDay');
        $userid = $request->user()->id;
        $programService->notifyTargetFirstOrCreate($userid, $programids, $targetDay);

        return $this->returnView($request, $programService, $targetDay);
    }

    private function returnView(Request $request, ProgramService $programService, $targetDay)
    {
        $userid = $request->user()->id;
        $programs = $programService->getTodaysPrograms($targetDay, $userid);
        $weekDays = $programService->getWeekDays();

        return view('programs.index', ['programs' => $programs, 'weekDays' => $weekDays, 'targetDay' => strval($targetDay)]);
    }
}
