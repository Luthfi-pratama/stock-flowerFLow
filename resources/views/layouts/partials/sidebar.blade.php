<nav class="nxl-navigation">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="{{ url('/') }}" class="b-brand">
          <span class="logo logo-lg" style="font-size: 24px; font-weight: bold; text-align: center">Flosun</span>
          <span class="logo logo-sm" style="font-size: 18px; text-align: center">F</span>
      </a>
    </div>
    <div class="navbar-content">
      <ul class="nxl-navbar">
        <li class="nxl-item ">
         <a href="{{ route('admin.dashboard') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-home"></i></span>
            <span class="nxl-mtext">Dashboards</span>
        </a>
        </li>
        
        <li class="nxl-item nxl-caption">
          <label>Navigation</label>
        </li>
        <li class="nxl-item nxl-hasmenu">
          <a href="{{ route('admin.produk.index') }}" class="nxl-link">
            <span class="nxl-micon"><i class="feather-slack"></i></span>
            <span class="nxl-mtext">Flowers</span>
          </a>
        </li>
        
      </ul> 
    </div>
  </div>
</nav>
