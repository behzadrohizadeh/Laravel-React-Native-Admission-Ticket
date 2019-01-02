
@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">Add Role</span>
	        <span class="page-description"></span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/user/storerole" enctype="multipart/form-data">
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
							 <p>Role Name </p>
						     <input name="name" class="form-control" >
						</div>
						
						<div class="form-group">
							 <p> Capabilities  </p>
							 <?php 

							   foreach ($roles as $key => $value) { ?>
							   	<input type="checkbox"  name="caps[]" value="<?php echo $value['controller']?>">
                                 <label><?php echo $value['name']; ?></label>
							   
							  <?php  } ?>

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