<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gate;
use App\Area;

use View;
class Gates extends Controller
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
        $gates=$this->limits(50,($id-1)*50,$q);
        $data['gates']=$gates;
        $data['pagnation']=$pagnation;
        $data['id']=$id;
        $data['title']="Gates";
        return view('gate.all',$data);

    }

    
    public function create()
    {    
         $data["title"]="New Gate";
         $data["area"]=Area::get();
         return view('gate.add',$data);
    }

    function row($q)
    {
      $count=0; 
      if (empty($q)) 
      {
       
               $count = Gate::count();
         
      }
      if (!empty($q)) 
      {
          $count = Gate::where('name', 'like', '%' .$q. '%')
                              ->count();
         
       
      }
      
      return $count;
    }  

    
    function limits($number,$id,$q)
    {
      
     $gates=[];

    if (empty($q)) 
      {
      
               $gates = Gate::leftJoin('area',"area.id_area" , "gate.id_area")
              ->offset($id)
              ->limit($number)
              ->select("gate.id_gate","gate.name as gate_name","area.name as area_name")
              ->get();
      

        
            
           
      }
      if (!empty($q)) 
      {
       
              $gates = Gate::Where('name', 'like', '%' .$q. '%')
              ->leftJoin('area',"area.id_area" , "gate.id_area")
              ->offset($id)
              ->limit($number)
              ->select("gate.id_gate","gate.name as gate_name","area.name as area_name")
              ->get();
       
           
           
         
         
         
       
      }
       return $gates;
    }
    

    
    public function store(Request $request)
    {

         $gate = new Gate;
         $gate->name= $request->input("name");
         $gate->id_area= $request->input("id_area");
         $in= $gate->save();
         $res["success"]="Area Create Susscessfuly";
         $res["title"]="New Gate ";
         $res["area"]=Area::get();
        return view('gate.add',$res);
    }
   function getwhere($id)
    {
        $gate = Gate::where('id_gate', $id)
                                ->get(); 
        return $gate;                          
    }
    
    public function edit($id)
    {
         $res["title"]="Area Edit ";
       $gate=$this->getwhere($id);
        if (!empty($gate)) {
           $res["area"]=Area::get();
            $res["gate"]=$gate[0];
            $res["id"]=$id;
            return view('gate.edit',$res);
      }
    }

   
   
    public function update(Request $request, $id)
    {

       


         $gategata["name"]= $request->input("name");
         $gategata["id_area"]= $request->input("id_area");

        
          Gate::where('id_gate', $id)
            ->update($gategata);
       return redirect()->to('/gate/edit/'.$id);
    }

   
}
