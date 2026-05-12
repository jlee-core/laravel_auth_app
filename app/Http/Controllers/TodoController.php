<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Services\TodoService;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = auth()->user()
            ->todos()
            ->latest()
            ->get();

        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_done' => ['nullable', 'boolean'],
        ]);

        $request->user()
            ->todos()
            ->create($validated);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todoを作成しました。');
    }

    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);

        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'is_done' => 'nullable|boolean',
        ]);

        $todo->update($validated);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todoを更新しました。');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todoを削除しました。');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->sort ?? 'desc';

        $todos = Todo::query()
            ->where('is_done', 0)
            ->orderby('created_at', $sort)
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            })
            ->get();
        return view('todos.search', compact('todos', 'keyword', 'sort'));
    }
}
