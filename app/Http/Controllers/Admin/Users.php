<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Roles;
use App\User;

use View;
class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request,$where=-1,$id=1)
    {
       

      
        $id=intval($id);
        if ($id <= 0 ) 
        {
            $id=1;
        }
        $q= $request->input("q");
        $pagnation=$this->row($where,$q);
        $data['count_all']=$pagnation;
        $pagnation=ceil($pagnation/50);
        $users=$this->limits(50,($id-1)*50,$where,$q);
        $data['users']=$users;
        $data['roles']=Roles::get(); 
        $data['pagnation']=$pagnation;
        $data['id']=$id;
        $data['wheres']=$where;
        $data['title']="کاربران  ";
        return view('users.all',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
         $data['roles']=Roles::get(); 
         $data["title"]="New User";
         return view('users.add',$data);
    }

    function row($where,$q)
    {
      $count=0; 
      if (empty($q)) 
      {
       if ($where==-1) 
            {
               $count = User::count();
            }

        if ($where!=-1) 
           {
              $count = User::where('id_role',"=", $where)
                              ->count();

            }
            
           
      }
      if (!empty($q)) 
      {
         if ($where==-1) 
            {
              $count = User::orWhere('name', 'like', '%' .$q. '%')
              ->orWhere('email', 'like', '%' .$q. '%')
              ->orWhere('mobile', 'like', '%' .$q. '%')
              ->count();
            }
           
           
          if ($where!=-1) 
            {
              $count = User::orWhere('name', 'like', '%' .$q. '%')
              ->orWhere('email', 'like', '%' .$q. '%')
              ->orWhere('mobile', 'like', '%' .$q. '%')
              ->where('id_role',"=", $where)
              ->count();
            }
         
         
       
      }
      
      return $count;
    }  

    function whererow($where,$eq)
    {
     $users = User::where($where, $eq)
     ->count();
      

    }

    function limits($number,$id,$where,$q)
    {
      
     $users=[];

    if (empty($q)) 
      {
       if ($where==-1) 
            {
              $users = User::offset($id)
                ->limit($number)
                ->get();
            }

        if ($where!=-1) 
           {
              $users = User::where('id_role',"=", $where)
                              ->offset($id)
                              ->limit($number)
                              ->get();

            }
            
           
      }
      if (!empty($q)) 
      {
         if ($where==-1) 
            {
              $users = User::orWhere('name', 'like', '%' .$q. '%')
              ->orWhere('email', 'like', '%' .$q. '%')
              ->orWhere('mobile', 'like', '%' .$q. '%')
              ->offset($id)
              ->limit($number)
              ->get();
            }
           
           
          if ($where!=-1) 
            {
              $users = User::orWhere('name', 'like', '%' .$q. '%')
              ->orWhere('email', 'like', '%' .$q. '%')
              ->orWhere('mobile', 'like', '%' .$q. '%')
              ->where('id_role',"=", $where)
              ->offset($id)
              ->limit($number)
              ->get();
            }
         
         
       
      }
       return $users;
    }
    function limitswhere($where,$eq,$number,$id)
    {
      $users = User::where($where, $eq)
                ->offset($id)
                ->limit($number)
                ->get();  

    return $users;  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $user = new User;

         $messages =  [
        'name.required' => 'Name Is Empty',
        'email.required' => 'Email Is Empty',
        'email.unique' => 'This Email Already Exists',
        'email.email' => 'Email Not Valid',
        'mobile.required' => 'Mobile Is Empty',
        'mobile.unique' => 'This Mobile Already Exists',
        'password.required'  =>  'Password Is Empty',
        'password.min'  => 'Min Password Is 5 Digit',
       ];
         $valid=  $this->validate($request, [
                'name' => 'required|unique:users',
                'email' =>    'required|unique:users|email',
                'mobile' =>   'required|unique:users',
                'password' => 'required|min:5',
            ],$messages);


         $user->name= $request->input("name");
         $user->password= md5($request->input("password") ) ;
         $user->email= $request->input("email");
         $user->mobile= $request->input("mobile");
         $user->id_role= $request->input("id_role");
         $user->active= 1;
         $user->active_key= md5(time()*7);
         $user->date_create=date("Y-m-d");
         if(!empty($_FILES['avatar']["name"]) ) 
          {
             $file = $request->file('avatar');
              $destinationPath = 'avatar';
              $file_name=uniqid().".".$file->getClientOriginalExtension();
              $move=$file->move($destinationPath,$file_name);
               $user->avatar= asset($destinationPath.'/'.$file_name);
          }

         $in= $user->save();
         $res["success"]="User Create Susscessfuly";
         $res["title"]="New User ";
         $res['roles']=Roles::get(); 
        return view('users.add',$res);
    }
   function getwhere($id)
    {
        $users = User::where('id', $id)
                                ->get(); 
        return $users;                          
    }
    
    public function edit($id)
    {
         $res["title"]="User Edit ";
       $res['roles']=Roles::get(); 
       $user=$this->getwhere($id);
        if (!empty($user)) {

            $res["user"]=$user[0];
            $res["id"]=$id;
            return view('users.edit',$res);
      }
    }

   
   
    public function update(Request $request, $id)
    {

       


         $datauser["name"]= $request->input("name");
         $datauser["email"]= $request->input("email");
         $datauser["mobile"]= $request->input("mobile");
         $datauser["id_role"]= $request->input("id_role");
         $datauser["active"]= 1;
        // $datauser["active_key"]= md5(time()*7);
         $datauser["date_create"]=date("Y-m-d");
         if(!empty($_FILES['avatar']["name"]) ) 
          {
             $file = $request->file('avatar');
              $destinationPath = 'avatar';
              $file_name=uniqid().".".$file->getClientOriginalExtension();
              $move=$file->move($destinationPath,$file_name);
              $datauser["avatar"]= asset($destinationPath.'/'.$file_name);
          }

         if (!empty($request->input("password"))) {
            $datauser["password"]=md5($request->input("password") ) ;
         }         
        
          User::where('id', $id)
            ->update($datauser);
       return redirect()->to('/user/showuser/'.$id);
    }

    function roles()
    {
      $roles= config('constants.caps');
      $res["allroles"]=$roles;
      $res['title']="ALL Roles ";
      $roles= Roles::get();
      $res["roles"]=$roles;
      return view('users.roles',$res); 
    }

    function addrole()
    {
      $res['title']="New Role";
      $roles= config('constants.caps');
      $res["roles"]=$roles;
      return view('users.addrole',$res); 
    }

     public function storerole(Request $request)
    {
        $role = new Roles ; 
         $role->display_name= $request->input("name");
         $role->caps=(!empty($request->input("caps"))) ? implode(',', $request->input("caps")) : "" ;
       
        $role->save(); 
         $res["success"]="Role Create Susscessfuly";
         $res['title']="New Role";
         $roles= config('constants.caps');
         $res["roles"]=$roles;
         return view('users.addrole',$res); 
    }

    function roleedit($id)
    {
      $res['title']="Edit Role";;
      $roles= config('constants.caps');
      $res["roles"]=$roles;
      $role=Roles::where('id_role',$id)->get(); 
      if (!empty($role)) {
      $res["role"]=$role[0];
      $res['id']=$id;
        return view('users.roleedit',$res); 

      }
    }

    public function updaterole(Request $request,$id)
    {
        
         $datarole["display_name"]= $request->input("name");
         $datarole["caps"]=(!empty($request->input("caps"))) ? implode(',', $request->input("caps")) : "" ;
       
          Roles::where('id_role', $id)
            ->update($datarole);
       return redirect()->to('/user/roleedit/'.$id);
    }

}
