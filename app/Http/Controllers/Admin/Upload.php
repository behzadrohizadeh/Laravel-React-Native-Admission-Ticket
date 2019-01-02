<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Upload extends Controller
{
   
  

   
   function files(Request $request)
    
    {
      $file = $request->file('file');
      $destinationPath = 'uploads';
      $file_name=uniqid().".".$file->getClientOriginalExtension();
      //$path = $file->storeAs( $destinationPath, uniqid().".".$type);
      $move=$file->move($destinationPath,$file_name);

      $data["src"]= asset($destinationPath.'/'.$file_name);
      $data["crf"]=$request->session()->token();
       echo json_encode($data);
       exit();
    }
   
}
