<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenTicket;
use App\Models\ResponseTicket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\OpenTicketMail;
use App\Mail\ClosedTicketMail;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function openTicket(){
        $tickets = OpenTicket::where('user_id',auth()->id())->paginate(3);
        return view('customer.open_ticket', compact('tickets'));
    }
    //create ticket start
    public function createTicket(Request $request){

        $admin = User::where('role','admin')->first();
        // dd($admin->email);
        $admin_mail = $admin->email;

        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ],[
            'subject.required' => 'Ticket subject is Required',
            'message.required' => 'Ticket Issue is Required',
        ]);

        $ticketData = OpenTicket::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'ticket_number' => mt_rand(10000, 99999),
            'created_at' => now(),
        ]);

        if($ticketData){
            Mail::to($admin_mail)->send(new OpenTicketMail($ticketData));
        }

        return redirect()->route('open.ticket')->with('success',"Ticket Submitted Successfully");        
    }
    //create ticket end

    public function ticketAdminResponse($id){
        $admin_responses = ResponseTicket::with('ticket','admin')->where('ticket_id',$id)->orderBy('id',"ASC")->get();

        return view('customer.ticket_admin_response', compact('admin_responses'));
    }

    public function ticketResponse($id){
        $response = OpenTicket::findOrFail($id);
        return view('backend.ticket_response', compact('response'));
    }

    public function ticketResponseStore(Request $request){
        $request->validate([
            'response_msg' => 'required',
        ],[
            'response_msg.required' => 'Ticket Response is Required',
        ]);

        ResponseTicket::insert([
            'ticket_id' => $request->ticket_id,
            'admin_id' =>  Auth::user()->id,
            'ticket_number' => $request->ticket_number,
            'response_msg' => $request->response_msg,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success',"Ticket Response Submitted Successfully");

    }

    public function ticketAllResponse($id){
        $all_responses = ResponseTicket::with('ticket','admin')->where('ticket_id',$id)->orderBy('id',"ASC")->get();
        
        return view('backend.ticket_all_response', compact('all_responses'));
    }

    public function ticketClose($id){
        $admin = User::where('id', auth()->user()->id)->first();

        $ticket_close = OpenTicket::with('user')->findOrFail($id);
        $customer_email = $ticket_close->user->email;
        
        $ticket_close->update([
            'status' => 'closed',
            'updated_at' => now(),
        ]);

        Mail::to($customer_email)->send(new ClosedTicketMail($ticket_close, $admin));

        return redirect()->back()->with('success',"Ticket Closed Successfully");
    }
}
