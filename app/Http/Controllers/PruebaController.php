<?php

namespace App\Http\Controllers;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    //
    public function getAll()
    {
        return Empresa::all();
    }
}
