<?php


namespace App\Http\Controllers;

use App\Models\CompanyCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyCodeController extends Controller
{
 public function storeCode($code)
{
    if (empty($code)) {
        return response()->json(['message' => 'Code cannot be empty'], 400);
    }

    $existingCode = CompanyCode::where('code', $code)->first();
    if ($existingCode) {
        return response()->json(['message' => 'Code already exists'], 400);
    }

    try {
        $companyCode = CompanyCode::create([
            'code' => $code
        ]);
        return response()->json($companyCode, 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error saving code', 'error' => $e->getMessage()], 500);
    }
}

}
