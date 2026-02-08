<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;

class TestResultController extends Controller
{
    public function store(Request $request)
    {
        $result = TestResult::create([
            'user_id' => Auth::id(),
            'score' => $request->input('score'),
            'answers' => $request->input('answers'),
        ]);
        return response()->json(['success' => true, 'result_id' => $result->id]);
    }
}
