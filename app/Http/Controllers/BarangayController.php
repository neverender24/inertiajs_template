<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangay;

class BarangayController extends Controller
{
    public function __construct(Barangay $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        return $this->model
                    ->with('municipal')
                    ->where('municipal_id', $request->municipal_id)
                    ->get()->map(fn($row) => [
                        'value' => $row->id,
                        'name' => $row->barangay
                    ]);
    }
}
