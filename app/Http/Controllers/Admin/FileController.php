<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Departamento;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
   
    public function store(Request $request)
    {
       return response('Hello World', 200);
    }
}
