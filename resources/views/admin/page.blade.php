@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-halaman.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#importModal"><i class="demo-pli-cross"></i> Import</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <br>
                @if($filter_status == 0)
                <form class="form-inline" action="{{ route('tblPage.filter') }}" method="get">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input name="search" class="form-control" placeholder="Pencarian Halaman">
                        </select>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <button class="btn btn-success form-control" type="submit">Search</button>
                    </div>
                </form>
                @else
                <form class="form-inline" action="{{ route('tblPage.filter') }}" method="get">
                    {{ csrf_field() }}

                    <div class="form-group">
                    <input name="search" class="form-control" value="{{$search}}" placeholder="Pencarian Halaman">
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <button class="btn btn-success form-control" type="submit">Search</button>
                    </div>
                </form>
                @endif
                <br>
                <div class="table-responsive">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th data-field="check"><input type="checkbox" class="select-all"></th>
                                <th data-field="no" data-sortable="true">No</th>
                                <th data-field="surah_start" data-sortable="true">Surah Awal</th>
                                <th data-field="verse_start" data-sortable="true">Ayat Awal</th>
                                <th data-field="surah_end" data-sortable="true">Surah Akhir</th>
                                <th data-field="verse_end" data-sortable="true">Ayat Akhir</th>
                                <th data-field="page" data-sortable="true">Halaman</th>
                                <th data-field="image" data-sortable="true">Gambar</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->surahStart->name }}</td>
                                <td>{{ $value->verseStart->verse_index }}</td>
                                <td>{{ $value->surahEnd->name }}</td>
                                <td>{{ $value->verseEnd->verse_index }}</td>
                                <td>{{ $value->page }}</td>
                                <td>
                                <img src="{{ asset('/images/halaman/'.$value->image) }}" style="height: 100px; width: 100px;" />
                                    <!-- <form action="{{ route('data-halaman.image') }}" method="post" enctype="multipart/form-data" id="form-upload">
                                        {{ csrf_field() }}
                                        <input class="form-control" type="file" name="image" id="file-upload" accept="image/*" required>
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <br>

                                        <button type="submit" name="submit" class="btn btn-primary btn-sm btn-rounded ">Submit</button>

                                    </form> -->
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
            <form action="{{ route('data-halaman.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
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
                            <label>Surah Awal</label>
                            <input type="text" class="form-control" placeholder="Cari Surah Awal" id="values1" onchange="checkcombo('loading1', 'values1', 'combobox1', '{{ route('tblSurah.json2') }}')">
                            <select class="form-control" name="surah_start_index" id="combobox1" onchange="checkcombo('loading2', 'combobox1', 'combobox2', '{{ route('tblVerse.json2') }}')" required>
                                <option value="">Surah Awal</option>
                            </select>
                            <div id="loading1" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Ayat Awal</label>
                            <select class="form-control" name="verse_start_index" id="combobox2" required>
                                <option value="">Pilih Ayat Awal</option>
                            </select>
                            <div id="loading2" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Surah Akhir</label>
                            <input type="text" class="form-control" placeholder="Cari Surah Akhir" id="values3" onchange="checkcombo('loading3', 'values3', 'combobox3', '{{ route('tblSurah.json2') }}')">
                            <select class="form-control" name="surah_end_index" id="combobox3" onchange="checkcombo('loading4', 'combobox3', 'combobox4', '{{ route('tblVerse.json2') }}')" required>
                                <option value="">Surah Akhir</option>
                            </select>
                            <div id="loading3" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Ayat Akhir</label>
                            <select class="form-control" name="verse_end_index" id="combobox4" required>
                                <option value="">Pilih Ayat Akhir</option>
                            </select>
                            <div id="loading4" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Halaman</label>
                            <input type="number" name="page" class="form-control" placeholder="Masukkan Halaman" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Gambar</label><br>
                            <input type="file" name="image" class="form-control" required>
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
                                    <td>Surah Awal</td>
                                    <td>:</td>
                                    <td>
                                        <div id="surah_start_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ayat Awal</td>
                                    <td>:</td>
                                    <td>
                                        <div id="verse_start_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Surah Akhir</td>
                                    <td>:</td>
                                    <td>
                                        <div id="surah_end_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ayat Akhir</td>
                                    <td>:</td>
                                    <td>
                                        <div id="verse_end_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Halaman</td>
                                    <td>:</td>
                                    <td>
                                        <div id="page_view"></div>
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
                                    <label>Surah Awal</label>
                                    <input type="text" class="form-control" placeholder="Cari Surah Awal" id="values5" onchange="checkcombo('loading5', 'values5', 'surah_start_index', '{{ route('tblSurah.json2') }}')">
                                    <select class="form-control" name="surah_start_index" id="surah_start_index" onchange="checkcombo('loading6', 'surah_start_index', 'verse_start_index', '{{ route('tblVerse.json2') }}')" required>
                                        <option value="">Surah Awal</option>
                                    </select>
                                    <div id="loading5" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Ayat Awal</label>
                                    <select class="form-control" name="verse_start_index" id="verse_start_index" required>
                                        <option value="">Pilih Ayat Awal</option>
                                    </select>
                                    <div id="loading6" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Surah Akhir</label>
                                    <input type="text" class="form-control" placeholder="Cari Surah Akhir" id="values4" onchange="checkcombo('loading7', 'values4', 'surah_end_index', '{{ route('tblSurah.json2') }}')">
                                    <select class="form-control" name="surah_end_index" id="surah_end_index" onchange="checkcombo('loading8', 'surah_end_index', 'verse_end_index', '{{ route('tblVerse.json2') }}')" required>
                                        <option value="">Surah Akhir</option>
                                    </select>
                                    <div id="loading7" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Ayat Akhir</label>
                                    <select class="form-control" name="verse_end_index" id="verse_end_index" required>
                                        <option value="">Pilih Ayat Akhir</option>
                                    </select>
                                    <div id="loading8" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Halaman</label>
                                    <input type="number" name="page" id="page" class="form-control" placeholder="Masukkan Halaman" required>
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
<!-- Import Modal -->
<div class="modal fade" id="importModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Import Halaman</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <br>
                <p><b>Tata Cara Import data Halaman</b> </p>
                <ol>
                    <li>Download template data import dengan klik tombol Export <a href="{{ route('tblPage.templateExport') }}" class="btn btn-success btn-sm"><span class="demo-pli-file-excel"></span>Export</a> </li>
                    <li>Buka file template yang telah di download </li>
                    <li>Kemudian isi data template</li>
                    <img src="{{ asset('assets/images/import/page-1.png')}}" style="width:450px;">
                    <br> <br>
                    <p><b>Keterangan Data Template</b> </p>
                    <ol type="a">
                        <li>Surah_start_index adalah <b>Index surah untuk awal surah pada halaman</b></li>
                        <img src="{{ asset('assets/images/import/page-2.png')}}" style="width:350px;">
                        <li>Verse_start_index adalah <b>index ayat untuk awal ayat pada halaman </b></li>
                        <img src="{{ asset('assets/images/import/page-3.png')}}" style="width:350px;">
                        <li>Surah_end_index adalah <b>index ayat untuk akhir ayat pada halaman </b></li>
                        <img src="{{ asset('assets/images/import/page-4.png')}}" style="width:350px;">
                        <li>page adalah <b>Urutan Halaman </b></li>
                        <img src="{{ asset('assets/images/import/page-5.png')}}" style="width:350px;">
                        <li>Surah_end_index adalah <b>index ayat untuk akhir ayat pada halaman </b></li>
                        <img src="{{ asset('assets/images/import/page-6.png')}}" style="width:350px;">
                        <li>image adalah <b>Link Gambar </b></li>
                        <img src="{{ asset('assets/images/import/page-7.png')}}" style="width:350px;">

                    </ol>
                    <li>Upload data template Pada Import Data Berikut:</li>
                </ol>
                <p></p>
            </div>

            <form action="{{ route('tblPage.import') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="importform">
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
            var r = "{{ route('data-halaman.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-halaman.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $("#surah_start_index").append(new Option(data.surah_start, data.surah_start_index)).val(data.surah_start_index);
                    $("#verse_start_index").append(new Option(data.verse_start_index, data.verse_start_index)).val(data.verse_start_index);
                    $("#surah_end_index").append(new Option(data.surah_end, data.surah_end_index)).val(data.surah_end_index);
                    $("#verse_end_index").append(new Option(data.verse_end_index, data.verse_end_index)).val(data.verse_end_index);
                    $('#page').val(data.page);
                    document.getElementById('surah_start_view').innerHTML = data.surah_start;
                    document.getElementById('verse_start_view').innerHTML = data.verse_start_index;
                    document.getElementById('surah_end_view').innerHTML = data.surah_end;
                    document.getElementById('verse_end_view').innerHTML = data.verse_end_index;
                    document.getElementById('page_view').innerHTML = data.page;
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