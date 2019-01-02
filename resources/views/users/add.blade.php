
@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">Create New User</span>
	        <span class="page-description">Complate Form And Press Submit</span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/user/store" enctype="multipart/form-data">
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
						<div class="form-group"><br/>
							 <p>Display Name </p>
						     <input name="name" class="form-control" >
						</div>
						
						
						<div class="form-group">
							 <p>Password</p>
						     <input name="password" type="password" class="form-control"  >
						</div>
						<div class="form-group">
							 <p>Email</p>
						     <input name="email" class="form-control"  >
						</div>
						
						<div class="form-group">
							 <p>Mobile</p>
						     <input name="mobile" class="form-control"  >
						</div>

			            <div class="form-group">
							 <p> Role  </p>
							
							 	
						     <select name="id_role" class="form-control">
						     	
						     	 <?php 
							        foreach ($roles as  $value) {
							        	?>
						     	     <option value="<?php echo $value->id_role ?>"><?php echo $value->display_name ?></option>
						     	<?php } ?>
						     </select>
						</div>
						

						<div class="form-group">
							 <p> Avatar [Allow Format = > jpeg,jpg,png]  </p>
						   <input type="file" name="avatar" size="20" />

						</div>


					
						
				    <div class="col col-lg-2">
				    	<input type="submit" name="submit" value="Create" class="btn btn-success">	<br/><br/>
				    </div>
			    </div>	
			  </form>

	      
	    </div>
	</div>
</main>

@stop