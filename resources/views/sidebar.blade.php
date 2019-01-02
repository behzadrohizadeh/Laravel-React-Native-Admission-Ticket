
@yield('header')

<!-- Sidebar -->
<aside class="sidebar">
  <div class="inner-sidebar">
      <div class="sidebar-panel-header"><a href="/profile">
        <img style="width:241px;height:50px;" src="/themeadmin/images/logo.png" alt="Logo"/></a>
      </div>
        <ul class="sidebar-ul">



        <li><a href="#"><span><i class="fa fa-user-circle"></i></span> Users <i class="fa fa-angle-left"></i></a>
                <ul>
                  <li><a href="/user"> All </a></li>
                  <li><a href="/user/adduser">New User</a></li>
                 <li><a href="/user/roles">Roles </a></li>
                </ul>

        </li>

         <li><a href="#"><span><i class="fa fa-user-circle"></i></span> Area <i class="fa fa-angle-left"></i></a>
                <ul>
                  <li><a href="/area"> All </a></li>
                  <li><a href="/area/addarea">New Area</a></li>
                </ul>

        </li>

         <li><a href="#"><span><i class="fa fa-user-circle"></i></span> Gates <i class="fa fa-angle-left"></i></a>
                <ul>
                  <li><a href="/gate"> All </a></li>
                  <li><a href="/gate/addgate">New gate</a></li>
                </ul>

        </li>

         <li><a href="#"><span><i class="fa fa-user-circle"></i></span> Admission <i class="fa fa-angle-left"></i></a>
                <ul>
                  <li><a href="/admission"> All </a></li>
                  <li><a href="/admission/addadmission">New Admission</a></li>
                </ul>

        </li>

         <li>
          <a href="#"><span><i class="fa fa-user-circle"></i></span> Ticket <i class="fa fa-angle-left"></i></a>
                <ul>
                  <li><a href="/ticket"> All </a></li>
                  <li><a href="/ticket/addticket">New Ticket</a></li>
                </ul>

        </li>
            

              
            

        </ul>
    </div>
</aside>
@yield('content')
