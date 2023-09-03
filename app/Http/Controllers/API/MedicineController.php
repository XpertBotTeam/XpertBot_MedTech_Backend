<?php
namespace App\Http\Controllers\Api;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class MedicineController extends Controller
{

    public function addMedicine(Request $request)
    {

        $medicine = Medicine::where('name', $request->name)->first();
        if (is_null($medicine)) {

            $medicine = new Medicine();
            $medicine->name = $request->name;
            $medicine->description = $request->description;

            $medicine->save();

            return response()->json([
                'status' => true,
                'message' => 'Medicine added successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Medicine already existed',
            ]);
        }
    }



    public function deleteMedicine($id)
    {

        $medicine = Medicine::find($id);
        if (!$medicine) {
            return response()->json('medicine not found');
        }

        $medicine->delete();
        return response()->json('medicine deleted successfully');
    }



    public function editMedicine(Request $request, $id)
    {
        $medicine = Medicine::find($id);
        if (!$medicine) {
            return response()->json([
                'status' => false,
                'message' => 'medicine not found'
            ]);
        } else {
            $medicine->name = $request->name;
            $medicine->description = $request->description;
            $medicine->save();

            return response()->json([
                'status' => true,
                'message' => 'edit medicine completed'
            ]);
        }
    }

    public function getMedicine($id)
    {

        $medicine = Medicine::find($id);
        if (!$medicine) {
            return response()->json('medicine not found');
        } else {
            return response()->json([
                $medicine
            ]);
        }
    }
}
