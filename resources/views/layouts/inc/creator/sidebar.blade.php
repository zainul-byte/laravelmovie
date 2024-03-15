<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{ Request::is('creator/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('creator/dashboard')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ Request::is('creator/movie*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('creator/movie')}}">
          <i class="mdi mdi-movie menu-icon"></i>
          <span class="menu-title">Movie(s)</span>
        </a>
      </li>
    </ul>
</nav>

