<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admission;

use View;
class Admissions extends Controller
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
        $admissions=$this->limits(50,($id-1)*50,$q);
        $data['admissions']=$admissions;
        $data['pagnation']=$pagnation;
        $data['id']=$id;
        $data['title']="Admissions";
        return view('admission.all',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
         $data["title"]="New Admission";
         return view('admission.add',$data);
    }

    function row($q)
    {
      $count=0; 
      if (empty($q)) 
      {
       
               $count = Admission::count();
         
      }
      if (!empty($q)) 
      {
          $count = Admission::orWhere('name', 'like', '%' .$q. '%')
                              ->orWhere('mobile', 'like', '%' .$q. '%')
                              ->count();
         
       
      }
      
      return $count;
    }  

    
    function limits($number,$id,$q)
    {
      
     $admissions=[];

    if (empty($q)) 
      {
      
              $admissions = Admission::offset($id)
                ->limit($number)
                ->get();
      

        
            
           
      }
      if (!empty($q)) 
      {
       
              $admissions = 
              Admission::orWhere('name', 'like', '%' .$q. '%')
              ->orWhere('mobile', 'like', '%' .$q. '%')
              ->offset($id)
              ->limit($number)
              ->get();
       
           
           
         
         
         
       
      }
       return $admissions;
    }
    

    
    public function store(Request $request)
    {

         $admission = new Admission;
         $admission->name= $request->input("name");
         $admission->password=md5( $request->input("password"));
         $admission->mobile= $request->input("mobile");
         $admission->active_key=md5(time()*9);
         $admission->date_create=date("Y-m-d");
         if(!empty($_FILES['avatar']["name"]) ) 
          {
             $file = $request->file('avatar');
              $destinationPath = 'avatar';
              $file_name=uniqid().".".$file->getClientOriginalExtension();
              $move=$file->move($destinationPath,$file_name);
               $admission->avatar= asset($destinationPath.'/'.$file_name);
          }


         $in= $admission->save();
         $res["success"]="Admission Create Susscessfuly";
         $res["title"]="New Admission ";
        return view('admission.add',$res);
    }
   function getwhere($id)
    {
        $admission = admission::where('id_admission', $id)
                                ->get(); 
        return $admission;                          
    }
    
    public function edit($id)
    {
         $res["title"]="Admission Edit ";
         $admission=$this->getwhere($id);
        if (!empty($admission)) {

            $res["admission"]=$admission[0];
            $res["id"]=$id;
            return view('admission.edit',$res);
      }
    }

   
   
    public function update(Request $request, $id)
    {

       


         $admissiondata["name"]= $request->input("name");
         $admissiondata["mobile"]= $request->input("mobile");
         $admissiondata["date_create"]=date("Y-m-d");

           if(!empty($_FILES['avatar']["name"]) ) 
          {
             $file = $request->file('avatar');
              $destinationPath = 'avatar';
              $file_name=uniqid().".".$file->getClientOriginalExtension();
              $move=$file->move($destinationPath,$file_name);
              $admissiondata["avatar"]= asset($destinationPath.'/'.$file_name);
          }

         if (!empty($request->input("password"))) {
            $admissiondata["password"]=md5($request->input("password") ) ;
         } 
        
        
          admission::where('id_admission', $id)
            ->update($admissiondata);
       return redirect()->to('/admission/edit/'.$id);
    }

   
}
