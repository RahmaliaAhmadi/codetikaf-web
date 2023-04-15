@extends('layouts.layout')
@section('title','Data Audio')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h5>Data Audio Ayat</h5>
            <br>
                <form action="{{ route('data-audio.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#importModal"><i class="demo-pli-cross"></i> Import</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <br>
                <div class="table-responsive">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th data-field="check"><input type="checkbox" class="select-all"></th>
                                <th data-field="no" data-sortable="true">No</th>
                                <th data-field="reciter_id" data-sortable="true">Qori</th>
                                <th data-field="surah_index" data-sortable="true">Surah</th>
                                <th data-field="verse_index" data-sortable="true">Ayat</th>
                                <th data-field="link" data-sortable="true">Link</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->reciter->name }}</td>
                                <td>{{ $value->surah->name }}</td>
                                <td>{{ $value->verse->verse_index }}</td>
                                <td>{{ $value->link }}</td>
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
            <form action="{{ route('data-audio.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
                {{ csrf_field() }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                <div class="form-group">
                            <label>Surah </label>
                            <input type="text" class="form-control" placeholder="Cari Surah " id="values1" onchange="checkcombo('loading1', 'values1', 'combobox1', '{{ route('tblSurah.json2') }}')">
                            <select class="form-control" name="surah_index" id="combobox1" onchange="checkcombo('loading2', 'combobox1', 'combobox2', '{{ route('tblVerse.json2') }}')">
                                <option value="">Surah </option>
                            </select>
                            <div id="loading1" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ayat </label>
                            <select class="form-control" name="verse_index" id="combobox2">
                                <option value="">Pilih Ayat </option>
                            </select>
                            <div id="loading2" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Qori</label>
                            <select name="reciter_id" class="form-control">
                                <option value="">Pilih Nama Qori</option>
                                @foreach($reciter as $packages)
                                <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" require>
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
                                    <td>Nama Qori</td>
                                    <td>:</td>
                                    <td>
                                        <div id="reciter_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Surah</td>
                                    <td>:</td>
                                    <td>
                                        <div id="surah_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ayat</td>
                                    <td>:</td>
                                    <td>
                                        <div id="verse_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Link</td>
                                    <td>:</td>
                                    <td>
                                        <div id="link_view"></div>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="edit-data">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class=" form-group">
                                    <label>Surah </label>
                                    <input type="text" class="form-control" placeholder="Cari Surah" id="values5" onchange="checkcombo('loading5', 'values5', 'surah_index', '{{ route('tblSurah.json2') }}')">
                                    <select class="form-control" name="surah_index" id="surah_index" onchange="checkcombo('loading6', 'surah_index', 'verse_index', '{{ route('tblVerse.json2') }}')">
                                        <option value="">Surah </option>
                                    </select>
                                    <div id="loading5" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class=" form-group">
                                    <label>Ayat </label>
                                    <select class="form-control" name="verse_index" id="verse_index">
                                        <option value="">Pilih Ayat </option>
                                    </select>
                                    <div id="loading6" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Qori</label>
                                    <select name="reciter_id" class="form-control" id="reciter_id" >
                                        <option value="">Pilih Nama Qori</option>
                                        @foreach($reciter as $packages)
                                        <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link" id="link" class="form-control" require>
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
<!-- Import Modal -->
<div class="modal fade" id="importModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Import Audio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <br>
                <p><b>Tata Cara Import data Audio</b> </p>
                <ol>
                    <li>Download template data import dengan klik tombol Export <a href="{{ route('tblVerseAudio.templateExport') }}" class="btn btn-success btn-sm"><span class="demo-pli-file-excel"></span>Export</a> </li>
                    <li>Buka file template yang telah di download </li>
                    <li>Kemudian isi data template</li>
                    <img src="{{ asset('assets/images/import/audio-1.png')}}" style="width:450px;">
                    <br> <br>
                    <p><b>Keterangan Data Template</b> </p>
                    <ol type="a">
                        <li>Surah_index adalah <b>Index surah </b></li>
                        <img src="{{ asset('assets/images/import/audio-2.png')}}" style="width:350px;">
                        <li>Verse index adalah <b>index ayat </b></li>
                        <img src="{{ asset('assets/images/import/ayat-4.png')}}" style="width:350px;">
                        <li>Reciter_id adalah <b>ID Pada Data Qori</b></li>
                        <img src="{{ asset('assets/images/import/audio-4.png')}}" style="width:350px;">
                        <li>Link adalah <b>Link Audio </b></li>
                       
                    </ol>
                    <li>Upload data template Pada Import Data Berikut:</li>
                </ol>
                <p></p>
            </div>

            <form action="{{ route('tblVerseAudio.import') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="importform">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="file" name="file" accept=".ods" class="form-control" required>
                </div>

            </form>
            <!-- Modal footer -->
            <div class="modal-footer">

                <button id="importbutton" type="submit" class="btn btn-primary" form="importform">Import</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js-custom')

<script type="text/javascript">
    $('.loading').hide();
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');
            var r = "{{ url('/data-audio') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ url('/data-audio') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $("#reciter_id").val(data.reciter_id);
                    $("#surah_index").append(new Option(data.surah_name, data.surah_index)).val(data.surah_index);
                    $("#verse_index").append(new Option(data.verse_name, data.verse_index)).val(data.verse_index);
                    $('#link').val(data.link);
                    document.getElementById('reciter_view').innerHTML = data.reciter_name;
                    document.getElementById('surah_view').innerHTML = data.surah_name;
                    document.getElementById('verse_view').innerHTML = data.verse_name;
                    document.getElementById('link_view').innerHTML = data.link;
                    $('#edit-form').attr('action', route);
                }
            });
        });

    });
    function checkcombo(loading, values, combobox, route) { //ketika halaman sudah selesai di load
        //menyembunyikan loading
        //ketika user mengganti dan memilih data Guru
        $('#' + combobox).hide(); //sembunyikan combobox matpel
        $('#' + loading).show(); //memunculkan loading.gif
        $.ajax({
            type: "GET", //method pengiriman data bisa dengan GET atau POST
            url: route, //menuju URL function yang ada di course controller
            data: {
                value: $('#' + values).val()
            }, //data yang akan dikirim ke file yg dituju
            dataType: "json",
            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response) { //ketika proses pengiriman berhasil
                setTimeout(function() {
                    $('#' + loading).hide(); //sembunyikan loading

                    //set isi dengan combobox kota
                    //lalu munculkan kembali combobox kotanya
                    $('#' + combobox).html(response.list_data).show();
                }, 3000);
            },
            error: function(xhr, ajaxOptions, thrownError) { //ketika ada error
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); //munculkan alert error
            }
        });
    };
   
</script>
@endsection