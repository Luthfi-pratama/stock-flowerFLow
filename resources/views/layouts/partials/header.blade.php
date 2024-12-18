<header class="nxl-header">
      <div class="header-wrapper">
        <!--! [Start] Header Left !-->
        <div class="header-left d-flex align-items-center gap-4">
          <!--! [Start] nxl-head-mobile-toggler !-->
          <a
            href="javascript:void(0);"
            class="nxl-head-mobile-toggler"
            id="mobile-collapse"
          >
            <div class="hamburger hamburger--arrowturn">
              <div class="hamburger-box">
                <div class="hamburger-inner"></div>
              </div>
            </div>
          </a>
          <!--! [Start] nxl-head-mobile-toggler !-->
          <!--! [Start] nxl-navigation-toggle !-->
          <div class="nxl-navigation-toggle">
            <a href="javascript:void(0);" id="menu-mini-button">
              <i class="feather-align-left"></i>
            </a>
            <a
              href="javascript:void(0);"
              id="menu-expend-button"
              style="display: none"
            >
              <i class="feather-arrow-right"></i>
            </a>
          </div>
          <!--! [End] nxl-navigation-toggle !-->
          <!--! [Start] nxl-lavel-mega-menu-toggle !-->
          <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
            <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
              <i class="feather-align-left"></i>
            </a>
          </div>
          <!--! [End] nxl-lavel-mega-menu-toggle !-->
          <!--! [Start] nxl-lavel-mega-menu !-->
          <div class="nxl-drp-link nxl-lavel-mega-menu">
            <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
              <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide">
                <i class="feather-arrow-left me-2"></i>
                <span>Back</span>
              </a>
            </div>
            <!--! [Start] nxl-lavel-mega-menu-wrapper !-->
            <!--! [End] nxl-lavel-mega-menu-wrapper !-->
          </div>
          <!--! [End] nxl-lavel-mega-menu !-->
        </div>
        <!--! [End] Header Left !-->
        <!--! [Start] Header Right !-->
        <div class="header-right ms-auto">
          <div class="d-flex align-items-center">
            <div class="dropdown nxl-h-item">
              <a
                href="javascript:void(0);"
                data-bs-toggle="dropdown"
                role="button"
                data-bs-auto-close="outside"
              >
                <img
                  src="{{ asset('assets/images/avatar/1.png') }}"
                  alt="user-image"
                  class="img-fluid user-avtar me-0"
                />
              </a>
              <div
                class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown"
              >
                <div class="dropdown-header">
                  <div class="d-flex align-items-center">
                    <img
                      src="{{ asset('assets/images/avatar/1.png') }}"
                      alt="user-image"
                      class="img-fluid user-avtar"
                    />
                    <div>
                      <h6 class="text-dark mb-0">
                        {{ Auth::user()->name }}
                        <span class="badge bg-soft-success text-success ms-1"
                          >{{ Auth::user()->role ?? 'User' }}</span
                        >
                      </h6>
                      <span class="fs-12 fw-medium text-muted"
                        >{{ Auth::user()->email }}</span
                      >
                    </div>
                  </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="feather-log-out"></i>
                        <span>Logout</span>
                    </a>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--! [End] Header Right !-->
      </div>
    </header>