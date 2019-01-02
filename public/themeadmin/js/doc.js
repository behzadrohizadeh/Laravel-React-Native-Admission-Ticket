// Js by : milad davoodabadi
jQuery(document).ready( function($) {

imgajax = "";
inp = "";
var globals = new Array(); 

 /***********************************************Upload Image**/

 
/* $("body").on('click','button.uploadfile',function (){
        imgajax = $(this).attr("data-image"); 
        inp = $(this).attr("data-input");
      $('#upload').modal({show:true});
    }) ;
*/

    $('#upload_form').on('submit', function(e){
       e.preventDefault();
       var file = $('#uploadfile').val() ;
      
       if(file == '')  
           {  
                alert("Please Select the File");  
           }  
           

           if (file ) 
            {
             $('.loading').show();
              var file_data = $('#uploadfile').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('_token', csrfHash);             
            $.ajax({
                type:"POST",
                url:base_url+"upload/files",
                    data: form_data,
             contentType: false, //must, tell jQuery not to process the data
                    processData: false, //must, tell jQuery not to set contentType
                success:function(data)
                {
                var x=$.parseJSON(data);
                  csrfHash=x["crf"];
                 if (x["error"]) 
                  {
                     $("#upload_form .errorfile").html('<div class="alert alert-danger">'+x["error"]+'</div>');
                  }; 
                 if (x["src"]) 
                  {

                    $("#"+imgajax).attr("src",x["src"]);
                    $("#"+inp).val(x["src"]) ; 
                    $('#upload_form')[0].reset();
                    $('.loading').hide();
                    $('#upload').modal('hide');
                    $("#upload_form .errorfile").html('');

                  }


                }
           });

            };
      
    }) ; 

    $('#upload_form2').on('submit', function(e){
       e.preventDefault();
       var file = $('#uploadfile2').val() ;
      
       if(file == '')  
           {  
                alert("Please Select the File");  
           }  
           

           if (file ) 
            {
             $('.loading').show();
              var file_data = $('#uploadfile2').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                             
            $.ajax({
                type:"POST",
                url:base_url+"upload/files2",
                    data: form_data,
             contentType: false, //must, tell jQuery not to process the data
                    processData: false, //must, tell jQuery not to set contentType
                success:function(data)
                {
                var x=$.parseJSON(data);
                 if (x["error"]) 
                  {
                     $("#upload_form2 .errorfile").html('<div class="alert alert-danger">'+x["error"]+'</div>');
                  }; 
                 if (x["src"]) 
                  {
          $("#"+imgajax).attr("class","btn btn-success btn-sm");
          $("#"+imgajax).text(" دانلود ");  
                    $("#"+imgajax).attr("href",x["src"]);
                    $("#"+inp).val(x["src"]) ; 
                    $('#upload_form2')[0].reset();
                    $('.loading').hide();
                    $('#uploadfilem').modal('hide');
                    $("#upload_form2 .errorfile").html('');

                  }


                }
           });

            };
      
    }) ;   


$("body").on('click','button.uploadimage',function (){
        imgajax = $(this).attr("data-image"); 
        inp = $(this).attr("data-input");
      $('#upload').modal({show:true});
    }) ;
$("body").on('click','button.uploadfile',function (){
        imgajax = $(this).attr("data-image"); 
        inp = $(this).attr("data-input");
      $('#uploadfilem').modal({show:true});
    }) ;
 /***********************************************Upload Image**/


$('.close').click(function (){
	var idremove= $(this).attr('data-toggle');
	$('#'+idremove).hide(400);
});	



    
// ***** ***************  ***************** hide and show td,input
$('#mytable').on('click','tr td',function(){
 var idinput=$(this).attr('data-toggle');
  $('#'+idinput).css({'display':'block'});
  $('.'+idinput).css({'display':'none'});
  valbefor= $(this).attr('data-title'); //******************************get value for update
       }); 
// ***** ***************  ***************** hide and show td,input
$('main').click(function(e) {
  if ($("table.alldata").length > 0 ) {
  var target = e.target; //target div recorded
  if (!jQuery(target).parents(".alldata").attr("class") ) {
   $('#mytable tr td').each(function(){
    var idinput=$(this).attr('data-toggle');
    $('#'+idinput).css({'display':'none'});
    $('.'+idinput).css({'display':'block'});

   });
 }
}
});
// ***** ***************  ***************** send ajax data
$('#mytable').on('change','input',function(){
$('#reloading').modal({show:true});  
var val=$(this).val();
var database=$('#mytable').attr('data-toggle');
 filedid=$(this).attr('id');
filed=filedid.split('-');
filed=filed[1];

            $.ajax({
                type:"POST",
                url:base_url+"update/udpdatetd",
                 data:{_token :csrfHash,database :database,filed:filed,valbefor:valbefor,valnew:val},
                 success:function(data)
                {
                	var x=$.parseJSON(data);
                  csrfHash=x["crf"];
                    if (x["data"]!='no') 
                    {
                       // alert(filedid);
                     $('#'+filedid).css({'display':'none'});
                     $('.'+filedid).text(x["data"]);
                     $('.'+filedid).css({'display':'block'});
                    };                
                }
    	    });
    $('#reloading').modal('hide');  
});
// ***** ***************  ***************** send ajax data

$('#mytable').on('click','button.edit',function(){
    $('#reloading').modal({show:true});  
	  var getrow=$('#edit').attr('data-toggle');
	  rowids=$(this).attr('data-toggle');
	  rowid=rowids.split('-');
	  var database=$('#mytable').attr('data-toggle');

		$.ajax({
		         type:"POST",
		         url:base_url+"update/updaterow",
		         data:{_token :csrfHash,database :database,id:rowid[1],where:rowid[0],getrow:getrow},
		         success:function(data)
		         {

		          var x=$.parseJSON(data);
              csrfHash=x["crf"];
		          var key=Object.keys(x["data"]);
		          for (var i = 0; i <= key.length; i++) 
		            {
		            $('#'+key[i]+'-'+key[i]+'-'+key[i]).val(x["data"][key[i]]);
		             };              
		            }
		    	    });
            $('#reloading').modal('hide');  
	        $('#edit').modal({show:true});
     });

  $('.modal').on('click','button#update',function(){
    $('.loading').show();
     var getrow=$('#edit').attr('data-toggle');
     rowid=rowids.split('-');
     var database=$('#mytable').attr('data-toggle');
     getrow=getrow.split(',');
     var datasend="";
     for (var i = 0; i < getrow.length; i++) {
 
    datasend+=getrow[i]+'@@'+$('#'+getrow[i]+'-'+getrow[i]+'-'+getrow[i]).val()+'@@';
    
   };
   $.ajax({
            type:"POST",
            url:base_url+"update/edittable",
            data:{_token :csrfHash,database :database,id:rowid[1],where:rowid[0],getrow:getrow,datasend:datasend},
            success:function(data)
            {
            var x=$.parseJSON(data);
              csrfHash=x["crf"]; 
              $('.loading').hide();          
            }
          });
$('#edit').modal('hide');
    });
$('#mytable').on('click','button.delete',function(){
 delid=$(this).attr('data-toggle');
 $('#delete').modal({show:true});

});
  $('.modal').on('click','button#del-row',function(){
     delid=delid.split('-');
     var database=$('#mytable').attr('data-toggle');           
     $('.loading').show();
   $.ajax({
            type:"POST",
            url:base_url+"update/delete",
            data:{_token :csrfHash,database :database,id:delid[1],where:delid[0]},
            success:function(data)
            {
             var x=$.parseJSON(data);
              csrfHash=x["crf"];
             $( ".del-"+delid[1]).css({"background":"red"});
              $( ".del-"+delid[1]).animate({
                    opacity: 0.25,
                  }, 500, function() {
                   $( ".del-"+delid[1]).remove();
                  });  

                  $('.loading').hide();         
                            }
          });
$('#delete').modal('hide');
  });


$('body').on('keyup','input.price',function(){

   var vl=$(this).val();
   vl=vl.replace(/\,/g, "");
   if (!vl) {
    vl=0;
   };
  
  $(this).val( Number(vl).toLocaleString() );
});


$('body').on('keyup','input.max_limit',function(){

   var max=parseInt($(this).attr("max"));
   if ($(this).val() > max) 
    {

     //alert("مقدار وارد شده نمی تواند بیشتر از "+max+" باشد"); 
      var htmls='<div class="alert alert-danger">max value is ='+max+' ';
      htmls+='<button type="button" class="pull-left close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times-circle-o" aria-hidden="true"></span></button>';
      htmls+='</div>';
      $("#showalert .alert-message").html(htmls);
      $("#showalert").modal({show:true});
      $(this).val( max);
    };
  
});

$('body').on('keyup','input.min_limit',function(){

   var min=parseInt($(this).attr("min"));
   if ($(this).val() < min) 
    {

     //alert("مقدار وارد شده نمی تواند بیشتر از "+max+" باشد"); 
      var htmls='<div class="alert alert-danger">minimum value is ='+min+' ';
      htmls+='<button type="button" class="pull-left close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times-circle-o" aria-hidden="true"></span></button>';
      htmls+='</div>';
      $("#showalert .alert-message").html(htmls);
      $("#showalert").modal({show:true});
      $(this).val( min);
    };
  
});

});