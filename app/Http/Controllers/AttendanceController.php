<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'timestamp' => 'required|date',
            'status' => 'required|string|in:present,absent,late',
            'remarks' => 'nullable|string',
        ]);

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'timestamp' => $validated['timestamp'],
            'status' => $validated['status'],
            'remarks' => $validated['remarks'],
        ]);

        return response()->json([
            'message' => 'Attendance recorded successfully',
            'attendance' => $attendance,
        ], 201);
    }

    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->get();
        return response()->json($attendances, 200);
    }

    public function show($id)
    {
        $attendance = Attendance::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        return response()->json($attendance, 200);
    }
}

