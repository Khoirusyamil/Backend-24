<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentsController extends Controller
{
    public function index()
    {
        $student = Student::all();
        $data = [
            'message'=>'Berhasil akses data',
            'data'=>$student
        ];

        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];
        $student = Student::create($input);
        $data = [ 
        'message'=> 'Data Student Berhasil di Input', 
        'data'=> $student,
    ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student){
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ];

            $student -> update($input);

            $data = [ 
                'message'=> 'Data Student Berhasil di Update', 
                'data'=> $student,
            ];
        
                return response()->json($data, 201);
        } else{
            $data = [ 
                'message'=> 'Data Student Tidak Ditemukan', 
            ];
        
                return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if(!$student){
            $data = [ 
                'message'=> 'Data Student Tidak Ditemukan', 
            ];
        
                return response()->json($data, 404);
        }else{
            $student->delete();

            $data = [ 
                'message'=> 'Data Student Berhasil di Delete', 
                'data'=> $student,
            ];
        
                return response()->json($data, 201);
        }

        


    }
}