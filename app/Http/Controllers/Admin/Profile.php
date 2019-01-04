<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;
use App\Ticket;

/**
 * 
 */
class Profile extends Controller {

    
  

    public function index()
    {
        $data['title']="پیشخوان ";
        $date= date("Y-m-d");
        $data["outside"] = Ticket::where('date_update', $date)->where("state","outside")->count();
        $data["inside"] = Ticket::where('date_update', $date)->where("state","inside")->count();
    return view('dashboard.dashboard', $data);
    }

    
}
