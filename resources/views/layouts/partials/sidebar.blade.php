<nav class="nxl-navigation">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="{{ url('/') }}" class="b-brand">
        <!-- Logo section -->
        <img src="{{ asset('assets/images/logo-full.png') }}" alt="Logo" class="logo logo-lg" />
        <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="Logo" class="logo logo-sm" />
      </a>
    </div>
    <div class="navbar-content">
      <ul class="nxl-navbar">
        <li class="nxl-item ">
         <a href="/dashboard" class="nxl-link">
            <span class="nxl-micon"><i class="feather-home"></i></span>
            <span class="nxl-mtext">Dashboards</span>
        </a>
        </li>
        
        <li class="nxl-item nxl-caption">
          <label>Navigation</label>
        </li>
        <li class="nxl-item nxl-hasmenu">
          <a href="{{ route('produk.index') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-slack"></i></span>
            <span class="nxl-mtext">Flowers</span>
          </a>
        </li>
        <li class="nxl-item nxl-hasmenu">
          <a href="javascript:void(0);" class="nxl-link">
            <span class="nxl-micon"><i class="feather-cast"></i></span>
            <span class="nxl-mtext">Reports</span>
            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
          </a>
          <ul class="nxl-submenu">
            <li class="nxl-item"><a class="nxl-link" href="{{ url('reports-sales') }}">Sales Report</a></li>
            <li class="nxl-item"><a class="nxl-link" href="{{ url('reports-leads') }}">Leads Report</a></li>
            <li class="nxl-item"><a class="nxl-link" href="{{ url('reports-project') }}">Project Report</a></li>
            <li class="nxl-item"><a class="nxl-link" href="{{ url('reports-timesheets') }}">Timesheets Report</a></li>
          </ul>
        </li>
        <!-- Add other navigation items here -->
      </ul> 
    </div>
  </div>
</nav>
