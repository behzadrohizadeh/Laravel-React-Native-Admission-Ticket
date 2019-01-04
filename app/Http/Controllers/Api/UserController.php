<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admission;
use App\Ticket;
use App\History;
class UserController extends Controller

 {
 function login(Request $request)
  {
  
  $mobile = $request->input("mobile");
  $password= $request->input("password");
  if (empty($mobile))
   {
   $res["error"] = "Mobile is empty";
   $res["status"] = 201;
   return response()->json($res);
   }

  if (strlen($mobile) != 11)
   {
   $res["error"] = "Mobile Must Be  11 Digit ";
   $res["status"] = 201;
   return response()->json($res);
   }

   if (empty($password))
   {
   $res["error"] = "Password is empty";
   $res["status"] = 201;
   return response()->json($res);
   }

  $user =Admission::where('mobile', $mobile)
                    ->where('password', md5($password))
                    ->get(); 
  if (count($user) >= 1)
   {
   $res["token"] = $user[0]->active_key;
   $res["status"] = 200;
   return response()->json($res);
   }

  
  //
  $res["token"] ="User Not Exists";
  $res["status"] = 201;
  return response()->json($res);
  }


  function checkticket(Request $request)
  {

    $admission_code = $request->input("admission");
    $ticket_code= $request->input("ticket");
    $in_or_out= $request->input("type");

    if (empty($admission_code))
   {
     $res["error"] = "Admission Not Send";
     $res["status"] = 201;
     return response()->json($res);
   }

   $admission =Admission::where('active_key', $admission_code)
                          ->where('active', 1)
                          ->get(); 
  if (count($admission) ==0)
   {
   $res["error"] = "Admission Not Found Login Again";
   $res["status"] = 201;
   return response()->json($res);
   }
   $admission = $admission [0];

   if (empty($ticket_code))
   {
     $res["error"] = "Ticket Code is Empty";
     $res["status"] = 201;
     return response()->json($res);
   }
    $ticket =Ticket::where('ticket_code', $ticket_code)
                      ->where('active', 1)
                      ->get();

    if(count($ticket )==0) 
    {
      
       $res["error"] = "Ticket Not Found";
       $res["status"] = 201;
       return response()->json($res);

    }
     $ticket = $ticket[0];
    if (strtotime($ticket->valid_to) < strtotime(date("Y-m-d"))) {
       $res["error"] = "Ticket Expired";
       $res["status"] = 201;
       return response()->json($res);
    }

     if ($ticket->ticket_type=="limit" && ($ticket->limit <= $ticket->times_used) ) {
       $res["error"] = "Ticket Richs To It,s Maximum Usage";
       $res["status"] = 201;
       return response()->json($res);
    }

    if ($ticket->state==$in_or_out ) {
       $res["error"] = "Ticket It is Currently [".$in_or_out."] ";
       $res["status"] = 201;
       return response()->json($res);
    }


      $History= new History();
      $History->type=$in_or_out ; 
      $History->date_create= date("Y-m-d H:i:s");
      $History->id_admission=$admission->id_admission;
      $History->id_ticket= $ticket->id_ticket; 
      $History->save(); 

      $ticket_data["state"]= $in_or_out;
      $ticket_data["date_update"]= date("Y-m-d");;
     if ($in_or_out=="inside") {
      $ticket_data["times_used"]= intval($ticket->times_used)+1;
     }
      Ticket::where('id_ticket', $ticket->id_ticket)
          ->update($ticket_data);




     $res["success"] = "Ticket Is Valid";
     $res["status"] = 200;
     return response()->json($res);

  }

  function currentstate(Request $request)
  {

    $date= date("Y-m-d");
    $res["outside"] = Ticket::where('date_update', $date)->where("state","outside")->count();
    $res["inside"] = Ticket::where('date_update', $date)->where("state","inside")->count();
    $res["status"] = 200;
    return response()->json($res);
  }
}

 

