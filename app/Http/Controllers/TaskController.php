<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($group_key = null)
    {
        // If a group_key is provided in the URL

        // Check if tasks with that group_key exist
        if ($group_key && Task::where('group_key', $group_key)->exists()) {
            // If they do, set it as the session group_key
            session(['group_key' => $group_key]);
            $uniqueid = $group_key;
        } elseif(!session('group_key')||request('new_group_key')) {
            // If no group_key is provided in the URL one does not exist in the session, generate a new one
            $uniqueid = $this->generateUniqueGroupKey();
            session(['group_key' => $uniqueid]);
        }

        $tasks = Task::when(
            request('filter') == 'remaining',
            function ($query) {
                return $query->where('done', 0);
            }
        )->when(
            request('filter') == 'done',
            function ($query) {
                return $query->where('done', 1);
            }
        )->where('group_key', $uniqueid)->get();

        $count = $tasks->count();
        return response()->view('tasks.index', compact('tasks', 'count'))->header('HX-Push', url('/tasks/' . $uniqueid));
    }

    private function generateUniqueGroupKey()
    {
        do {
            $uniqueid = Str::random(8);
        } while (Task::where('group_key', $uniqueid)->exists());

        return $uniqueid;
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->input('name'),
            'group_key' => $request->input('group_key')
        ]);
        $count = Task::where(
            'group_key',
            $request->input('group_key')
        )->count();
        $task->count = true;
        return response(view('tasks.task', compact('task', 'count')), 200);
    }

    public function edit()
    {
        $task = Task::find(request('task'));
        return response(view('tasks.edit', compact('task')), 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        $count = Task::where('group_key', $task->group_key)->count();
        return response()->view('tasks.count', compact('count'), 200);
    }

    public function update(Request $request, Task $task)
    {
        if (request()->has('name')) {
            $task->name = request('name');
        } else {
            $task->done = !$task->done;
        }

        $task->save();
        return response(view('tasks.task', compact('task')), 200);
    }
}
