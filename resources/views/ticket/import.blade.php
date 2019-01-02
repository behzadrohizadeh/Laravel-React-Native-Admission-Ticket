
@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
	    	<span class="page-title">Import Ticket By XLS file</span>
	        <span class="page-description"></span>
	    </div>
	    <div class="col-xs-12">
	        <div class="main-box">

			<form method="POST" class='login-form' action="/ticket/importer" enctype="multipart/form-data">
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

			         <?php if (!empty($error)) { ?>
			       <div class="row">
			            <div class="alert alert-danger">
			                  <b style="color:green; margin-right:10px;" ><?php echo ($error); ?></b>
			            </div>
			        </div>
			        <?php } ?>
			        <a target="_blank" class="btn btn-info" href="{{URL('/')}}/themeadmin/s.xlsx">Sample File</a>
						

						<div class="form-group">
							 <p>    [xlsx] File </p>
						   <input type="file" name="xlsxfile" size="20" />

						</div>


					
						
				    <div class="col col-lg-2">
				    	<input type="submit" name="submit" value="Import" class="btn btn-success">	<br/><br/>
				    </div>
			    </div>	
			  </form>

	      
	    </div>
	</div>
</main>

@stop