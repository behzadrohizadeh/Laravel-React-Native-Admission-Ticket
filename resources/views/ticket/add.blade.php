
@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">Create New Ticket</span>
	        <span class="page-description">Complate Form And Press Submit</span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/ticket/store" enctype="multipart/form-data">
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

			         <?php if (isset($error)) { ?>
			       <div class="row">
			            <div class="alert alert-danger">
			                  <b style="color:green; margin-right:10px;" ><?php echo ($error); ?></b>
			            </div>
			        </div>
			        <?php } ?>


						<div class="form-group"><br/>
							 <p> Ticket Name </p>
						     <input name="ticket_name" class="form-control" >
						</div>

						<div class="form-group"><br/>
							 <p> Ticket Code </p>
						     <input name="ticket_code"  class="form-control" >
						</div>

						<div class="form-group"><br/>
							 <p> Valid From </p>
						     <input name="valid_from" type="date" class="form-control" >
						</div>

						<div class="form-group"><br/>
							 <p> Valid To </p>
						     <input name="valid_to"  type="date" class="form-control" >
						</div>

						<div class="form-group"><br/>
							 <p> Ticket Type </p>

							 <select name="ticket_type" class="form-control">
						     	<option value="limit">Limit</option>
						     	<option value="unlimit">Unlimit</option>
						     </select>
						     
						</div>

						<div class="form-group" id="limit"><br/>
							 <p> Limit </p>
						     <input name="limit" value="1"  type="number" min="1" class="form-control min_limit" >
						</div>
						
						
						


					
						
				    <div class="col col-lg-2">
				    	<input type="submit" name="submit" value="Create" class="btn btn-success">	<br/><br/>
				    </div>
			    </div>	
			  </form>

	      
	    </div>
	</div>
</main>

<script type="text/javascript">
jQuery(document).ready( function($) {

	$('body').on('change','select',function(){

		val = $(this).val(); 
		if (val=="unlimit") 
		{
          $("#limit").hide(); 
		}else

		{
           $("#limit").show(); 
		}

	});

	
});	
</script>

@stop