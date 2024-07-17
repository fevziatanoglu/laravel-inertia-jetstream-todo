<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    function todos()
    {
        return  Inertia::render('Todo' , ['todos' => Todo::orderBy('created_at', 'desc')->get()]);
    }

    function store(Request $request)
    {

        $validatedRequest = $request->validate([
            'todo' => 'required|string|min:3|max:500',
        ]);
        $todo = Todo::create($validatedRequest);
        return response()->json(['todo'=>$todo , 'message' => 'Todo created successfully']);
    }
}
