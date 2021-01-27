<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() {
        $users = DB::select('select * from basicrefbook where active = ?', [1]);
        print_r($users);
    }
}
