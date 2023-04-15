<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>@yield('title')</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css')}}">
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

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" style="width: 210px;" href="index.html"><img src="{{ asset('assets/images/langkahnyatalogo.png')}}" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-date dropdown">
            <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
              <h6 class="date mb-0">Today : Mar 23</h6>
              <i class="typcn typcn-calendar"></i>
            </a>
          </li>

          <li class="nav-item dropdown mr-0">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="typcn typcn-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" href="{{ url('/logout') }}">
              <i class="typcn typcn-power-outline"></i>

            </a>

          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">

  </div>
  @yield('nav')
  </nav>
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->

    <div id="right-sidebar" class="settings-panel">
      <i class="settings-close typcn typcn-times"></i>
      <ul class="nav nav-tabs" id="setting-panel" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
        </li>
      </ul>
      <div class="tab-content" id="setting-content">
        <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
          <div class="add-items d-flex px-3 mb-0">
            <form class="form w-100">
              <div class="form-group d-flex">
                <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
              </div>
            </form>
          </div>
          <div class="list-wrapper px-3">
            <ul class="d-flex flex-column-reverse todo-list">
              <li>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox">
                    Team review meeting at 3.00 PM
                  </label>
                </div>
                <i class="remove typcn typcn-delete-outline"></i>
              </li>
              <li>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox">
                    Prepare for presentation
                  </label>
                </div>
                <i class="remove typcn typcn-delete-outline"></i>
              </li>
              <li>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox">
                    Resolve all the low priority tickets due today
                  </label>
                </div>
                <i class="remove typcn typcn-delete-outline"></i>
              </li>
              <li class="completed">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox" checked>
                    Schedule meeting for next week
                  </label>
                </div>
                <i class="remove typcn typcn-delete-outline"></i>
              </li>
              <li class="completed">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox" checked>
                    Project review
                  </label>
                </div>
                <i class="remove typcn typcn-delete-outline"></i>
              </li>
            </ul>
          </div>
          <div class="events py-4 border-bottom px-3">
            <div class="wrapper d-flex mb-2">
              <i class="typcn typcn-media-record-outline text-primary mr-2"></i>
              <span>Feb 11 2018</span>
            </div>
            <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
            <p class="text-gray mb-0">build a js based app</p>
          </div>
          <div class="events pt-4 px-3">
            <div class="wrapper d-flex mb-2">
              <i class="typcn typcn-media-record-outline text-primary mr-2"></i>
              <span>Feb 7 2018</span>
            </div>
            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
            <p class="text-gray mb-0 ">Call Sarah Graves</p>
          </div>
        </div>
        <!-- To do section tab ends -->
        <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
          <div class="d-flex align-items-center justify-content-between border-bottom">
            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
            <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
          </div>
          <ul class="chat-list">
            <li class="list active">
              <div class="profile"><img src="{{ asset('assets/images/faces/face1.jpg')}}" alt="image"><span class="online"></span></div>
              <div class="info">
                <p>Thomas Douglas</p>
                <p>Available</p>
              </div>
              <small class="text-muted my-auto">19 min</small>
            </li>
            <li class="list">
              <div class="profile"><img src="{{ asset('assets/images/faces/face2.jpg')}}" alt="image"><span class="offline"></span></div>
              <div class="info">
                <div class="wrapper d-flex">
                  <p>Catherine</p>
                </div>
                <p>Away</p>
              </div>
              <div class="badge badge-success badge-pill my-auto mx-2">4</div>
              <small class="text-muted my-auto">23 min</small>
            </li>
            <li class="list">
              <div class="profile"><img src="{{ asset('assets/images/faces/face3.jpg')}}" alt="image"><span class="online"></span></div>
              <div class="info">
                <p>Daniel Russell</p>
                <p>Available</p>
              </div>
              <small class="text-muted my-auto">14 min</small>
            </li>
            <li class="list">
              <div class="profile"><img src="{{ asset('assets/images/faces/face4.jpg')}}" alt="image"><span class="offline"></span></div>
              <div class="info">
                <p>James Richardson</p>
                <p>Away</p>
              </div>
              <small class="text-muted my-auto">2 min</small>
            </li>
            <li class="list">
              <div class="profile"><img src="{{ asset('assets/images/faces/face5.jpg')}}" alt="image"><span class="online"></span></div>
              <div class="info">
                <p>Madeline Kennedy</p>
                <p>Available</p>
              </div>
              <small class="text-muted my-auto">5 min</small>
            </li>
            <li class="list">
              <div class="profile"><img src="{{ asset('assets/images/faces/face6.jpg')}}" alt="image"><span class="online"></span></div>
              <div class="info">
                <p>Sarah Graves</p>
                <p>Available</p>
              </div>
              <small class="text-muted my-auto">47 min</small>
            </li>
          </ul>
        </div>
        <!-- chat tab ends -->
      </div>
    </div>
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="typcn typcn-device-desktop menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <br>
        <li class="menu-header">Master Data</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/data-role') }}">
            <i class="typcn typcn-document-text menu-icon"></i>
            <span class="menu-title">Data Role</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="typcn typcn-group menu-icon"></i>


            <span class="menu-title">Data User</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">

              <li class="nav-item"> <a class="nav-link" href="{{ url('/data-admin') }}"> Admin</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('/data-user') }}"> Member</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="typcn typcn-download menu-icon"></i>
            <span class="menu-title">Data Informasi</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-faq') }}"> FAQ</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-syarat-ketentuan') }}"> Syarat & Ketentuan</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-campign') }}"> Campign</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-kontak') }}"> Kontak Kami</a></li>
            </ul>
          </div>
        </li>
        <br>
        <li class="menu-header">Qur'an</li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#form-quran" aria-expanded="false" aria-controls="form-quran">
            <i class="typcn typcn-book menu-icon"></i>
            <span class="menu-title">Data Qur'an</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-quran">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-juz') }}">Juz</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-surah') }}">Surah</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-ayat') }}"> Ayat</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-halaman') }}">Halaman</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#form-tafsir" aria-expanded="false" aria-controls="form-tafsir">
            <i class="typcn typcn-clipboard menu-icon"></i>
            <span class="menu-title">Data Tafsir</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-tafsir">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-info-tafsir') }}">Info Tafsir</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-tafsir') }}">Tafsir</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#form-audio" aria-expanded="false" aria-controls="form-audio">
            <i class="typcn typcn-microphone menu-icon"></i>
            <span class="menu-title">Data Qori</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-audio">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-qori') }}">Qori</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/data-audio') }}">Audio</a></li>
            </ul>
          </div>
        </li>
        <br>
        <li class="menu-header">Kajian</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/data-tema') }}">
            <i class="typcn typcn-mortar-board menu-icon"></i>
            <span class="menu-title">Data Tema</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/data-kajian') }}">
            <i class="typcn typcn-social-youtube menu-icon"></i>
            <span class="menu-title">Data Kajian</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">

      @yield('content')
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="card">
          <div class="card-body">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Langkah Nyata | V.01</span>
            </div>
          </div>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- JS Libraies -->
  <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- base:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('assets/js/template.js')}}"></script>
  <script src="{{ asset('assets/js/settings.js')}}"></script>
  <script src="{{ asset('assets/js/todolist.js')}}"></script>
  <!-- endinject -->
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
      text: "Data Berhasil diperbaharui !",
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
      text: "Data Berhasil Di Tambahkan!",
      type: "success",
      icon: 'success',
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    });
  </script>
  @elseif(Session::get('message') == 'duplicate')
  <script type="text/javascript">
    swal.fire({
      title: "Sorry!",
      text: "Maaf Data Dupilcate! Silahkan Cek Kembali",
      type: "warning",
      icon: 'warning',
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    });
  </script>
  @elseif(Session::get('message') == 'denied')
  <script type="text/javascript">
    swal.fire({
      title: "Sorry!",
      text: "Maaf Data Akses Ditolak!",
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
      text: "Data Telah Berhasil Di Hapus!",
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
 @elseif(Session::get('message') == 'dataEmpty')
  <script type="text/javascript">
    swal.fire({
      title: "Data Kosong",
      text: "Harap Menginputkan Data Pada Form",
      type: "warning",
      icon: 'warning',
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    });
  </script>
  @endif
</body>

</html>