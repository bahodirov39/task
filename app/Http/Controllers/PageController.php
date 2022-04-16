<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $data = Task::select(
            DB::raw('tasks.*'),
            "users.id as uid",
            "users.name",
        )
        ->orderBy('required_date', 'DESC')
        ->join('users', 'users.id', '=', 'tasks.user_id')
        ->paginate(5);

        return view('pages.index', [
            'data' => $data
        ]);
    }
}
