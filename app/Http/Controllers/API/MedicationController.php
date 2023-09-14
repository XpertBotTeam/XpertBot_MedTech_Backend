<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medication;
use App\Http\Requests\MedicationRequest;


class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $medications = Medication::paginate($per_page);
        return response()->json($medications);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicationRequest $request)
    {
 
        $medication = Medication::create($request->all());
        return response()->json($medication, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medication = Medication::findOrFail($id);
        return response()->json($medication);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(MedicationRequest $request, string $id)
    {
        $medication = Medication::findOrFail($id);
        $medication->update($request->all());
        return response()->json($medication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medication = Medication::findOrFail($id);
        $medication->delete();
        return response()->json(null, 204);
    }
}
