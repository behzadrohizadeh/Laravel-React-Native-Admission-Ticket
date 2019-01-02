@extends('footer')
@extends('sidebar')
@extends('header')
@section('content')

<!-- Main -->
<main class="main">
  <div class="page-title-box">
      <span class="page-title">All User</span>
        <span class="page-description"></span>
    </div>
    
    <div class="main-padding">
      <div class="col-xs-12">
        <div class="main-box">
          <div class="table-responsive"> <br/> 
            <ul class="col-lg-8 col-sm-12 pull-right inline">
              <li><a class="btn btn-sm btn-<?php if($wheres==-1){echo "success";}else{echo "info";} ?>" href="/user/index">All</a></li>

              <?php 
               foreach ($roles as  $val) { ?>
                <li>
                  <a class="btn btn-sm btn-<?php if($wheres==$val->id_role){echo "success";}else{echo "info";} ?>" href="/user/index/<?php echo $val->id_role ?>"> <?php echo $val->display_name; ?>
                  </a>
                </li>
                <?php  } ?>
            </ul>
            <div class="col-lg-3 col-sm-3 col-md-3 pull-left">
              <form class="navbar-form" role="search" method="GET">
                  <div class="input-group">
                  <label>Number Of Record:<?php echo $count_all;?></label>
                      <input type="text" class="form-control" placeholder="Search In User" name="q">
                  </div>
              </form>
            </div> 
            <table id="mytable" class="table table-bordred table-striped table-hover alldata" data-toggle="users">
              <thead style="background:#ccc;">
               <th>Row</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Date Update</th>                
                <th>Action</th>
              <thead>
              <tfoot style="background:#ccc;">
                <th>Row</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Date Update</th>                
                <th>Action</th>
              </tfoot>
              <tbody>
                <?php
                  $i=1;
                  $j=0;
                  foreach ($users as  $value) {
                    ?>
                    <tr class="del-<?php echo $value->id; ?>">
                        <td><?php echo ($i+($id-1)*50) ;?></td>
                        <td><img src="<?php echo $value->avatar;?>" width="50"></td>
                        <td data-title="id-<?php echo $value->id; ?>"  data-toggle="input-name-<?php echo ++$j;?>"><span class="input-name-<?php echo $j;?>"><?php echo $value->name;?></span><input type="text" value="<?php echo $value->name;?>" id="input-name-<?php echo $j;?>" class="form-control"  style="display:none;" /></td>
                      
                        <td ><?php echo $value->email;?></td>
                        <td>
                          <?php 

                          foreach ($roles as  $val) {
                            if ($val->id_role==$value->id_role) {
                              echo $val->display_name;
                            }
                          }
                          
                           ?>
                        </td>
                       
                        <td data-title="id-<?php echo $value->id; ?>"  data-toggle="input-mobile-<?php echo ++$j;?>"><span class="input-mobile-<?php echo $j;?>"><?php echo $value->mobile; ?></span><input type="text" value="<?php echo $value->mobile;?>" id="input-mobile-<?php echo $j;?>" class=" form-control" style="display:none;"  /></td>
                        <td><?php if($value->active==1){?>
                          <a href="#" class="btn btn-success btn-sm">Active</a>
                        <?php 
                          }else{?>
                          <a href="#" class="btn btn-danger btn-sm">Deactive</a>
                          <?php } ?></td>
                        <td><?php echo $value->date_create;?></td>
                        <td>
                          <a class="btn btn-success btn-xs" href="<?php  echo '/user/showuser/'.$value->id; ?>">Show</a>
                          <button data-toggle="id-<?php echo $value->id;?>" class="btn btn-primary btn-xs edit"  ><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <button data-toggle="id-<?php echo $value->id;?>" class="btn btn-danger btn-xs delete" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                       </tr>
                  <?php $i++;}?>
           </tbody>
                    
      </table>

              <center dir="rtl">
                <?php settype($id,'integer');
                if ($pagnation > 1 ) {
                ?>
                   <ul class="pagination pagination-centered">
                        <li><a href="/user/index/<?php echo $wheres ;?>/<?php echo $id-1;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>">قبلی</a></li>
                           <?php if ($pagnation==0) {
                            $pagnation=0;
                           }
                          
                    for ($i=1; $i <=$pagnation ; $i++) {
                    if ($id==$i) {?>
                         <li class="active"><a  href="/user/index/<?php echo $wheres ;?>/<?php echo $i;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>"><?php echo $i;?></a></li>

                    <?php  }else{ ?>
                        <li><a href="/user/index/<?php echo $wheres ;?>/<?php echo $i;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>"><?php echo $i;?></a></li>
                        <?php }}?>
                        <li><a href="/user/index/<?php echo $wheres ;?>/<?php echo $id+1;if(isset($_GET['q'])){echo '?q='.$_GET['q'];}?>">بعدی</a></li>
                    </ul>
                    <?php }?>
              </center>
        </div>
      </div>
    </div>
  </div>
</main>


<div class="modal fade" id="edit" data-toggle="name,mobile" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
          <div class="form-group">Display Name
        <input class="form-control"  id="name-name-name" type="text" >
        </div>
       
        <div class="form-group">Mobile
        <input  id="mobile-mobile-mobile" class="form-control" type="text" />
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