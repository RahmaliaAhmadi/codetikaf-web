@extends('layouts.layout')
@section('title','Data-Campign')
@section('content')

<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-campign.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <form action="{{ route('togglesShow') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="showToggle">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" name="table" value="{{ $table }}">
                    <input type="hidden" name="toggle" value="{{ $toggle1 }}" class="toggle-status">
                    <input type="hidden" class="alls" name="alls" value="0">
                    <div class="form-group" id="shows">
                    </div>
                </form>
                <form action="{{ route('togglesHide') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="hideToggle">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" name="table" value="{{ $table }}">
                    <input type="hidden" name="toggle" value="{{ $toggle1 }}" class="toggle-status">
                    <input type="hidden" class="alls" name="alls" value="0">
                    <div class="form-group" id="hides">
                    </div>
                </form>
                <select class="btn btn-default" id="selectToggle">
                    <option value="{{ $toggle1 }}">Tampilkan</option>
                    <option value="{{ $toggle2 }}">Prioritaskan</option>
                </select>
                <button id="showbutton" class="btn btn-success" form='showToggle' type="submit"><span class="fa fa-check"></span>Aktif</button>
                <button id="hidebutton" class="btn btn-warning" form='hideToggle' type="submit"><span class="fa fa-times"></span>Tidak Aktif</button>

                <br>
                <div class="table-responsive">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th data-field="check"><input type="checkbox" class="select-all"></th>
                                <th data-field="no" data-sortable="true">No</th>
                                <th data-field="title" data-sortable="true">Judul</th>
                                <th data-field="link" data-sortable="true">Link</th>
                                <th data-field="image" data-sortable="true">Gambar</th>
                                <th data-field="is_show" data-sortable="true">Status</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->link }}</td>
                                <td>
                                    <img src="{{ asset('/images/campign/'.$value->image) }}" style="height: 100px; width: 100px;" />
                                    <form action="{{ route('data-campign.image') }}" method="post" enctype="multipart/form-data" id="form-upload">
                                        {{ csrf_field() }}
                                        <input class="form-control" type="file" name="image" id="file-upload" accept="image/*" required>
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <br>

                                        <button type="submit" name="submit" class="btn btn-primary btn-sm btn-rounded ">Submit</button>

                                    </form>
                                </td>
                                <td> @if($value->is_show == 0)
                                    <div class="badge badge-warning">Tidak Ditampilkan</div>
                                    @else
                                    <div class="badge badge-success">Ditampilkan</div>
                                    @endif
                                    <br>
                                    <br>
                                    @if($value->is_priority == 0)
                                    <div class="badge badge-warning">Tidak Diprioritaskan</div>
                                    @else
                                    <div class="badge badge-success">Diprioritaskan</div>
                                    @endif
                                </td>

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
            <form action="{{ route('data-campign.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
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
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukkan Judul" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" placeholder="Masukkan Link" required>
                        </div>
                        <div class="col-md-12 col-xs-12 form-group">
                            <label>Gambar</label><br>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="col-md-12 col-xs-12 form-group">
                            <label>Deskripsi</label>
                            <textarea type="text" name="description" id="description2" rows="5" class="form-control" required></textarea>
                        </div>

                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Status Tampilkan</label>
                            <select class="form-control" name="is_show" required>
                                <option value="">- Pilih Status Tampilkan -</option>
                                <option value="1">Ditampilkan</option>
                                <option value="0">Tidak Ditampilkan</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Status Prioritas</label>
                            <select class="form-control" name="is_recommended" required>
                                <option value="">- Pilih Status Prioritas -</option>
                                <option value="1">Diprioritaskan</option>
                                <option value="0">Tidak Diprioritaskan</option>
                            </select>
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
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td>
                                        <div id="title_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Link</td>
                                    <td>:</td>
                                    <td>
                                        <div id="link_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>:</td>
                                    <td>
                                        <div id="description_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Tampilkan</td>
                                    <td>:</td>
                                    <td>
                                        <div id="is_show_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Prioritas</td>
                                    <td>:</td>
                                    <td>
                                        <div id="is_priority_view"></div>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="edit-data">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Judul</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul" required>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Link</label>
                                    <input type="text" name="link" id="link" class="form-control" placeholder="Masukkan Link" required>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Deskripsi</label>
                                    <textarea type="text" name="description" id="description" rows="5" class="form-control" required></textarea>
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
            var r = "{{ route('data-campign.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-campign.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#link').val(data.link);
                    $('#description').val(data.description);
                    CKEDITOR.replace(description, {
                        language: 'en-gb',
                        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form',
                        allowedContent: true
                    });
                    document.getElementById('title_view').innerHTML = data.title;
                    document.getElementById('link_view').innerHTML = data.link;
                    document.getElementById('description_view').innerHTML = data.description;
                    var is_show;
                    if (data.is_show == 0) {
                        is_show = "Tidak Ditampilkan"
                    } else {
                        is_show = "Ditampilkan"
                    }
                    document.getElementById('is_show_view').innerHTML = is_show;
                    var is_priority;
                    if (data.is_priority == 0) {
                        is_priority = "Tidak Diprioritaskan"
                    } else {
                        is_priority = "Diprioritaskan"
                    }
                    document.getElementById('is_priority_view').innerHTML = is_priority;
                    $('#edit-form').attr('action', route);
                }
            });
        });

    });
    var content_qu = document.getElementById("description2");
    CKEDITOR.replace(description2, {
        language: 'en-gb',
        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
</script>
@endsection