@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
  <div class="page-title-box">
      <span class="page-title">All Ticket</span>
        <span class="page-description"></span>
    </div>
    
    <div class="main-padding">
      <div class="col-xs-12">
        <div class="main-box">
          <div class="table-responsive"> <br/> 
            
            <div class="col-lg-3 col-sm-3 col-md-3 pull-left">
              <form class="navbar-form" role="search" method="GET">
                  <div class="input-group">
                  <label>Number Of Record:<?php echo $count_all;?></label>
                      <input type="text" class="form-control" placeholder="Search In Ticket" name="q">
                  </div>
              </form>
            </div> 
            <table id="mytable" class="table table-bordred table-striped table-hover alldata" data-toggle="ticket">
              <thead style="background:#ccc;">
                <th>Row</th>
                <th>Ticket Name</th>
                <th>Ticket Code</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Ticket Type</th>
                <th>Limit</th>
                <th>Times_used</th>
                <th>Action</th>
              <thead>
              <tfoot style="background:#ccc;">
                 <th>Row</th>
                <th>Ticket Name</th>
                <th>Ticket Code</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Ticket Type</th>
                <th>Limit</th>
                <th>Times_used</th>
                <th>Action</th>
              </tfoot>
              <tbody>
                <?php
                  $i=1;
                  $j=0;
                  foreach ($tickets as  $value) {
                    ?>
                    <tr class="del-<?php echo $value->id_ticket; ?>">
                        <td><?php echo ($i+($id-1)*50) ;?></td>
                      
                        <td data-title="id_ticket-<?php echo $value->id_ticket; ?>"  data-toggle="input-ticket_name-<?php echo ++$j;?>"><span class="input-ticket_name-<?php echo $j;?>"><?php echo $value->ticket_name;?></span><input type="text" value="<?php echo $value->ticket_name;?>" id="input-ticket_name-<?php echo $j;?>" class="form-control"  style="display:none;" />
                        </td>

                         <td ><?php echo $value->ticket_code;?></td>
                         <td ><?php echo $value->valid_from;?></td>
                         <td ><?php echo $value->valid_to;?></td>
                         <td ><?php echo $value->ticket_type;?></td>
                         <td ><?php

                         if ($value->ticket_type=="limit") {
                         
                          echo $value->limit;
                        }else{echo "unlimit";}

                          ?></td>
                         <td ><?php echo $value->times_used;?></td>

                       
                       
                       
                          
                        <td>
                          <a class="btn btn-warning btn-xs" href="<?php  echo '/ticket/edit/'.$value->id_ticket; ?>">Edit</a>
                          <button data-toggle="id_ticket-<?php echo $value->id_ticket;?>" class="btn btn-danger btn-xs delete" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                       </tr>
                  <?php $i++;}?>
           </tbody>
                    
      </table>

              <center dir="rtl">
                <?php settype($id,'integer');
                if ($pagnation > 1 ) {
                ?>
                   <ul class="pagination pagination-centered">
                        <li><a href="/ticket/index/<?php echo $wheres ;?>/<?php echo $id-1;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>">قبلی</a></li>
                           <?php if ($pagnation==0) {
                            $pagnation=0;
                           }
                          
                    for ($i=1; $i <=$pagnation ; $i++) {
                    if ($id==$i) {?>
                         <li class="active"><a  href="/ticket/index/<?php echo $wheres ;?>/<?php echo $i;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>"><?php echo $i;?></a></li>

                    <?php  }else{ ?>
                        <li><a href="/ticket/index/<?php echo $wheres ;?>/<?php echo $i;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>"><?php echo $i;?></a></li>
                        <?php }}?>
                        <li><a href="/ticket/index/<?php echo $wheres ;?>/<?php echo $id+1;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>">بعدی</a></li>
                    </ul>
                    <?php }?>
              </center>
        </div>
      </div>
    </div>
  </div>
</main>


<div class="modal fade" id="edit" data-toggle="name" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="pull-left close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
        <h4 class="modal-title custom_align" id="Heading">Edit User</h4>
        <li class="loading">
             <a href="#">
                <i class="fa fa-spinner fa-spin"></i><br> Loading
            </a>
        </li>
      </div>
          <div class="modal-body">
          <div class="form-group"> Name
        <input class="form-control"  id="name-name-name" type="text" >
        </div>
       
       
        
       
       
       
        
      </div>
          <div class="modal-footer ">
        <button type="button" id="update" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete ticket</h4>
        <li class="loading">
             <a href="#">
                <i class="fa fa-spinner fa-spin"></i><br> Loading
            </a>
        </li>
      </div>
  <div class="modal-body">
       
       <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span>Are You Shur?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" id="del-row" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>


      @stop