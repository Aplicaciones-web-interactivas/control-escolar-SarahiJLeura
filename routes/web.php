<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

//home
route::get('/', [AuthController::class, 'home'])->name('index.home');
//register
route::get('/register', [AuthController::class, 'indexRegister'])->name('index.register');
route::post('/register', [AuthController::class, 'saveRegister'])->name('save.register');

//login
route::get('/login', [AuthController::class, 'indexLogin'])->name('index.login');
route::post('/login', [AuthController::class, 'saveLogin'])->name('save.login');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * ADMIN
 */

route::get('/dashboard', [AdminController::class, 'indexAdmin'])->name('index.admin');
//materias
route::get('/materias', [AdminController::class, 'indexMateria'])->name('index.materias');
route::post('/guardarMateria', [AdminController::class, 'saveMateria'])->name('save.materia');
route::delete('/eliminarmateria/{id}', [AdminController::class, 'deleteMateria'])->name('delete.materia');
route::get('/modificarmateria/{id}', [AdminController::class, 'editMateria'])->name('edit.materia');
route::put('/modificarmateria/{id}', [AdminController::class, 'updateMateria'])->name('update.materia');
//horarios
route::get('/horarios', [AdminController::class, 'indexHorario'])->name('index.horarios');
route::post('/guardarHorario', [AdminController::class, 'saveHorario'])->name('save.horario');
route::delete('/eliminarHorario/{id}', [AdminController::class, 'deleteHorario'])->name('delete.horario');
route::get('/modificarHorario/{id}', [AdminController::class, 'editHorario'])->name('edit.horario');
route::put('/modificarHorario/{id}', [AdminController::class, 'updateHorario'])->name('update.horario');
//grupos
route::get('/grupos', [AdminController::class, 'indexGrupo'])->name('index.grupos');
route::post('/guardarGrupo', [AdminController::class, 'saveGrupo'])->name('save.grupo');
route::delete('/eliminarGrupo/{id}', [AdminController::class, 'deleteGrupo'])->name('delete.grupo');
route::get('/modificarGrupo/{id}', [AdminController::class, 'editGrupo'])->name('edit.grupo');
route::put('/modificarGrupo/{id}', [AdminController::class, 'updateGrupo'])->name('update.grupo');
//calificacion
route::get('/calificaciones',[AdminController::class, 'indexCalificacion'])->name('index.calificaciones');
route::post('/guardarCalificacion', [AdminController::class, 'saveCalificacion'])->name('save.calificacion');
route::delete('/eliminarCalificacion/{id}', [AdminController::class, 'deleteCalificacion'])->name('delete.calificacion');
route::get('/modificarCalificacion/{id}', [AdminController::class, 'editCalificacion'])->name('edit.calificacion');
route::put('/modificarCalificacion/{id}', [AdminController::class, 'updateCalificacion'])->name('update.calificacion');
//inscripcion
route::get('/inscripciones',[AdminController::class, 'indexInscripciones'])->name('index.inscripciones');
route::post('/guardarInscripcion', [AdminController::class, 'saveInscripcion'])->name('save.inscripcion');
route::delete('/eliminarInscripcion/{id}', [AdminController::class, 'deleteInscripcion'])->name('delete.inscripcion');
route::get('/modificarInscripcion/{id}', [AdminController::class, 'editInscripcion'])->name('edit.inscripcion');
route::put('/modificarInscripcion/{id}', [AdminController::class, 'updateInscripcion'])->name('update.inscripcion');

/**
 * STUDENT
 */

route::get('/student/dashboard', [StudentController::class, 'indexStudent'])->name('student.dashboard');
//grupos
route::get('/student/grupos', [StudentController::class, 'studentGroups'])->name('student.grupos');
//calificaciones
route::get('/student/calificaciones', [StudentController::class, 'studentGrades'])->name('student.calificaciones');
//tareas
route::get('/student/tareas', [StudentController::class, 'tareas'])->name('student.tareas');
route::post('/student/tareas/{id}', [StudentController::class, 'entregar'])->name('student.entregar');
route::get('/student/tarea/visualizar/{id}', [StudentController::class, 'verTarea'])->name('student.tarea.view');
route::get('/student/tarea/modificarEntrega/{id}', [StudentController::class, 'editEntrega'])->name('student.tarea.edit');
route::put('/student/tarea/modificarEntrega/{id}', [StudentController::class, 'updateEntrega'])->name('student.tarea.update');

/**
 * TEACHER
 */

route::get('/teacher/dashboard', [TeacherController::class, 'indexTeacher'])->name('teacher.dashboard');
//grupos
route::get('/teacher/grupos', [TeacherController::class, 'teacherGroups'])->name('teacher.grupos');
//calificaciones
route::get('/teacher/calificaciones', [TeacherController::class, 'teacherGrades'])->name('teacher.calificaciones');
route::post('/teacher/guardarCalificacion', [TeacherController::class, 'saveCalificacion'])->name('teacher.save.calificacion');
route::delete('/teacher/eliminarCalificacion/{id}', [TeacherController::class, 'deleteCalificacion'])->name('teacher.delete.calificacion');
route::get('/teacher/modificarCalificacion/{id}', [TeacherController::class, 'editCalificacion'])->name('teacher.edit.calificacion');
route::put('/teacher/modificarCalificacion/{id}', [TeacherController::class, 'updateCalificacion'])->name('teacher.update.calificacion');
//tareas
route::get('/teacher/tareas', [TeacherController::class, 'indexTareas'])->name('teacher.tareas');
route::post('/teacher/tareas', [TeacherController::class, 'saveTarea'])->name('teacher.tareas.save');
route::get('/teacher/tareas/{id}/entregas', [TeacherController::class, 'verEntregas'])->name('teacher.entregas');
route::delete('/teacher/eliminarTarea/{id}', [TeacherController::class, 'deleteTarea'])->name('teacher.tarea.delete');
route::get('/teacher/modificarTarea/{id}', [TeacherController::class, 'editTarea'])->name('teacher.tarea.edit');
route::put('/teacher/modificarTarea/{id}', [TeacherController::class, 'updateTarea'])->name('teacher.tarea.update');