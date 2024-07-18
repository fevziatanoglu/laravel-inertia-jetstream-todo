<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TodoController extends Controller
{
    function todos()
    {
        if (!Auth::check()) {
            return Redirect::route('login');
        }
        $todos = Auth::user()->todos()->orderBy('created_at', 'desc')->get();
        return  Inertia::render('Todo', ['todos' => $todos]);
    }

    function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'todo' => 'required|string|min:3|max:500',
        ]);
        $validatedRequest['user_id'] = auth()->id();
        $todo = Todo::create($validatedRequest);
        
        return response()->json([ 'message' => 'Todo created successfully' , 'request' => $validatedRequest]);
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
