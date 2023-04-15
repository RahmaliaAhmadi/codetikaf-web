<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Admin</title>
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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{ asset('assets/images/langkahnyatalogo.png')}}"  style="width: 160px;" alt="logo">
              </div>
              <h5>Web Admin | Langkah Nyata</h5>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form action="{{ url('/login') }}" method="Post" id="loginform">
              {{ csrf_field() }}
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg"  placeholder="email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg"  placeholder="Password">
                </div>
                <div class="mt-3">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('assets/js/template.js')}}"></script>
  <script src="{{ asset('assets/js/settings.js')}}"></script>
  <script src="{{ asset('assets/js/todolist.js')}}"></script>
  <!-- endinject -->
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
 @elseif(Session::get('message') == 'denied')
    <script type="text/javascript">
        swal.fire({
            title: "Sorry!",
            text: "Maaf Akses Ditolak!",
            type: "warning",
            icon: 'warning',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        });
    </script>
@endif
</body>

</html>
