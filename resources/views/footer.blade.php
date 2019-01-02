
<div class="modal fade" id="reloading" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
      
        <li class="loading">
         <a href="#">
                <i class="fa fa-spinner fa-spin"></i><br> Loading
            </a>
        </li>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>

<div class="modal fade" id="showalert" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
      
        <div class="alert-message">
          
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>


<!-- Footer -->
<footer class="footer noprint">
   
</footer>
<script type="text/javascript">
     base_url="{{URL('/')}}/";
     csrfHash= "{{ csrf_token() }}"
</script>
<!-- javascript -->
<script src="{{ asset('themeadmin/js/bootstrap.3.0.3.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('themeadmin/js/doc.js')}}"></script>
<script src="{{ asset('themeadmin/js/cssfx.js')}}"></script>
<script src="{{ asset('themeadmin/js/other.js')}}"></script>   
    
</body>
</html>