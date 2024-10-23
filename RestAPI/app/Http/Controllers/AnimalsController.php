<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnimalsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $animals = [
            [
                "id" => 1,
                "name" => "Kucing"
            ],
            [
                "id" => 2,
                "name" => "Ayam"
            ],
            [
                "id" => 3,
                "name" => "Ikan"
            ],
        ];

        $response = [];
        foreach ($animals as $animal) {
            $response[] = [
                'id' => $animal['id'],
                'name' => $animal['name'],
            ];
        }
        return response()->json($response);
    }

    public function store(Request $request): JsonResponse
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Buat ID baru berdasarkan jumlah hewan yang ada
    // Menggunakan ID maksimum dari array untuk menghindari duplikasi
    $newId = count($this->animals) > 0 ? max(array_column($this->animals, 'id')) + 1 : 1;

    // Buat array hewan baru
    $newAnimal = [
        'id' => $newId,
        'name' => $validatedData['name'],
    ];

    // Tambahkan hewan baru ke array menggunakan array_push
    array_push($this->animals, $newAnimal);

    // Kembalikan respons JSON dengan data hewan yang baru dibuat
    return response()->json([
        'message' => 'Animal created successfully',
        'animal' => $newAnimal,
    ], 201);
}

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'Kambing' => 'required|string|max:255',
        ]);

        // Find the animal by ID
        $animal = Animal::find($id);

        // Check if the animal exists
        if ($animal) {
            // Update the 'Musang' property with the new value
            $animal->Musang = $request->input('Kambing');
            
            // Save the updated animal back to the database
            $animal->save();

            return response()->json(['success' => true, 'message' => 'Data updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Animal not found'], 404);
        }
    }

    public function destroy($id)
    {
        // Ambil referensi ke array hewan
        $animals = $this->animals;

        // Periksa apakah data hewan ditemukan
        if (isset($animals[$id])) {
            // Hapus data hewan dari array
            unset($animals[$id]);

            // Simpan perubahan array
            $this->animals = $animals;

            return response()->json(['success' => true, 'message' => 'Data hewan berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data hewan tidak ditemukan'], 404);
        }
}
}
