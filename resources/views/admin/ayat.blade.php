@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-ayat.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#importModal"><i class="demo-pli-cross"></i> Import</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <br>
                @if($filter_status == 0)
                <form class="form-inline" action="{{ route('tblVerse.filter') }}" method="get">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="surah" class="form-control" placeholder="Surat" required>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <input type="number" name="ayat" class="form-control" placeholder="Ayat (Optional) ">
                    </div>&nbsp;&nbsp;
                    <input type="hidden" name="tipe" value="{{ $search }}">
                    <div class="form-group">
                        <button class="btn btn-success form-control" type="submit">Search</button>
                    </div>
                </form>
                @else
                <form class="form-inline" action="{{ route('tblVerse.filter') }}" method="get">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" name="surah" value="{{$searchs[0]}}" class="form-control" placeholder="Surat" required>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <input type="number" name="ayat" value="{{$searchs[1]}}" class="form-control" placeholder="Ayat (Optional) ">
                    </div>&nbsp;&nbsp;
                    <input type="hidden" name="tipe" value="{{ $search }}">
                    <div class="form-group">
                        <button class="btn btn-success form-control" type="submit">Search</button>
                    </div>
                </form>
                @endif
                <br>
                <div class="table-responsive">

                    <table class="table sortable-table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th data-field="check"><input type="checkbox" class="select-all"></th>
                                <th data-field="no" data-sortable="true">No</th>
                                <th data-field="surah_id" data-sortable="true">Juz</th>
                                <th data-field="index_section" data-sortable="true">Surah</th>
                                <th data-field="verse_index" data-sortable="true">Index</th>
                                <th data-field="content_indopak" data-sortable="true">Ayat Indopak</th>
                                <th data-field="content_utsmani" data-sortable="true">Ayat Utsmani</th>
                                <th data-field="latin" data-sortable="true">Latin</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td class="block">{{ $no++ }}</td>
                                <td class="block">{{ $value->section->section_index }}</td>
                                <td class="block">{{ $value->surah->name }}</td>
                                <td class="block">{{ $value->verse_index }}</td>
                                <td class="block">{{ $value->content_indopak }}</td>
                                <td class="block">{{ $value->content_utsmani }}</td>
                                <td class="block">{!! $value->latin !!}</td>
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
            <form action="{{ route('data-ayat.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
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
                            <label>Juz</label>
                            <select name="index_section" class="form-control" id="section" onchange="checkcombo('loading1', 'section', 'surah', '{{ route('tblSurah.json') }}')" required>
                                <option value="">Pilih Juz</option>
                                @foreach($package as $packages)
                                <option value="{{ $packages->section_index }}">{{ $packages->section_index }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Surah</label>
                            <select name="surah_id" class="form-control" id="surah" required> 
                                <option value="">- Pilih Surah -</option>
                            </select>
                            <div id="loading1" class="loading">
                                <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 form-group">
                            <label>Index</label>
                            <input type="number" name="index" min="1" max="6666" class="form-control" placeholder="Masukkan Index" required>
                        </div>

                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Ayat Indopak</label>
                            <textarea type="text" name="content_indopak" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Ayat Utsmani</label>
                            <textarea type="text" name="content_utsmani" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Latin</label>
                            <textarea type="text" name="latin" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Terjemahan</label>
                            <textarea type="text" name="translation" rows="5" class="form-control" required></textarea>
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
                                    <td>Surah</td>
                                    <td>:</td>
                                    <td>
                                        <div id="surah_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Index</td>
                                    <td>:</td>
                                    <td>
                                        <div id="index_view"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Ayat Indopak</td>
                                    <td>:</td>
                                    <td>
                                        <div id="content_indopak_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ayat Utsmani</td>
                                    <td>:</td>
                                    <td>
                                        <div id="content_utsmani_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Latin</td>
                                    <td>:</td>
                                    <td>
                                        <div id="latin_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Terjemahan</td>
                                    <td>:</td>
                                    <td>
                                        <div id="translation_view"></div>
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
                                    <label>Juz</label>
                                    <select name="index_section" class="form-control" id="index_section" onchange="checkcombo('loading2', 'index_section', 'surah_id', '{{ route('tblSurah.json') }}')" required>
                                        <option value="">Pilih Juz</option>
                                        @foreach($package as $packages)
                                        <option value="{{ $packages->section_index }}">{{ $packages->section_index }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Surah</label>
                                    <select name="surah_id" class="form-control" id="surah_id" required>
                                        <option value="">- Pilih Surah -</option>
                                    </select>
                                    <div id="loading2" class="loading">
                                        <img src="{{ url('assets/images/loading.gif') }}"><small>Loading..</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Index</label>
                                    <input type="number" min="1" max="6666" name="index" id="index" class="form-control" placeholder="Masukkan Index" required>
                                </div>

                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Ayat Indopak</label>
                                    <textarea type="text" name="content_indopak" id="content_indopak" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Ayat Utsmani</label>
                                    <textarea type="text" name="content_utsmani" id="content_utsmani" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Latin</label>
                                    <textarea type="text" name="latin" id="latin" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Terjemahan</label>
                                    <textarea type="text" name="translation" id="translation" rows="5" class="form-control" required></textarea>
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
                <h4 class="modal-title">Import Ayat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <br>
                <p><b>Tata Cara Import data Ayat</b> </p>
                <ol>
                    <li>Download template data import dengan klik tombol Export <a href="{{ route('tblVerse.templateExport') }}" class="btn btn-success btn-sm"><span class="demo-pli-file-excel"></span>Export</a> </li>
                    <li>Buka file template yang telah di download </li>
                    <li>Kemudian isi data template</li>
                    <img src="{{ asset('assets/images/import/ayat-1.png')}}" style="width:450px;">
                    <br> <br>
                    <p><b>Keterangan Data Template</b> </p>
                    <ol type="a">
                        <li>Surah_id adalah <b>Urutan Index dari surah</b></li>
                        <img src="{{ asset('assets/images/import/ayat-2.png')}}" style="width:350px;">
                        <li>Index_section adalah <b>Urutan Index dari juz</b></li>
                        <img src="{{ asset('assets/images/import/ayat-3.png')}}" style="width:350px;">
                        <li>Indexadalah <b>Urutan Index dari Ayat</b></li>
                        <img src="{{ asset('assets/images/import/ayat-4.png')}}" style="width:350px;">
                        <li>Conten_Indopax  adalah <b>Lafadz Ayat Kategori Indopak</b> </li>
                        <li>Conten_Utsmani  adalah <b>Lafadz Ayat Kategori Utsmani</b> </li>
                        <li>Latin adalah <b>Penulisan Latin Dari Ayat Tersebut</b> </li>
                        <li>Translate adalah <b> Terjemahan Dari Ayat Tersebut</b> </li>
                    </ol>
                    <li>Upload data template Pada Import Data Berikut:</li>
                </ol>
                <p></p>
            </div>

            <form action="{{ route('tblVerse.import') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="importform">
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
            var r = "{{ route('data-ayat.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-ayat.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#index_section').val(data.index_section);
                    $("#surah_id").append(new Option(data.surah_name, data.surah_id)).val(data.surah_id);
                    $('#index').val(data.verse_index);
                    $('#content_indopak').val(data.content_indopak);
                    $('#content_utsmani').val(data.content_utsmani);
                    $('#latin').val(data.latin);
                    $('#translation').val(data.translation);
                    document.getElementById('surah_view').innerHTML = data.surah_name;
                    document.getElementById('index_view').innerHTML = data.verse_index;
                    document.getElementById('content_indopak_view').innerHTML = data.content_indopak;
                    document.getElementById('content_utsmani_view').innerHTML = data.content_utsmani;
                    document.getElementById('latin_view').innerHTML = data.latin;
                    document.getElementById('translation_view').innerHTML = data.translation;
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