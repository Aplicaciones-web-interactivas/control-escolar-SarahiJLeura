<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\group;

class TeacherController extends Controller
{
    public function indexTareas(Request $request){
        $groupId = $request->group_filter;

        $tasks = Task::where('teacher_id', auth()->id())
            ->when($groupId, function ($q) use ($groupId) {
                $q->where('group_id', $groupId);
            }, function ($q) {
                $q->whereRaw('1 = 0');
            })
            ->get();

        $groups = Group::whereHas('schedule', function($q){
            $q->where('teacher_id', auth()->id());
        })->get();

        return view('teacher.tareas', compact('tasks','groups','groupId'));
    }

    public function saveTarea(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'group_id' => 'required|exists:groups,id'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'group_id' => $request->group_id,
            'teacher_id' => auth()->id()
        ]);
        return redirect()->back()->with('success', 'Tarea creada');
    }

    public function deleteTarea($id){
        $taskDelete = task::find($id);
        if ($taskDelete != null){
            $taskDelete->delete();
        }else{
            return redirect()->back()->withErrors('No se encontro la tarea');
        }
        return redirect()->back();
    }

    public function editTarea($id){
        $tarea = task::find($id);
        return view('teacher.modificaTarea')->with('tarea', $tarea);
    }

    public function updateTarea(Request $request, $id){
        $tareaEditar = task::find($id);
        if ($tareaEditar != null){
            $tareaEditar->title = $request->title;
            $tareaEditar->description = $request->description;
            $tareaEditar->due_date = $request->due_date;
            $tareaEditar->save();
        }else{
            return redirect()->back()->withErrors('No se encontro la tarea');
        }
        return redirect('/teacher/tareas');
    }

    public function verEntregas($taskId){
        $task = task::with('submissions.student')->findOrFail($taskId);
        return view('teacher.entregas', compact('task'));
    }

    public function indexTeacher(){
        return view('teacher.dashboard');
    }
    public function teacherGroups(){
        return view('teacher.grupos');
    }

    public function teacherGrades(){
        return view('teacher.calificaciones');
    }
}
