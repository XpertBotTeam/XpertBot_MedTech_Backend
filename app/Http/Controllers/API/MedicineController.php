<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineRequest;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $medicines = Medicine::paginate($per_page);
        return response()->json($medicines);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicineRequest $request)
    {
        $medicine = medicine::create($request->all());
        return response()->json($medicine, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        return response()->json($medicine);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MedicineRequest $request, string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());
        return response()->json($medicine);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return response()->json(null, 204);
    }
}
