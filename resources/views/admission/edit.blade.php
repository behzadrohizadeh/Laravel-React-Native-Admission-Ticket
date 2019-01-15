@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">Area Edit</span>
	        <span class="page-description"></span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/admission/update/<?php echo $id;?>" enctype="multipart/form-data">
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
							 <p> Name </p>
						     <input name="name" value="<?php echo $admission->name;?>" class="form-control" >
						</div>



						<div class="form-group"><br/>
							 <p> Password </p>
						     <input name="password" class="form-control" >
						</div>

						<div class="form-group"><br/>
							 <p> Mobile </p>
						     <input name="mobile" class="form-control" value="<?php echo $admission->mobile;?>" >
						</div>

						
						<div class="form-group">
						    <div class="col-lg-6">
							 <p> Avatar [Allow Format = > jpeg,jpg,png]  </p>
						       <input type="file" name="avatar" size="20" />
						    </div>
						    <div class="col-lg-6">
							     <?php 
							      if(!empty($admission->avatar)){ ?>
							        <img width="100" src="<?php echo $admission->avatar;?>">
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