<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\group;
use App\Models\submission;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function tareas(Request $request){
        $groupId = $request->group_filter;
        $status = $request->status;

        // grupos del alumno
        $groups = Group::whereIn('id', function($query){
            $query->select('group_id')
                ->from('enrollments')
                ->where('user_id', auth()->id());
        })->get();

        if (!$groupId) {
            $tasks = collect();
        } else {
            $tasks = Task::with(['submissions' => function($q){
                    $q->where('student_id', auth()->id());
                }])
                ->where('group_id', $groupId)->get();

            // filtros
            $tasks = $tasks->filter(function($task) use ($status) {

                $submitted = $task->submissions->isNotEmpty();
                $isLate = Carbon::parse($task->due_date)->isPast();

                switch ($status) {
                    case 'terminadas':
                        return $submitted;

                    case 'pendientes':
                        return !$submitted && !$isLate;

                    case 'no_entregadas':
                        return !$submitted && $isLate;

                    default:
                        return true;
                }
            });
        }
        return view('student.tareas', compact('tasks','groups','groupId','status'));
    }

    public function entregar(Request $request, $taskId){
        $request->validate([
            'file_path' => 'required|mimes:pdf|max:2048'
        ]);

        $path = $request->file('file_path')->store('submissions','public');

        submission::create([
            'file_path' => $path,
            'task_id' => $taskId,
            'student_id' => auth()->id()
        ]);

        return redirect('/student/tareas')->with('success','Tarea entregada');
    }

    public function indexStudent(){
        return view('student.dashboard');
    }

    public function studentGroups(){
        return view('student.grupos');
    }

    public function studentGrades(){
        return view('student.calificaciones');
    }

    public function verTarea($id){
        $task = Task::find($id);

        if(!$task){
            return redirect()->route('student.tareas')->with('error', 'Tarea no encontrada.');
        }
        return view('student.verTarea', compact('task'));
    }

    public function editEntrega($id){
        $entrega = submission::find($id);
        return view('student.modificaEntrega')->with('entrega', $entrega);
    }

    public function updateEntrega(Request $request, $id){
        $entregaEditar = Submission::findOrFail($id);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('submissions', 'public'); // guarda en storage/app/public/submissions
            $entregaEditar->file_path = $path;
            $entregaEditar->save();
        } else {
            return redirect()->back()->withErrors('No se subió ningún archivo');
        }

        return redirect()->route('student.tareas')->with('success', 'Entrega actualizada correctamente');
    }

}
