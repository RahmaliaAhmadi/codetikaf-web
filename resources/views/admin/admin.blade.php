@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-admin.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <br>
                <div class="table-responsive">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th data-field="check"><input type="checkbox" class="select-all"></th>
                                <th data-field="no" data-sortable="true">No</th>
                                <th data-field="role" data-sortable="true">role</th>
                                <th data-field="name" data-sortable="true">Nama</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="phone" data-sortable="true">No Hp</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->role->name }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>

                                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-target="#editModal" data-toggle="modal" data-id="{{ $value->id }}" title="Edit Data">
                                        <i class="typcn typcn-pencil"></i>
                                    </button>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center float-right">{{ $data->links('pagination::bootstrap-4') }}</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- The Modal Store -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('data-admin.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
                {{ csrf_field() }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Tipe</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">Pilih Role</option>
                                @foreach($role as $roles)
                                <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>No Hp</label>
                            <input type="text" name="phone" class="form-control" placeholder="Masukkan No Hp" required>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off" id="edit-form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#detail-data" role="tab" data-toggle="tab">Detail Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#edit-data" role="tab" data-toggle="tab">Edit Data</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="detail-data">
                            <table class="table">

                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>
                                        <div id="role_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <div id="name_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>
                                        <div id="email_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Hp</td>
                                    <td>:</td>
                                    <td>
                                        <div id="phone_view"></div>
                                    </td>
                                </tr>


                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="edit-data">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label>Role</label>
                                        <select name="role_id" id="role_id" class="form-control" required>
                                            <option value="">Pilih Role</option>
                                            @foreach($role as $roles)
                                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama" required>
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                                    </div>

                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label>No Hp</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan No Hp" required>
                                    </div>
                                    <div class="col-md-12 col-xs-12 form-group">
                                        <input type="checkbox" name="checkpass" value="1" id="checkpass"><label>Ceklis bila ingin mengganti password</label>
                                        <div class="col-md-12 col-xs-12 form-group" id="cpassword"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js-custom')

<script type="text/javascript">
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');
            var r = "{{ route('data-admin.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-admin.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#role_id').val(data.role_id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                    $('#phone').val(data.phone);
                    document.getElementById('role_view').innerHTML = data.role_name;
                    document.getElementById('name_view').innerHTML = data.name;
                    document.getElementById('email_view').innerHTML = data.email;
                    document.getElementById('phone_view').innerHTML = data.phone;
                    $('#edit-form').attr('action', route);
                }
            });
        });

    });

    $('#checkpass').change(function() {
        if ($(this).is(':checked')) {
            $("#cpassword").append('<label>Password</label>\n' +
                '<input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Masukkan Password">');
        } else {
            $("#cpassword").html("");
        }
    });
</script>
@endsection