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

			<form method="POST" class='login-form' action="/gate/update/<?php echo $id;?>" enctype="multipart/form-data">
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
							 <p> Gate Name </p>
						     <input name="name" value="<?php echo $gate->name;?>" class="form-control" >
						</div>

						<div class="form-group">
							 <p>Area  </p>
							
							 	
						     <select name="id_area" class="form-control">
						     	
						     	 <?php 
							        foreach ($area as  $value) {
							        	 $selected="";
			                              if ($gate->id_area==$value->id_area) {
			                                $selected="selected";
			                              }
							        	?>
						     	     <option <?php echo $selected; ?> value="<?php echo $value->id_area ?>"><?php echo $value->name ?></option>
						     	<?php } ?>
						     </select>
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