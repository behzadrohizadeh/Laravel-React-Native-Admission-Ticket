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
          <div class="table-responsive">

            <img   src="<?php echo URL('/').'/qrcodes/'.$ticket[0]->ticket_code.'.png'; ?>" />
 


           <table id="mytable" class="table table-bordred table-striped table-hover alldata" data-toggle="ticket">
              <thead style="background:#009688;">
                <th>Ticket Name</th>
                <th>Ticket Code</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Ticket Type</th>
                <th>Limit</th>
                <th>Times_used</th>
                <th>Action</th>
              <thead>
              <tfoot style="background:#009688;">
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
                  foreach ($ticket as  $value) {
                    ?>
                    <tr class="del-<?php echo $value->id_ticket; ?>">
                      
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
                       </tr>
                  <?php $i++;}?>
           </tbody>
                    
      </table> 
            
             
            <table id="mytable" class="table table-bordred table-striped table-hover alldata" data-toggle="ticket">
              <thead style="background:#2196F3;">
                <th>Row</th>
                <th>Admission</th>
                <th>Date Admission</th>
                <th>Type</th>
               
              <thead>
              <tfoot style="background:#2196F3;">
                <th>Row</th>
                <th>Admission</th>
                <th>Date Admission</th>
                <th>Type</th>
              </tfoot>
              <tbody>
                <?php
                  $i=1;
                  $j=0;
                  foreach ($history as  $value) {
                    ?>
                    <tr >
                         <td><?php echo ($i) ;?></td>
                         <td ><?php echo $value->name;?></td>
                         <td ><?php echo $value->date_create;?></td>
                         <td ><?php echo $value->type;?></td>
                       </tr>
                  <?php $i++;}?>
           </tbody>
                    
      </table>

             
        </div>
      </div>
    </div>
  </div>
</main>




      @stop