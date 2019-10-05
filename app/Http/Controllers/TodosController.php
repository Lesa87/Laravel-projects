<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public  function index()
    {
        $todos = Todo::all();
        return view('todos.index')->with('todos',$todos);
    }

    public function show(Todo $todo){
       // dd($todoId);//то же самое, что и в php die(var_dump($todoId)); - посмотреть что приходит в переменной
       // $todo = Todo::find($todoId);
        return view('todos.show')->with('todo', $todo);
    }

    public function create() {
        return view('todos.create');
    }

    public function store() {
        //dd(request()->all());
        $this->validate(request(),[
            'name'=>'required|min:6|max:12',
            'description'=>'required'
            ]);
        $data = request()->all();
        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;
        $todo->save();
        session()->flash('success', 'Todo created successfully');
        return redirect('/todos');
    }

    public function edit(Todo $todo){ // $todoId) {
         //$todo = Todo::find($todoId);

        return view('todos.edit')->with ('todo',$todo);
    }

        public function update(Todo $todo) { //$todoId) {
            //dd(request()->all());
            $this->validate(request(),[
                'name'=>'required|min:6|max:15',
                'description'=>'required'
            ]);
            $data = request()->all();
            //$todo = Todo::find($todoId);

            $todo->name = $data['name'];
                $todo->description = $data['description'];
            $todo->save();
            session()->flash('success', 'Todo updated successfully');
             return redirect('/todos');

        }

            public function destroy(Todo $todo) { //$todoId) {

                //$todo = Todo::find($todoId);
                $todo->delete();
            session()->flash('success','Todo deleted successfully');

            return redirect('/todos');
        }
    public function complete(Todo $todo) { //$todoId) {
        //dd(request()->all());
        $data = request()->all();
        //$todo = Todo::find($todoId);

        $todo->completed = True;
        $todo->save();
        session()->flash('success', 'Todo completed successfully');
        return redirect('/todos');

    }
}
