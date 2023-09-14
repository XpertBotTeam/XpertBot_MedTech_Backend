<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $patients = Patient::paginate($per_page);
        return response()->json($patients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        
        $patient = Patient::create($request->all());
        return response()->json($patient,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient=Patient::findOrFail($id);
        return response()->json($patient);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, string $id)
    {
        $patient=Patient::findOrFail($id);
        $patient->update($request->all());
        return response()->json($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient=Patient::findOrFail($id);
        $patient->delete();
        return response()->json(null,204);
    }
}
