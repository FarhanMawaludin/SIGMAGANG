<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringDosenController extends Controller
{
    public function index(){
        $activemenu='monitoring';
        return view('dosen.monitoring.index',[
            'activemenu'=>$activemenu
        ]);
    }
}
