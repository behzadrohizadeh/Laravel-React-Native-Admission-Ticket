@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
  <div class="page-title-box">
      <span class="page-title">Users Role</span>
        <span class="page-description"></span>
    </div>
    
    <div class="main-padding">
      <div class="col-xs-12">
        <div class="main-box">
          <div class="table-responsive"> <br/> 
           
            <div class="col-lg-3 col-sm-3 col-md-3 pull-left">
              <form class="navbar-form" role="search" method="GET">
                  <div class="input-group">
                  <label>Number Of Record:<?php echo count( $roles);?></label>
                  </div>
              </form>
            </div> 
            <a  class="btn btn-primary btn-xs" href="/user/addrole" >New Role </a>

            <table id="mytable" class="table table-bordred table-striped table-hover alldata" data-toggle="roles">
              <thead style="background:#ccc;">
                <th>Row</th>
                <th>Role</th>
                <th>Capabilities </th>
                <th>Action</th>
              <thead>
              <tfoot style="background:#ccc;">
                <th>Row</th>
                <th>Role</th>
                <th>Capabilities </th>
                <th>Action</th>
              </tfoot>
              <tbody>
                <?php
                  $i=1;
                  $j=0;
                  foreach ( $roles as  $value) {

                      if ($value->id_role==1) {
                     
                    ?>
                    <tr >
                    <td><?php echo $i ;?></td>
                        
                       
                        <td><?php echo $value->display_name?></td>
                        <td>
                         All
                        </td>
                         
                        <td></td>
                        

                         
                       </tr>
                  <?php $i++;}
                    if ($value->id_role!=1) {
                     
                    ?>
                    <tr class="del-<?php echo $value->id_role; ?>">
                    <td><?php echo $i ;?></td>
                        
                       
                        <td><?php echo $value->display_name?></td>
                        <td>
                          <?php 
                              $caps= explode(',', $value->caps);
                             foreach ($allroles as $val) {
                              $checked="";
                              if (in_array($val['controller'],  $caps)) {
                                echo $val['name'].",";
                                 }

                              
                              
                              } ?>
                        </td>
                         
                        <td>
                          <a  class="btn btn-primary btn-xs" href="/user/roleedit/<?php echo $value->id_role;?>" ><span class="fa fa-pencil-square-o"></span></a>

                          <button data-toggle="id_role-<?php echo $value->id_role;?>" class="btn btn-danger btn-xs delete" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                       </tr>
                  <?php $i++;} }?>
           </tbody>
                    
      </table>

        </div>
      </div>
    </div>
  </div>
</main>


<div class="modal fade" id="edit" data-toggle="name,phone" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="pull-left close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
        <h4 class="modal-title custom_align" id="Heading">ویرایش اطلاعات</h4>
        <li class="loading">
             <a href="#">
                <i class="fa fa-spinner fa-spin"></i><br> Loading
                <span>بارگزاری</span>
            </a>
        </li>
      </div>
          <div class="modal-body">
          
        <div class="form-group">نام
        <input  id="name-name-name" class="form-control" type="text" />
        </div>
        <div class="form-group">موبایل
        <input  id="phone-phone-phone" class="form-control" type="text" />
        </div>
        
       
       
        
     
      </div>
          <div class="modal-footer ">
        <button type="button" id="update" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> بروزرسانی</button>
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
        <h4 class="modal-title custom_align" id="Heading">حذف اطلاعات</h4>
        <li class="loading">
             <a href="#">
                <i class="fa fa-spinner fa-spin"></i><br> Loading
                <span>بارگزاری</span>
            </a>
        </li>
      </div>
  <div class="modal-body">
       
       <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span>آیا میخواهی حذف شود?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" id="del-row" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> بله</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> خیر</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>


      @stop