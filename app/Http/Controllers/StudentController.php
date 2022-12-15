<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getAll(Request $request)
    {
        // $students = DB::table('students')->get();
        // $response = [
        //      'success' => true,
        //      'message' => "Estudiantes obtenidos correctamente",
        //      'data' => $students
        // ];
        // return response()->json($response);
        return Student::all();
    }

    public function getById(Request $request, $id)
    {
        if (!Student::find($id)) {
            return response('Id no encontrada', 404);
        }
        return Student::find($id);
    }

    public function create(Request $request)
    {
        Student::insert($request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'age' => 'nullable|integer',
            'password' => 'required|string',
            'email' => 'required|string|unique:students',
            'gender' => 'required|string'
        ]));
    }

    public function modify(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            DB::table('students')
                ->where('id', $id)
                ->update($request->validate([
                    'name' => 'string',
                    'phone' => 'string',
                    'age' => 'integer',
                    'password' => 'string',
                    'email' => 'string|unique:students',
                    'gender' => 'string'
                ]));
        } else {
            return response('Id no encontrada', 404);
        }
    }

    // Si la tura lleva un parametro, la funcion tambien tiene que recibirlo
    public function delete(Request $request, $id)
    {
        DB::table('students')->where('id', $id)->delete();
    }
}
