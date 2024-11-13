<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = pegawai::all();

        if($pegawai){

            $data = [ 
                'message'=> 'Data Pegawai Dapat di Akses', 
                'data'=> $pegawai,
            ];
                return response()->json($data, 201);
        } else{
            $data = [ 
                'message'=> 'Data Pegawai yang dimaksud Tidak di Temukan', 
            ];

        }

        $data = [
            'message'=>'Berhasil di Akses Data Pegawai',
            'data'=>$pegawai
        ];

        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'numeric|required',
            'email' => 'email|required',
            'jabatan' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'=>'Validation Tidak Berhasil',
                'errors'=> $validator-> errors()
            ], 422);
        }

        $validateData = $validator->validated();
        $pegawai = pegawai::create($validateData);
        $data = [ 
        'message'=> 'Data Pegawai Berhasil di Tambahkan', 
        'data'=> $pegawai,
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $pegawai = pegawai::find($id);

        if ($pegawai){
            $input = [
                'nama' => $request->nama ?? $pegawai->nama,
                'jenis_kelamin' => $request->jenis_kelamin ?? $pegawai->jenis_kelamin,
                'alamat' => $request->alamat ?? $pegawai->alamat,
                'nomor_telepon' => $request->nomor_telepon ?? $pegawai->nomor_telepon,
                'email' => $request->email ?? $pegawai->email,
                'jabatan' => $request->jabatan ?? $pegawai->jabatan,
                'status' => $request->status ?? $pegawai->status
            ];

            $pegawai -> update($input);

            $data = [ 
                'message'=> 'Data pegawai Berhasil di Update', 
                'data'=> $pegawai,
            ];
        
                return response()->json($data, 201);
        } else{
            $data = [ 
                'message'=> 'Data pegawai Tidak Ditemukan', 
            ];
        
                return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $pegawai = pegawai::find($id);

        if(!$pegawai){
            $data = [ 
                'message'=> 'Data pegawai Tidak Ditemukan', 
            ];
        
                return response()->json($data, 404);
        }else{

            $pegawai->delete();

            $data = [ 
                'message'=> 'Data pegawai Berhasil di Delete', 
                'data'=> $pegawai,
            ];
        
                return response()->json($data, 201);
        }
    }

    public function show($id) 
    {
        $pegawai = pegawai::find($id);
        if(!$pegawai){
            $data = [ 
                'message'=> 'ID Detail pegawai Tidak Ditemukan', 
            ];
        
                return response()->json($data, 404);
        }else{

            $data = [ 
                'message'=> 'Detail Pegawai Berhasil di Tampilkan', 
                'data'=> $pegawai,
            ];
        
                return response()->json($data, 201);
        }
    }
}
