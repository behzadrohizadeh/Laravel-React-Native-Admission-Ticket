@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">User Edit</span>
	        <span class="page-description"></span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/user/update/<?php echo $id;?>" enctype="multipart/form-data">
				 @if (count($errors) > 0)
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <b>{{ $error }}</b><br/>
                            @endforeach
                       
                    </div>
                @endif
               {{ csrf_field() }} 
			
				   <div class="col col-lg-12">
				   <?php if (isset($success)) { ?>
			       <div class="row">
			            <div class="alert alert-success">
			                  <b style="color:green; margin-right:10px;" ><?php echo ($success); ?></b>
			            </div>
			        </div>
			        <?php } ?>
						<div class="form-group"><br>
							 <p>Display Name </p>
						     <input name="name" value="<?php echo $user->name;?>" class="form-control" >
						</div>
						
						
						<div class="form-group">
							 <p>Password</p>
						     <input name="password"   type="password" class="form-control"  >
						</div>
						<div class="form-group">
							 <p>Email</p>
						     <input name="email" value="<?php echo $user->email;?>" class="form-control"  >
						</div>
						
						<div class="form-group">
							 <p>Mobile</p>
						     <input name="mobile" value="<?php echo $user->mobile;?>" class="form-control"  >
						</div>

			           <div class="form-group">
							 <p> Role  </p>
							
							 	
						     <select name="id_role" class="form-control">
						     	
						     	 <?php 
							        foreach ($roles as  $value) {
							        	 $selected="";
			                              if ($user->id_role==$value->id_role) {
			                                $selected="selected";
			                              }
							        	?>
						     	     <option <?php echo $selected; ?> value="<?php echo $value->id_role ?>"><?php echo $value->display_name ?></option>
						     	<?php } ?>
						     </select>
						</div>
						


					
						
						<div class="form-group">
						    <div class="col-lg-6">
							 <p> Avatar [Allow Format = > jpeg,jpg,png]  </p>
						       <input type="file" name="avatar" size="20" />
						    </div>
						    <div class="col-lg-6">
							     <?php 
							      if(!empty($user->avatar)){ ?>
							        <img width="100" src="<?php echo $user->avatar;?>">
							     <?php }?>
			                </div>
						   </div>

					
						
				    <div class="col col-lg-2">
				    	<input type="submit" name="submit" value="Update" class="btn btn-success">	<br/>
				    	<br/>
				    </div>
			    </div>	
			  </form>


	    </div>
	</div>
</main>
@stop