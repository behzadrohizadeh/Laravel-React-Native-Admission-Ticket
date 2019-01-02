<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;

use View;
class Areas extends Controller
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
        $users=$this->limits(50,($id-1)*50,$q);
        $data['areas']=$users;
        $data['pagnation']=$pagnation;
        $data['id']=$id;
        $data['title']="Areas";
        return view('area.all',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
         $data["title"]="New Area";
         return view('area.add',$data);
    }

    function row($q)
    {
      $count=0; 
      if (empty($q)) 
      {
       
               $count = Area::count();
         
      }
      if (!empty($q)) 
      {
          $count = Area::where('email', 'like', '%' .$q. '%')
                              ->count();
         
       
      }
      
      return $count;
    }  

    
    function limits($number,$id,$q)
    {
      
     $areas=[];

    if (empty($q)) 
      {
      
              $areas = Area::offset($id)
                ->limit($number)
                ->get();
      

        
            
           
      }
      if (!empty($q)) 
      {
       
              $areas = Area::Where('name', 'like', '%' .$q. '%')
              ->offset($id)
              ->limit($number)
              ->get();
       
           
           
         
         
         
       
      }
       return $areas;
    }
    

    
    public function store(Request $request)
    {

         $area = new Area;
         $area->name= $request->input("name");
         $in= $area->save();
         $res["success"]="Area Create Susscessfuly";
         $res["title"]="New Area ";
        return view('area.add',$res);
    }
   function getwhere($id)
    {
        $area = Area::where('id_area', $id)
                                ->get(); 
        return $area;                          
    }
    
    public function edit($id)
    {
         $res["title"]="Area Edit ";
       $area=$this->getwhere($id);
        if (!empty($area)) {

            $res["area"]=$area[0];
            $res["id"]=$id;
            return view('area.edit',$res);
      }
    }

   
   
    public function update(Request $request, $id)
    {

       


         $datauser["name"]= $request->input("name");
        
        
          Area::where('id_area', $id)
            ->update($datauser);
       return redirect()->to('/area/edit/'.$id);
    }

   
}
