<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth', ['except'=>'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
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
            'title' => 'required',
            'content' => 'required',
            'date' => 'required'
        ]);

        Task::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'required_date' => $request->date
        ]);

        return redirect()->back()->with('message', "Successfully added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($task)
    {
        $data = Task::where('id', $task)->first();
        return view('tasks.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($task)
    {
        $data = Task::where('id', $task)->first();
        return view('tasks.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $task)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'date' => 'required'
        ]);

        Task::where('id', $task)->update([
            'title' => $request->title,
            'content' => $request->content,
            'required_date' => $request->date
        ]);

        return redirect()->back()->with('message', "Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($task)
    {
        Task::where('id', $task)->delete();
        return redirect()->back()->with('message', "Task deleted successfully");
    }
    
    public function taskDone(Request $request, $task)
    {
        Task::where('id', $task)->update([
            'status' => 'done'
        ]);

        return redirect()->back()->with('message', "Task successfully done.");        
    }

    public function taskUnDone(Request $request, $task)
    {
        Task::where('id', $task)->update([
            'status' => 'waiting'
        ]);

        return redirect()->back()->with('message', "Status WAITING recovered.");        
    }
}
