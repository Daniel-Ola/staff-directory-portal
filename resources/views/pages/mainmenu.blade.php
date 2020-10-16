<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CITITRUST PORTAL</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('main_menu/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('main_menu/vendors/base/vendor.bundle.base.css') }}">


  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('main_menu/css/style.css') }}">
  <!-- endinject -->
  
  <link rel="icon" href="{{ asset('main_menu/assets/media/citi_assets/favicon-192x192.png') }}" sizes="192x192" />
  <link rel="apple-touch-icon" href="{{ asset('main_menu/assets/media/citi_assets/apple-touch-icon-180x180.png') }}" />
  <meta name="msapplication-TileImage" content="{{ asset('main_menu/assets/media/citi_assets/favicon.png') }}" />

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="">USER MENU</a>
        <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('main_menu/images/fav.png') }}" alt="logo"/></a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button> -->
        <!-- <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          
         <!--  <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li> -->
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset(Auth::user()->dp) }}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
     <!--  <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Form elements</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="ti-pie-chart menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/themify.html">
              <i class="ti-star menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
              <i class="ti-write menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav> -->
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">User Homepage</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Report
                    </button>
                </div>
              </div>
            </div>
          </div> -->

          <style type="text/css">
            
            .main-menu-divs-inner{

              float: left;
              width: 10%;
              height: 180px;
              
              margin-right: 2%;
              margin-top: 1%;
              color: #000;
              

               align-items: center;
               border-radius: 5px;
               color: inherit;
               display: flex;
               flex-direction: column;
               padding: 16px;
               text-align: center;
             }

            .main-menu-divs-inner:hover {
              background: #E0E0E0;
            }


            .brand-logo{
              color: #fff!important;
            }


            .title{
                  cursor: context-menu;
                  font-weight: 700;
                  max-width: 130px;
                  padding-top: 20px;
                  text-align: center;
                  font-size: 14px;
            }

            .description{
                  cursor: context-menu;

              color: #616161;
              font-size: 12px;
              margin-top: 4px;
              max-width: 130px;
              min-height: 42px;
              text-align: center;

            }

            .footer{
              background: #fff;
              padding: 30px 2.45rem;
              transition: all 0.25s ease;
              -moz-transition: all 0.25s ease;
              -webkit-transition: all 0.25s ease;
              -ms-transition: all 0.25s ease;
              font-size: calc(0.875rem - 0.05rem);
              
              font-weight: 400;
              border-top: 1px solid rgba(0, 0, 0, 0.06);
            }


            .main-menu-divs-inner img{
              width: 48px;
              height: 48px;
              color: #4285f4 !important;
            }


            .footer-logo img{
              width: 120px!important;
              height: 20px!important;
              float: right;
            }

            .main-menu-divs{
              display: flex!important;
              flex-wrap: wrap!important;
              flex-direction: row!important;
              justify-content: flex-start!important;
              align-content: flex-start!important;
              align-items: flex-start!important;

            }

            .content-wrapper{
              background: #fff !important;
            }

            body{
              background: #fff!important;
              font-family: "Roboto", sans-serif;
            }

          </style>

        <div class="main-menu-divs">

            <div class="main-menu-divs-inner local" href="{{ route('home') }}">

              <img src="{{ asset('main_menu/images/dashboard.svg') }}" />
              <div class="title">Dashboard</div>
              <div class="description">See relevant insight about your organization</div>

            </div>

            <div class="main-menu-divs-inner local" href="{{ route('profile.edit') }}">

              <img src="{{ asset('main_menu/images/user.svg') }}" />
              <div class="title">Users</div>
              <div class="description">Add or manage users</div>
              
            </div>

            <div class="main-menu-divs-inner local" href="{{ route('admin.manage') }}">
              
              <img src="{{ asset('main_menu/images/admin.svg') }}" />
              <div class="title">Admin Roles</div>
              <div class="description">Manage Administrstive rights</div>

            </div>

            <div class="main-menu-divs-inner local" href="{{ route('staffs.view') }}">
              
              <img src="{{ asset('main_menu/images/directory.svg') }}" />
              <div class="title">Directory</div>
              <div class="description">Access your organization's staff list</div>

            </div>


             <div class="main-menu-divs-inner local" href="{{ route('fmi') }}">
              
              <img src="{{ asset('main_menu/images/file.svg') }}" />
              <div class="title">File Manager</div>
              <div class="description">Upload, Save and download your documents</div>

            </div>


            <div class="main-menu-divs-inner local">
              
              <img src="{{ asset('main_menu/images/organization.svg') }}" href="{{ route('subdesig') }}" />
              <div class="title">Subsidiaries</div>
              <div class="description">Add, Remove or search for an organizational unit</div>

            </div>

            <div class="main-menu-divs-inner local">
              
              <img src="{{ asset('main_menu/images/account settings.svg') }}" target="#" />
              <div class="title">Account Settings</div>
              <div class="description">Update information about your profile</div>

            </div>

            @forelse ($softwares as $soft)
              <div class="main-menu-divs-inner gateway" target='{{ route(strtolower($soft->name)) }}'>
                <img src="{{ asset($soft->icon) }}" />
                <div class="title">{{ $soft->name }}</div>
                <div class="description">{{ $soft->description }}</div>
              </div>
            @empty
                
            @endforelse

             {{-- <div class="main-menu-divs-inner local" target="#">
              
              <img src="{{ asset('main_menu/images/inventory.svg') }}" />
              <div class="title">Inventory</div>
              <div class="description">Update information about your profile</div>

            </div>

            <div class="main-menu-divs-inner gateway" target='{{ route('documentation') }}'>
              
               <img src="{{ asset('main_menu/images/documentation.svg') }}" />
              <div class="title">Documentation</div>
              <div class="description">Complete your on-boarding process</div>

            </div>

             <div class="main-menu-divs-inner local" target="#">
              
              <img src="{{ asset('main_menu/images/procurement.svg') }}" />
              <div class="title">Procurement</div>
              <div class="description">Upload your procurement process</div>

            </div> --}}


        </div>
          
         
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020<a href="https://www.CITITRUSTHOLDINGS.com/" target="_blank"> CITITRUST</a>. All rights reserved.

              
            </span>

          <span class="footer-logo" href="#"><img src="{{ asset('main_menu/images/logo.png') }}"/></span>            
       
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('main_menu/vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('main_menu/vendors/chart.js/Chart.min.js') }}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('main_menu/js/off-canvas.js') }}"></script>
  <script src="{{ asset('main_menu/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('main_menu/js/template.js') }}"></script>
  <script src="{{ asset('main_menu/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('main_menu/js/dashboard.js') }}"></script>
  <!-- End custom js for this page-->

  <script>

    $('.gateway').click(function(e) {
      e.preventDefault();
      const url = $(this).attr('target');
      console.log(url);
      var win = window.open(url, '_blank');
      win.focus();
    });

    $('.local').click(function(e) {
      window.location.href = $(this).attr('href');
    })

    function openInNewTab(url) {
      alert(3231);
      var win = window.open(url, '_blank');
      win.focus();
    }
  </script>

</body>

</html>

