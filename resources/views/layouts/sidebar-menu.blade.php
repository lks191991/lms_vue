
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt blue"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li>
      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-list orange"></i>
          <p>
          Courses Manager
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/product/category" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Category
              </p>
            </router-link>
          </li>
         <li class="nav-item">
            <router-link to="/sub-category" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Sub Category
              </p>
            </router-link>
          </li>
           <li class="nav-item">
            <router-link to="/courses" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Courses
              </p>
            </router-link>
          </li> 
		  <li class="nav-item">
            <router-link to="/topics" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Topics
              </p>
            </router-link>
          </li> 
          <li class="nav-item">
            <router-link to="/videos" class="nav-link">
              <i class="nav-icon fas fa-video green"></i>
              <p>
              Videos
              </p>
            </router-link>
          </li> 
        </ul>
      </li>

      @endcan
     
      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="fa fa-user nav-icon blue"></i>
          <p> 
          User Manager
          <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/students" class="nav-link">
              <i class="nav-icon fas fa-user-graduate green"></i>
              <p>
                Students
              </p>
            </router-link>
          </li>
         <li class="nav-item">
            <router-link to="/tutors" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher green"></i>
              <p>
                Tutors
              </p>
            </router-link>
          </li>
          
        </ul>
      </li>

      @endcan
      @can('isAdmin')
      <li class="nav-item">
        <router-link to="/coupons" class="nav-link">
          <i class="nav-icon fas fa-gift orange"></i>
          <p>
          Coupons
          </p>
        </router-link>
      </li>
      @endcan

      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

         
          <li class="nav-item">
            <router-link to="/product/pages" class="nav-link">
              <i class="nav-icon fas fa-copy green"></i>
              <p>
                Pages
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/site-setting" class="nav-link">
              <i class="nav-icon fas fa-cogs orange"></i>
              <p>
                Site Settings
              </p>
            </router-link>
          </li>
           
        </ul>
      </li>

      @endcan
      
      

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>