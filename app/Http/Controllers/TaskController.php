<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskValidation;

class TaskController extends Controller
{
    //to create a task :
    public function createTask(TaskValidation $request)
    {
        $taskDetails = $request->all();

        try {
            $tasks = Tasks::create([
                'title' => $taskDetails['title'],
                'description' => $taskDetails['description'],
                'long_description' => $taskDetails['long_description'],
                'priority' => $taskDetails['priority'],
                'completed' => $taskDetails['completed'],
                'start_date' => $taskDetails['start_Date'],
                'user_id' => \Auth::id(),
            ]);

            if ($tasks) {
                return response()->json(['message' => 'task created Successfully', 'task' => $tasks], 201);
            }
        } catch (\Exception $ex) {
            return response()->json(
                ['message' => 'Error while updating!',
                    'error' => $ex->getMessage(),
                ],
                400);
        }
    }
}
