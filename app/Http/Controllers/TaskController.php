<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index(Request $request, $group_key = null)
    {
        // If a group_key is provided in the URL
        // Check if tasks with that group_key exist
        if ($group_key && Task::where('group_key', $group_key)->exists()) {
            // If they do, set it as the session group_key
            session(['group_key' => $group_key]);
            $uniqueid = $group_key;
        } elseif(!session('group_key') || request('new_group_key')) {
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
        $task = Task::where('group_key', $uniqueid)->first();
        $list_name = $task ? $task->list_name : null;
        $count = $tasks->count();
        $lists = $this->getOtherLists($request, $uniqueid);
        return response()->view('tasks.index', compact('tasks', 'count', 'list_name', 'lists'))->header('HX-Push', url('/tasks/' . $uniqueid));
    }

    private function getOtherLists(Request $request, $currentGroupKey)
    {
        $cookies = $request->cookies->all();
        $taskLists = [];

        foreach ($cookies as $name => $value) {
            if (Str::startsWith($name, 'task_')) {
                $group_key = substr($name, strlen('task_')); // get the string after 'task_'
                // Skip the current list
                if ($group_key === $currentGroupKey) {
                    continue;
                }

                $list_name = Task::where('group_key', $group_key)->select('list_name')->first();

                if ($list_name) {
                    $taskLists[$group_key] = $list_name->list_name;
                }


            }
        }
        return $taskLists;
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
            'group_key' => $request->input('group_key'),
            'list_name' => $request->input('list_name')
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

    public function editname($group_key)
    {
        $list_name = Task::where('group_key', $group_key)->first()->list_name;
        return response(view('tasks.change_title', ['group_key' => $group_key, 'list_name' => $list_name]), 200);
    }

    public function namelist(Request $request, $group_key)
    {
        // Add new list name to all tasks with the same group_key
        Task::where('group_key', $group_key)->update(['list_name' => $request->input('list_name')]);

        $list_name = Task::where('group_key', $group_key)->first()->list_name;
        return response(view('tasks.title', ['list_name' => $list_name ]), 200)->withCookie(cookie('task_'.$group_key, $list_name, 60 * 24 * 365));
    }
}
