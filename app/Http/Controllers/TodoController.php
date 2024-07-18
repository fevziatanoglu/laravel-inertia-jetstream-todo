<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TodoController extends Controller
{
    function todos()
    {
        return  Inertia::render('Todo', ['todos' => Todo::orderBy('created_at', 'desc')->get()]);
    }

    function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'todo' => 'required|string|min:3|max:500',
        ]);
        $todo = Todo::create($validatedRequest);
        return response()->json(['todo' => $todo, 'message' => 'Todo created successfully' , 'request' => $request]);
    }

    function toggle($id) {
        $todo = Todo::find($id);
        $todo->completed =!$todo->completed;
        $todo->save();
        return response()->json(['todo' => $todo ]);
    }

    function delete($id){
        $todo = Todo::find($id);
        $todo->delete();
        return response()->json(['message' => 'Todo deleted successfully']);
    }

    function edit(Request $request){
        $todo = Todo::find($request->id);
        $todo->todo = $request->newTodo;
        $todo->save();
        return response()->json(['message' => 'Todo updated successfully']);

    }
}
