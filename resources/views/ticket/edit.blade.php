@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">Ticket Edit</span>
	        <span class="page-description"></span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/ticket/update/<?php echo $id;?>" enctype="multipart/form-data">
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
						     <input name="ticket_name" class="form-control" value="<?php echo $ticket->ticket_name ?>" >
						</div>

						<div class="form-group"><br/>
							 <p> Ticket Code </p>
						     <input name="ticket_code" class="form-control"   value="<?php echo $ticket->ticket_code ?>" disabled>
						</div>

						<div class="form-group"><br/>
							 <p> Valid From </p>
						     <input name="valid_from" type="date" class="form-control" value="<?php echo $ticket->valid_from ?>">
						</div>

						<div class="form-group"><br/>
							 <p> Valid To </p>
						     <input name="valid_to"  type="date" class="form-control" value="<?php echo $ticket->valid_to ?>">
						</div>

						<div class="form-group"><br/>
							 <p> Ticket Type </p>

							 <select name="ticket_type" class="form-control">

						     	<option <?php if($ticket->ticket_type=="limit"){echo "selected";} ?> value="limit">Limit</option>
						     	<option <?php if($ticket->ticket_type=="unlimit"){echo "selected";} ?> value="unLimit">Unlimit</option>
						     </select>
						     
						</div>

						<div class="form-group"><br/>
							 <p> Limit </p>
						     <input name="limit" value="<?php echo $ticket->limit ?>"  type="number" min="1" class="form-control min_limit" >
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