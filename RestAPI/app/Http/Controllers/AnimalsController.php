<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animals = [
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach ($this->animals as $animal) {
            $animal . '<br>';
        }   
    }

    public function store(Request $request)
    {
        $newAnimals = ['id' => 4, 'name' => 'Musang'];
        array_push($animals, $newAnimals);

        return response()->json(['success' => true, 'message' => 'Data stored successfully']);
    }

    public function update(Request $request, $id)
{
    // Assuming you want to update the 'name' property
    // (You can modify this based on your desired update field)
    if (isset($this->animals[$id])) {
        $this->animals[$id]['Musang'] = $request->input('Kambing');
        return response()->json(['success' => true, 'message' => 'Data updated successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Animal not found'], 404);
    }
}

    public function destroy($id) {
        if (isset($this->animals[$id])) {
            $deleted[] = $this->animals[$id];
            unset($this->animals[$id]['Kambing']);
        }
    }
}