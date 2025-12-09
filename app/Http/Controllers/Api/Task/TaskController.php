<?php

namespace App\Http\Controllers\Api\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;

class TaskController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        $tasks = Task::with('category') // Eager load to optimize and avoid N+1 problem
            ->filter($request->only(['priority', 'completed', 'category_id']))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return TaskResource::collection($tasks);
    }

    public function show(Task $task)
    {
        return $this->success(new TaskResource($task->load('category')));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return $this->success(new TaskResource($task), 'Task created successfully', 201);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return $this->success(new TaskResource($task), 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }


}
