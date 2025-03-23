<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    // Fetch all tasks and return Inertia response
    public function index()
    {
        return Inertia::render('KanbanBoard', [
            'tasks' => Task::orderBy('position')->get()
        ]);
    }

    // Create a new task
    public function store(Request $request)
    {
        $task = Task::create($request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:To Do,In Progress,Done',
            'position' => 'required|integer'
        ]));

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    // Update task details
    public function update(Request $request, Task $task)
    {
        $task->update($request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:To Do,In Progress,Done',
        ]));

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        if ($request->header('X-Inertia')) {
            return redirect()->route('tasks.index')->with([
                'success' => 'Task deleted successfully.'
            ]);
        }

        return response()->json(['message' => 'Task deleted successfully']);
    }
    // Handle drag-and-drop task reordering
    public function reorder(Request $request)
    {
        foreach ($request->tasks as $taskData) {
            Task::where('id', $taskData['id'])->update([
                'position' => $taskData['position'],
                'status' => $taskData['status']
            ]);
        }

        return response()->json(['message' => 'Tasks reordered successfully']); // ✅ Fix redirect issue
    }

}
