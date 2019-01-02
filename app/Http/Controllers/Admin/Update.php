<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Update extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    function updaterow(Request $request)
     {
       $database=$request->input("database");
       $id=$request->input('id');
       $where=$request->input("where");
       $getrow=$request->input("getrow");
       $getrow=explode(',', $getrow);
       //$update=$this->Query_model->select($database,$where,$id,$getrow);
    $update = DB::table($database)
                                 ->where($where, $id)
                                  ->select($getrow)
                                 ->get();

        if (!empty($update)) 
         {
          $data["crf"]=  $request->session()->token();
          $data["data"]=$update[0];
          echo json_encode($data);
        }else
        {
          $data["crf"]=  $request->session()->token();
          $data["data"]=array();;
          echo json_encode($data);

        }
     }

   function edittable(Request $request)
     {
      $database=$request->input("database");
      $id=$request->input("id");
      $where=$request->input("where");
      $getrow=$request->input("getrow");
      $data=explode('@@', $request->input("datasend"));
      unset($data[count($data)-1]);
      $updatee=array();
         for ($i=0; $i <count($data)/2 ; $i++)
          { 
             $updatee[trim($data[2*$i])]=$data[2*$i+1].'';
           }//$updatee['content']='<p>ASZDxfbn</p>';

           $up= DB::table($database)
            ->where($where, $id)
            ->update($updatee);

     
      if ($up) 
       {
          $data["crf"]=  $request->session()->token();
          $data["data"]=array("uppated"=>true);;
          echo json_encode($data);
      }else
      {
          $data["crf"]= $request->session()->token();
          $data["data"]=array("uppated"=>false);;
          echo json_encode($data);
       }
     }
     function udpdatetd(Request $request)
     {
        $database=$request->input("database");
        $filed=$request->input("filed");
        $where=explode('-',$request->input("valbefor"));
        $valnew=$request->input("valnew");

       
         $update= DB::table($database)
            ->where($where[0], $where[1])
            ->update(array($filed=>$valnew));

        //$update=$this->Query_model->Update($database,$where[0],$where[1],array($filed=>$valnew));
        if ($update) 
        {
             $data["crf"]=$request->session()->token();
             $data["data"]=$valnew;
            echo json_encode($data);
        }
        else
        {
             $data["crf"]=$request->session()->token();
             $data["data"]="no";
            echo json_encode($data);
        }
        
        exit();
     }

     function delete(Request $request)
     {
       $database=$request->input("database");
       $id=$request->input("id");
       $where=$request->input("where");
      //$delete=$this->Query_model->delete($database,$where,$id);
       $delete=DB::table($database)->where($where,$id)->delete();

        if ($delete) 
         {
           $data["crf"]=  $request->session()->token();
           $data["data"]=array("delete"=>true);;
           echo json_encode($data);
         }else
         {
          $data["crf"]=  $request->session()->token();
          $data["data"]=array("delete"=>false);;
          echo json_encode($data);
       }
     }
}
