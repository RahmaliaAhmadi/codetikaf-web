@extends('layouts.layout')
@section('title','Data Kajian')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if($filter_status == 0)
                <form class="form-inline" action="{{ route('data-kajian.filter') }}" method="get">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control" name="selectinput">
                            <option value="">Filter By Tema</option>
                            @foreach($package as $packages)
                            <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                            @endforeach
                        </select>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <select class="form-control" name="sortinput">
                            <option value="">Status Rekomendasi</option>
                            <option value="f">Tidak Direkomendasikan</option>
                            <option value="t">Direkomendasikan</option>
                        </select>
                    </div>&nbsp;&nbsp;
                    <input type="hidden" name="tipe" value="{{ $filter }}">
                    <div class="form-group">
                        <button class="btn btn-info form-control" type="submit">Filter</button>
                    </div>
                </form>
                @else
                <form class="form-inline" action="{{ route('data-kajian.filter') }}" method="get">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <select class="form-control" name="selectinput">
                            <option value="">Filter By Kategori</option>
                            @foreach($package as $packages)
                            @if($filters[0] == $packages->id)
                            <option value="{{ $packages->id }}" selected>{{ $packages->name }}</option>
                            @else
                            <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <select class="form-control" name="sortinput">
                            @if($filters[1] == '')
                            <option value="" selected>Filter By Status Rekomendasi</option>
                            <option value="f">Tidak Direkomendasikan</option>
                            <option value="t">Direkomendasikan</option>
                            @elseif($filters[1] == 'f')
                            <option value="">Filter By Status Rekomendasi</option>
                            <option value="f" selected>Tidak Direkomendasikan</option>
                            <option value="t">Direkomendasikan</option>
                            @else
                            <option value="">Filter By Status Rekomendasi</option>
                            <option value="f">Tidak Direkomendasikan</option>
                            <option value="t" selected>Direkomendasikan</option>
                            @endif
                        </select>
                    </div>&nbsp;&nbsp;
                    <input type="hidden" name="tipe" value="{{ $filter }}">
                    <div class="form-group">
                        <button class="btn btn-info form-control" type="submit">Filter</button>
                    </div>
                </form>
                @endif
                <br>
                <form action="{{ route('data-kajian.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
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
                                <th data-field="category" data-sortable="true">Tema</th>
                                <th data-field="title" data-sortable="true">Judul</th>
                                <th data-field="speaker" data-sortable="true">Pembicara</th>
                                <th data-field="poster_vertical" data-sortable="true">Poster Vertikal</th>
                                <th data-field="poster_horizontal" data-sortable="true">Poster Horizontal</th>
                                <th data-field="is_recommended" data-sortable="true">Status Rekomendasi</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->speaker }}</td>
                                <td>
                                    <img src="{{ asset('/images/kajian/'.$value->poster_vertical) }}" style="height: 100px; width: 100px;" />
                                    <form action="{{ route('data-kajian.imageVertical') }}" method="post" enctype="multipart/form-data" id="form-upload">
                                        {{ csrf_field() }}
                                        <input class="form-control" type="file" name="poster_vertical" id="file-upload" accept="image/*" required>
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <br>
                                        <center>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm btn-rounded ">Submit</button>
                                        </center>
                                    </form>
                                </td>
                                <td>
                                    <img src="{{ asset('/images/kajian/'.$value->poster_horizontal) }}" style="height: 100px; width: 100px;" />
                                    <form action="{{ route('data-kajian.image') }}" method="post" enctype="multipart/form-data" id="form-upload">
                                        {{ csrf_field() }}
                                        <input class="form-control" type="file" name="poster_horizontal" id="file-upload" accept="image/*" required>
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <br>
                                        <center>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm btn-rounded ">Submit</button>
                                        </center>
                                    </form>
                                </td>
                                <td> @if($value->is_recommended == 0)
                                    <div class="badge badge-warning">Tidak Direkomendasikan</div>
                                    @else
                                    <div class="badge badge-success">Direkomendasikan</div>
                                    @endif
                                </td>

                                <td>

                                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-target="#editModal" data-toggle="modal" data-id="{{ $value->id }}" title="Edit Data">
                                        <i class="typcn typcn-pencil"></i>
                                    </button>
                                    @if($value->is_recommended == 1)
                                    <button type="submit" class="btn btn-warning btn-sm btn-rounded " form='hideToggle'>
                                        <i class="typcn typcn-delete"></i>Nonaktifkan
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-success btn-sm btn-rounded " form='showToggle'>
                                        <i class="typcn typcn-tick"></i>Aktifkan
                                    </button>

                                    @endif
                                    <form action="{{ route('togglesShow') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="showToggle">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <input type="hidden" name="table" value="{{ $table }}">
                                        <input type="hidden" name="toggle" value="{{ $toggle1 }}">
                                        <input type="hidden" name="shows" value="{{ $value->id }}">
                                    </form>
                                    <form action="{{ route('togglesHide') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="hideToggle">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <input type="hidden" name="table" value="{{ $table }}">
                                        <input type="hidden" name="toggle" value="{{ $toggle1 }}">
                                        <input type="hidden" name="hides" value="{{ $value->id }}">
                                    </form>
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
            <form action="{{ route('data-kajian.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
                {{ csrf_field() }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12 col-xs-12 form-group">
                            <label>Tema Kajian</label>
                            <select class="form-control" name="category_id" required>
                                <option value="">- Pilih Tema kajian -</option>
                                @foreach($package as $packages)
                                <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukkan Judul" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Pembicara</label>
                            <input type="text" name="speaker" class="form-control" placeholder="Masukkan Nama Pembicara" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Url Youtube</label>
                            <input type="text" name="url_youtube" class="form-control" placeholder="Masukkan Url Youtube" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Status Rekomendasi</label>
                            <select class="form-control" name="is_recommended" required>
                                <option value="">- Pilih Status Rekomendasi -</option>
                                <option value="1">Direkomendasikan</option>
                                <option value="0">Tidak Direkomendasikan</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Poster Vertikal</label><br>
                            <input type="file" name="poster_vertical" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Poster Horizontal</label><br>
                            <input type="file" name="poster_horizontal" class="form-control" required>
                        </div>
                     
                        <div class="col-md-12 col-xs-12 form-group">
                            <label>Deskripsi</label>
                            <textarea type="text" name="description" id="description2" rows="5" class="form-control" required></textarea>
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
                                    <td>Tema Kajian</td>
                                    <td>:</td>
                                    <td>
                                        <div id="category_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Judul Kajian</td>
                                    <td>:</td>
                                    <td>
                                        <div id="title_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pembicara</td>
                                    <td>:</td>
                                    <td>
                                        <div id="speaker_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Url Youtube</td>
                                    <td>:</td>
                                    <td>
                                        <div id="url_youtube_view"></div>
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
                                    <td>Status Rekomendasi</td>
                                    <td>:</td>
                                    <td>
                                        <div id="is_recommended_view"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="edit-data">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="row">

                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Tema Kajian</label>
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        <option value="">- Pilih Tema kajian -</option>
                                        @foreach($package as $packages)
                                        <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Judul</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Pembicara</label>
                                    <input type="text" name="speaker" id="speaker" class="form-control" placeholder="Masukkan Nama Pembicara" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Url Youtube</label>
                                    <input type="text" name="url_youtube" id="url_youtube" class="form-control" placeholder="Masukkan Url Youtube" required>
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
            var r = "{{ route('data-kajian.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-kajian.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#category_id').val(data.category_id);
                    $('#title').val(data.title);
                    $('#url_youtube').val(data.url_youtube);
                    $('#description').val(data.description);
                    CKEDITOR.replace(description, {
                        language: 'en-gb',
                        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form',
                        allowedContent: true
                    });
                    $('#speaker').val(data.speaker);
                    document.getElementById('category_view').innerHTML = data.category_name;
                    document.getElementById('title_view').innerHTML = data.title;
                    document.getElementById('speaker_view').innerHTML = data.speaker;
                    document.getElementById('description_view').innerHTML = data.description;
                    document.getElementById('url_youtube_view').innerHTML = data.url_youtube;
                    var is_recommended;
                    if (data.is_recommended == 0) {
                        is_recommended = "Tidak Direkomendasikan"
                    } else {
                        is_recommended = "Direkomendasikan"
                    }
                    document.getElementById('is_recommended_view').innerHTML = is_recommended;
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