<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>One Ummah Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons.font/font/typicons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject --> 
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="row" id="proBanner">
      <div class="col-12">
      
      </div>
    </div>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/logo.svg')}}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/logo-mini.svg')}}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
         
          <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item dropdown d-flex">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                <i class="typcn typcn-message-typing"></i>
                <span class="count bg-success">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{ asset('assets/images/faces/face4.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text mb-0">
                      The meeting is cancelled
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{ asset('assets/images/faces/face2.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text mb-0">
                      New product launch
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text mb-0">
                      Upcoming board meeting
                    </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown  d-flex">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="typcn typcn-bell mr-0"></i>
                <span class="count bg-danger">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="typcn typcn-info-large mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0">
                      Just now
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="typcn typcn-cog mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0">
                      Private message
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="typcn typcn-user-outline mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0">
                      2 days ago
                    </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                <i class="typcn typcn-user-outline mr-0"></i>
                <span class="nav-profile-name">Evan Morales</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                <i class="typcn typcn-cog text-primary"></i>
                Settings
                </a>
                <a class="dropdown-item">
                <i class="typcn typcn-power text-primary"></i>
                Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close typcn typcn-delete-outline"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme">
              <div class="img-ss rounded-circle bg-light border mr-3"></div>
              Light
            </div>
            <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
              <div class="img-ss rounded-circle bg-dark border mr-3"></div>
              Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles primary"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default border"></div>
            </div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <div class="d-flex sidebar-profile">
              <div class="sidebar-profile-image">
                <img src="{{ asset('assets/images/faces/face29.png')}}" alt="image">
                <span class="sidebar-status-indicator"></span>
              </div>
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                 Super Admin
                </p>
                <p class="sidebar-designation">
                  Welcome
                </p>
              </div>
            </div>
            <div class="nav-search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                <div class="input-group-append">
                  <span class="input-group-text" id="search">
                    <i class="typcn typcn-zoom"></i>
                  </span>
                </div>
              </div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard <span class="badge badge-primary ml-3">New</span></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="typcn typcn-film menu-icon"></i>
              <span class="menu-title">Data User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Data Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Data User</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-briefcase menu-icon"></i>
              <span class="menu-title">Data Qur'an</span>
              <i class="typcn typcn-chevron-right menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/data-juz')}}">Data Juz</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Data Info Tafisr</a></li>
              </ul>
            </div>
          </li>
      
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="typcn typcn-chart-pie-outline menu-icon"></i>
              <span class="menu-title">Bookmark Qur'an</span>
             
            </a>
           
          </li>

        
        </ul>
      
      </nav>
        <!-- partial -->
        @yield('content')
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/template.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page-->
    @yield('js-custom')
     <script>
        $(document).on('change', '.select-all', function() {
            if ($(this).is(':checked')) {
                $('[name="check[]"]').each(function() {
                    $(this).prop('checked', true);
                    $("#deletebutton").prop("disabled", false);
                    $("#showbutton").prop("disabled", false);
                    $("#hidebutton").prop("disabled", false);
                    $("#rejectbutton").prop("disabled", false);
                    $(".alls").val('1');
                    $("#shows").append('<input type="hidden" name="shows[]" value="' + $(this).val() + '">');
                    $("#hides").append('<input type="hidden" name="hides[]" value="' + $(this).val() + '">');
                    $("#rejects").append('<input type="hidden" name="rejects[]" value="' + $(this).val() + '">');
                });
            } else {
                $('[name="check[]"]').each(function() {
                    $(this).prop('checked', false);
                    $(".alls").val('0');
                    $("#deletebutton").prop("disabled", true);
                    $("#showbutton").prop("disabled", true);
                    $("#hidebutton").prop("disabled", true);
                    $("#rejectbutton").prop("disabled", true);
                    $("#shows").html("");
                    $("#hides").html("");
                    $("#rejects").html("");
                });
            }
        });
        $("#deletebutton").prop("disabled", true);
        $("#showbutton").prop("disabled", true);
        $("#hidebutton").prop("disabled", true);
        $("#rejectbutton").prop("disabled", true);
        $(document).on('change', '[name="check[]"]', function() {
            if ($(this).is(':checked')) {
                $("#deletebutton").prop("disabled", false);
                $("#showbutton").prop("disabled", false);
                $("#hidebutton").prop("disabled", false);
                $("#rejectbutton").prop("disabled", false);
                $("#shows").append('<input type="hidden" name="shows[]" value="' + $(this).val() + '">');
                $("#hides").append('<input type="hidden" name="hides[]" value="' + $(this).val() + '">');
                $("#rejects").append('<input type="hidden" name="rejects[]" value="' + $(this).val() + '">');
            } else {
                var check = $(this).val();
                $('[name="shows[]"]').each(function() {
                    if ($(this).val() == check) {
                        $(this).remove();
                    }
                });
                $('[name="hides[]"]').each(function() {
                    if ($(this).val() == check) {
                        $(this).remove();
                    }
                });
                $('[name="rejects[]"]').each(function() {
                    if ($(this).val() == check) {
                        $(this).remove();
                    }
                });
                if ($('[name="check[]"]').filter(":checked").length == 0) {
                    $("#deletebutton").prop("disabled", true);
                    $("#showbutton").prop("disabled", true);
                    $("#hidebutton").prop("disabled", true);
                    $("#rejectbutton").prop("disabled", true);
                }
            }
            if ($('[name="check[]"]').length !== $('[name="check[]"]').filter(":checked").length) {
                $(".select-all").prop('checked', false);
                $(".alls").val('0');
            }
        });
        $('#deletebutton').click(function() {
            return confirm('Anda Yakin hapus data ? ');
        });
        $('#selectToggle').change(function() {
            $('.toggle-status').val($(this).val());
        });
    </script>

    @if(Session::get('message') == 'update')
    <script type="text/javascript">
        swal.fire({
            title: "Good Job!",
            text: "Your Data Has Been Updated!",
            type: "success",
            icon: 'success',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'error')
    <script type="text/javascript">
        swal.fire({
            title: "Error 404 Not Found!",
            text: "Data is Broke!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'insert')
    <script type="text/javascript">
        swal.fire({
            title: "Good Job!",
            text: "Your Data Has Been Inserted!",
            type: "success",
            icon: 'success',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'data_ada')
    <script type="text/javascript">
        swal.fire({
            title: "Sorry!",
            text: "Your Input Email/Username is Available on Database, Please Input Some Else!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'password_sama')
    <script type="text/javascript">
        swal.fire({
            title: "Sorry!",
            text: "Your Input Password Not Same with Input Confirm Password, Please Try Again!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'delete')
    <script type="text/javascript">
        swal.fire({
            title: "Deleted!",
            text: "Your Data Has Been Deleted!",
            type: "success",
            icon: 'success',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'login1')
    <script type="text/javascript">
        swal.fire({
            title: "Login Gagal",
            text: "Email tidak ditemukan",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'login2')
    <script type="text/javascript">
        swal.fire({
            title: "Login Gagal",
            text: "Password salah",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'empty')
    <script type="text/javascript">
        swal.fire({
            title: "Data Empty",
            text: " Data Yang Anda Cari Tidak Ada",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
    @elseif(Session::get('message') == 'prohibited')
    <script type="text/javascript">
        swal.fire({
            title: "Akses Ditolak",
            text: "Anda Tidak Diizinkan Mengakses Modul Ini",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
@elseif(Session::get('message') == 'OverDenied')
    <script type="text/javascript">
        swal.fire({
            title: "Akses Ditolak",
            text: "Anda Tidak Diizinkan Mengajukan Lembur Di Hari Yang Sama!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
        
    </script>
    @elseif(Session::get('message') == 'reimburseOver')
    <script type="text/javascript">
        swal.fire({
            title: "Akses Ditolak",
            text: "Anda Tidak Diizinkan Mengajukan Reimburse! Silahkan Cek Sisa Reimburse!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
        
    </script>
    @elseif(Session::get('message') == 'leaveOver')
    <script type="text/javascript">
        swal.fire({
            title: "Akses Ditolak",
            text: "Anda Tidak Diizinkan Mengajukan Cuti! Silahkan Cek Sisa Cuti!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
        
    </script>
@endif
  </body>
</html>