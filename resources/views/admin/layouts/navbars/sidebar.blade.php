
<nav id="sidebar" style="min-height: 917px;">
  <div id="logo">
    <a href="" class="simple-text">
      Panel Admin
    </a>
  </div>
  <ul class="list-unstyled components">


    @guest
    <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
      <span class="glyphicon glyphicon-log-in"></span>
      <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
    </li>

    @else

    <li class="nav-item" >
      <a  href="{{ route('admin.dashboard')  }}" class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}">
        <i class="fa fa-fw fa-home"></i>
        {{ __('Dashboard') }} </a>

      </li>
      <li class="nav-item">
        <a href="{{ route('admin.profile')  }}" class="nav-link {{ request()->is('admin/profile') || request()->is('admin/profile/*') ? 'active' : '' }}" >
          <i class="fa-fw fas fa-user-plus">

          </i>
          {{ __('Profile') }}
        </a>
      </li>
<li>
        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{ trans('cruds.userManagement.title') }}
    </a>




     <ul class="collapse list-unstyled" id="homeSubmenu">


            <li  class="nav-item">
              <a href="{{ route('admin.users.index') }}"
              class="nav-link">
              <i class="fa-fw fas fa-user nav-icon">

              </i>
              {{ trans('cruds.user.title') }}
            </a>
          </li>


          <li  class="nav-item" >
            <a href="{{ route('admin.tasks.index') }}"
            class="nav-link {{ request()->is('admin/task') || request()->is('admin/task/*') ? 'active' : '' }}">
            <i class="fa-fw fas fa-briefcase nav-icon">

            </i>
            {{ trans('cruds.task.title') }}
          </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Orders</span>
            </a>
        </li>
  <li>

      <li class="nav-item">
       <a href="{{ route('admin.photos.index')  }}" class="nav-link {{ request()->is('admin/photos/index') || request()->is('admin/photos/index') ? 'active' : '' }}" >
         <i class="fa-fw fas fa-user-plus">

         </i>
         {{ __('List Photo') }}
       </a>
     </li>
  </ul>

</li>
<li class="nav-item">
  <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories')
    || request()->is('admin/categories/*') ? 'active' : '' }}">
    <i class="fa-fw fas fa-file-alt">

    </i>
    {{ trans('cruds.categ.title') }}
  </a>
</li>

<li class="nav-item">
  <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
    <i class="fa-fw fas fa-cogs nav-icon">

    </i>
    {{ trans('cruds.product.title') }}
  </a>
</li>



<li class="nav-item">
  <a href="{{ route('admin.clientStatuses.index') }}"
  class="nav-link {{ request()->is('admin/clientStatuses') ||
  request()->is('admin/clientStatuses/*') ? 'active' : '' }}">
  <i class="fa-fw fas fa-server"></i>

  {{ trans('cruds.clientStatus.title') }}

</a>
</li>







<li class="nav-item">
  <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}">
    <i class="fa-fw fas fa-user-plus">

    </i>
    {{ trans('cruds.client.title') }}

  </a>
</li>




<li class="nav-item">
  <a  class="nav-link" href="{{ route('admin.logout') }}"
  onclick="event.preventDefault();
  document.getElementById('logout-form').submit();">
  <i class="nav-icon fas fa-fw fa-sign-out-alt">

  </i>    {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
  @csrf
</form>

</li>
@endguest
</ul>

<!-- /.sidebar-menu -->
</nav>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
