<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipal;

class MunicipalController extends Controller
{
    public function __construct(Municipal $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->get()->map(fn($row) => [
            'value' => $row->id,
            'name' => $row->municipal
        ]);
        
        
    }
}
