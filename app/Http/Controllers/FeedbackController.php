<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FeedbackRating;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::query()->latest()->get();
        return view('feedbacks.index', compact('feedbacks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'feedback' => 'required'
        ]);
        Feedback::create([
            'order_id' => $request->order_id,
            'feedback' => $request->feedback
        ]);
        return redirect()->back()->with('success', 'Feedback is added successfully');
    }

    public function saveFeedback(Request $request)
    {
        // $payLoad = json_decode(request()->getContent(), true);
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required',
                'feedback' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        }
        if (!count($request->rating)) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        }
        $feedback = Feedback::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'feedback' => $request->feedback
        ]);
        if ($feedback) {
            foreach ($request->rating as $key => $value) {
                FeedbackRating::create([
                    'feedback_id' => $feedback->id,
                    'question_id' => $key,
                    'rating' => $value
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong at Server'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Feedback sent successfully'
        ], 200);
    }

    public function getQuestions(Request $request)
    {
        $questions = Question::all();
        return response()->json([
            'success' => true,
            'questions' => $questions
        ], 200);
    }
}
