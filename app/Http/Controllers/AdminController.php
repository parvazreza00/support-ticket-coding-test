<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpenTicket;

class AdminController extends Controller
{
    public function adminDashboard(){
        $tickets = OpenTicket::with('user')->orderBy('id','DESC')->paginate(5);
        return view('backend.admin_dashboard',compact('tickets'));
    }
}
