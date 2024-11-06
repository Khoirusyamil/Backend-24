<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function index()
    {
        $student = Student::all();

        if($student){

            $data = [ 
                'message'=> 'Data Student Berhasil di Akses', 
                'data'=> $student,
            ];
                return response()->json($data, 201);
        } else{
            $data = [ 
                'message'=> 'Data Empty', 
            ];

        }

        $data = [
            'message'=>'Berhasil akses data',
            'data'=>$student
        ];

        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'=>'Validation Errors',
                'errors'=> $validator-> errors()
            ], 422);
        }

        $validateData = $validator->validated();
        $student = Student::create($validateData);
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

    public function show($id) 
    {
        $student = Student::find($id);
        if(!$student){
            $data = [ 
                'message'=> 'ID Detail Student Tidak Ditemukan', 
            ];
        
                return response()->json($data, 404);
        }else{

            $data = [ 
                'message'=> 'Detail Student Berhasil di Tampilkan', 
                'data'=> $student,
            ];
        
                return response()->json($data, 201);
        }
    }
}