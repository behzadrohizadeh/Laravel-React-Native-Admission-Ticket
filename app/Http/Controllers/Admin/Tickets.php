<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ticket;
use Rap2hpoutre\FastExcel\FastExcel;
use App\History;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

use View;
class Tickets extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request,$id=1)
    {
       

      
        $id=intval($id);
        if ($id <= 0 ) 
        {
            $id=1;
        }
        $q= $request->input("q");
        $pagnation=$this->row($q);
        $data['count_all']=$pagnation;
        $pagnation=ceil($pagnation/50);
        $tickets=$this->limits(50,($id-1)*50,$q);
        $data['tickets']=$tickets;
        $data['pagnation']=$pagnation;
        $data['id']=$id;
        $data['title']="tickets";
        return view('ticket.all',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    



         $data["title"]="New Ticket";
         return view('ticket.add',$data);
    }

    function row($q)
    {
      $count=0; 
      if (empty($q)) 
      {
       
               $count = Ticket::count();
         
      }
      if (!empty($q)) 
      {
          $count = Ticket::orWhere('ticket_name', 'like', '%' .$q. '%')
                          ->orWhere('ticket_code', 'like', '%' .$q. '%')
                          ->orWhere('valid_from', 'like', '%' .$q. '%')
                          ->orWhere('valid_to', 'like', '%' .$q. '%')
                          ->orWhere('ticket_type', 'like', '%' .$q. '%')
                          ->count();
         
       
      }
      
      return $count;
    }  

    
    function limits($number,$id,$q)
    {
      
     $tickets=[];

    if (empty($q)) 
      {
      
              $tickets = Ticket::offset($id)
                ->limit($number)
                ->get();
      

        
            
           
      }
      if (!empty($q)) 
      {
       
              $tickets = Ticket::orWhere('ticket_name', 'like', '%' .$q. '%')
                          ->orWhere('ticket_code', 'like', '%' .$q. '%')
                          ->orWhere('valid_from', 'like', '%' .$q. '%')
                          ->orWhere('valid_to', 'like', '%' .$q. '%')
                          ->orWhere('ticket_type', 'like', '%' .$q. '%')
                          ->offset($id)
                          ->limit($number)
                          ->get();
       
           
           
         
         
         
       
      }
       return $tickets;
    }
    

    
    public function store(Request $request)
    {

         $ticket = new Ticket;
         $e=0;
         $error="";
         $ticket->ticket_name= $request->input("ticket_name");
         $ticket_type= $request->input("ticket_type");
         $ticket_code= $request->input("ticket_code");
         $limit= $request->input("limit");

         $valid_from= $request->input("valid_from");
         $valid_to= $request->input("valid_to");

         $svalid_from= intval(str_replace("-", "", $valid_from));
         $svalid_to= intval(str_replace("-", "", $valid_to));


         if ( ($svalid_from > $svalid_to) || $svalid_from==0 || $svalid_to==0) {
           $e=1;
           $error="Valid To must be longer than Valid From";
         }

         if (empty( $ticket_code)) {
           $e=1;
           $error="Ticket Code Is Empty";
         }

        


         

          switch ( $ticket_type) {
            case 'limit':

              if (intval( $limit) <= 0 ) {
               $e=1;
               $error="limit must be longer than 0";
             }
                

              break;

              case 'unLimit':
              # code...
              break;
            
            
          }

          if ($e==0) {


          $EXIST=Ticket::Where('ticket_code',$ticket_code)
                          ->count();
          if ($EXIST > 0 ) 
          {
            $res["error"]="Ticket Code [".$ticket_code."] Exists.";
           $res["title"]="New ticket ";
           return view('ticket.add',$res);
          }



           $ticket->ticket_code= $ticket_code;
           $ticket->valid_from= $valid_from;
           $ticket->valid_to=$valid_to;
           $ticket->ticket_type= $ticket_type;
           $ticket->limit= $limit;
           $ticket->date_create=date("Y-m-d");
           $ticket->times_used= 0 ; 
           $ticket->active= 1 ; 
           $in= $ticket->save();


            $qrcode = new BaconQrCodeGenerator;
            $qrcodes=$ticket_code;
            $qrcode->format('png')->size(200)->generate($qrcodes, './qrcodes/'.$qrcodes.'.png');


          
           $res["success"]="Ticket Create Susscessfuly";
           $res["title"]="New ticket ";
           return view('ticket.add',$res);
          }

          if ($e==1) {
           
           $res["error"]=$error;
           $res["title"]="New ticket ";
           return view('ticket.add',$res);
          }


         
    }
   function getwhere($id)
    {
        $ticket = Ticket::where('id_ticket', $id)
                                ->get(); 
        return $ticket;                          
    }
    
    public function edit($id)
    {
         $res["title"]="Ticket Edit ";
         $ticket=$this->getwhere($id);
        if (!empty($ticket)) {

            $res["ticket"]=$ticket[0];
            $res["id"]=$id;
            return view('ticket.edit',$res);
      }
    }

   
   
    public function update(Request $request, $id)
    {

       


       
         $e=0;
         $error="";
         $ticket_name= $request->input("ticket_name");
         $ticket_type= $request->input("ticket_type");
         $limit= $request->input("limit");

         $valid_from= $request->input("valid_from");
         $valid_to= $request->input("valid_to");

         $svalid_from= intval(str_replace("-", "", $valid_from));
         $svalid_to= intval(str_replace("-", "", $valid_to));


         if ( ($svalid_from > $svalid_to) || $svalid_from==0 || $svalid_to==0) {
           $e=1;
           $error="Valid To must be longer than Valid From";
         }

        
        


         

          switch ( $ticket_type) {
            case 'limit':

              if (intval( $limit) <= 0 ) {
               $e=1;
               $error="limit must be longer than 0";
             }
                

              break;

              case 'unLimit':
              # code...
              break;
            
            
          }

          if ($e==0) {
           $ticketdata["valid_from"]= $valid_from;
           $ticketdata["valid_to"]=$valid_to;
           $ticketdata["ticket_type"]= $ticket_type;
           $ticketdata["limit"]= $limit;
           $ticketdata["date_create"]=date("Y-m-d");


           Ticket::where('id_ticket', $id)
            ->update($ticketdata);
            return redirect()->to('/ticket/edit/'.$id);
    
          }

          if ($e==1) {
           
          return redirect()->to('/ticket/edit/'.$id);

          }
        
        
       }  

       function moreinfo($id=0) 
       {
         $ticket=$this->getwhere($id);
         $data["ticket"]= $ticket;
         $data["history"]= History::
          leftJoin("admission","admission_history.id_admission","admission.id_admission")
         ->where("admission_history.id_ticket",$id)
         ->select("admission.name","admission_history.date_create","admission_history.type")
         ->get();

         $data["title"]="More Info Ticket";
         return view('ticket.moreinfo',$data);
       }


       function import()
       {
        $data["title"]="Import Tickets";
         return view('ticket.import',$data);
       } 

       function importer(Request $request)
       {
        $file = $request->file('xlsxfile');
        $destinationPath = 'xlsx';
        $file_name=uniqid().".".$file->getClientOriginalExtension();
        $move=$file->move($destinationPath,$file_name);
        $filePath= $destinationPath.'/'.$file_name;
        $filePath = public_path($filePath);
        $filePath = str_replace("allapps/public/", "",  $filePath) ;
        $error=""; 
        $s= 0 ;
        $row= 1; 
        
        $ticket = new Ticket;
        $collection = (new FastExcel)->import($filePath);
        foreach ( $collection as $key => $value) {
        $e=0;
        $key = array_keys($value);
        $ticket->ticket_name=trim( $value[$key[0] ]) ; 
        $ticket->ticket_code=trim( $value[$key[1] ]) ;
        $ticket->ticket_type=trim( $value[$key[4] ]) ; 

         $valid_from= (is_object($value[$key[2] ])) ? (array) $value[$key[2] ] : $value[$key[2] ] ; 
         $valid_to= (is_object($value[$key[2] ])) ? (array) $value[$key[3] ] : $value[$key[3] ] ;  

          $valid_from=(is_array($valid_from)) ? strtotime( $valid_from["date"]): strtotime($valid_from);
          $valid_to=(is_array($valid_to)) ? strtotime( $valid_to["date"]): strtotime($valid_to);
          $ticket->date_create=date("Y-m-d"); 
          $ticket->times_used= 0; 
          $ticket->limit= intval( $value[$key[5] ]) ;
          $ticket->valid_from=date("Y-m-d",$valid_from);
          $ticket->valid_to= date("Y-m-d",$valid_to);


           if ( ($valid_from > $valid_to) || $valid_from==0 || $valid_to==0) {
           $e=1;
           $error.="Row=". $row.":Valid To must be longer than Valid From <br/>";
         }

         if (empty( $ticket->ticket_code)) {
           $e=1;
           $error.="Row=". $row.":Ticket Code Is Empty<br/>";
         }

        
          switch ($ticket->ticket_type) {
            case 'limit':

              if (intval($ticket->limit) <= 0 ) {
               $e=1;
               $error="Row=". $row.":limit must be longer than 0 <br/>";
             }
                

              break;

              case 'unlimit':
              # code...
              break;

              default:

              $e=1;
              $error="Row=". $row.":Ticket Type  must be unlimit or limit <br/>";

              break ; 
            
            
          }

          
       

       $isin = Ticket::where('ticket_code', $ticket->ticket_code)->count();
        if ( $isin==1) {
          $e=1; 
          $error.="Row=". $row.":Ticket Code [".$ticket->ticket_code."] Exists.<br/>";

        }elseif ($e==0 && $isin==0) 
        {

          $qrcode = new BaconQrCodeGenerator;
            $qrcodes=$ticket->ticket_code;
            $qrcode->format('png')->size(200)->generate($qrcodes, './qrcodes/'.$qrcodes.'.png');

            
          $s++;
          $ticket->save(); 

        }

        $row++;
       
       }
        $data["success"]=$s." Ticket Added Susscessfuly";
        $data["title"]="Import Tickets";
        $data["error"]=$error;
        return view('ticket.import',$data);
     }

   
}
