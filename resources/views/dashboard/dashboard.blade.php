@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
	<div class="page-title-box">
    </div>
    
    <div class="main-padding">
    	
        
        <div class="col-xs-12">
                <div class="main-box">


<br/>
<div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Total OutSide Today</h3>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body"><?php echo $outside?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Total Inside Today</h3>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>
                <div class="panel-body"><?php echo $inside?></div>
        </div>
    </div>
 
    
      




                    
                </div>
        </div>
    </div>
    
</main>

   @stop
    

    
    
 
    
    


