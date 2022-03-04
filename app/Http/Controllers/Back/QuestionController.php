<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\QuestionRequest;
use App\Models\Question;
use App\Services\Back\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends BackController
{
    private QuestionService $questionService;

    public function __construct()
    {
        $this->questionService = new QuestionService;
    }

    public function index(Request $request)
    {
        $items = Question::where($this->questionService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'id',
                $request->get('sort_dir') ?: 'desc'
            )->paginate(50);
        return view('back.questions.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.question_fields'),
        ]);
    }

    public function create()
    {
        return view('back.questions.edit', [
            'item' => null,
            'fields' => config('items.question_fields'),
        ]);
    }

    public function store(QuestionRequest $request)
    {
        $question = new Question;
        $question->fill($request->validated());
        $question->save();
        return response()->redirect(route('back.questions.edit', ['question' => $question->id]));
    }

    public function edit(Question $question)
    {
        return view('back.questions.edit', [
            'item' => $question,
            'fields' => config('items.question_fields'),
        ]);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->fill($request->validated());
        $question->save();
        return response()->success();
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect(route('back.questions.index'));
    }
}
