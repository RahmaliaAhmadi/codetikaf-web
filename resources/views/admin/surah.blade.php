@extends('layouts.layout')
@section('title','Data Surah')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-surah.destroy','delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#importModal"><i class="demo-pli-cross"></i> Import</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <br>
                @if($filter_status == 0)
                <form class="form-inline" action="{{ route('tblSurah.filter') }}" method="get">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input name="search" class="form-control" placeholder="Pencarian Nama Surah">
                        </select>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <button class="btn btn-success form-control" type="submit">Search</button>
                    </div>
                </form>
                @else
                <form class="form-inline" action="{{ route('tblSurah.filter') }}" method="get">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input name="search" class="form-control" value="{{$search}}" placeholder="Pencarian Nama Surah">
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
                                <th data-field="section_id" data-sortable="true">Juz</th>
                                <th data-field="surah_index" data-sortable="true">Index</th>
                                <th data-field="name" data-sortable="true">Nama</th>
                                <th data-field="count_serve" data-sortable="true">Jumlah Ayat</th>
                                <th data-field="type" data-sortable="true">Type</th>
                                <th data-field="use_bismillah" data-sortable="true">Status Bismillah</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->section->section_index }}</td>
                                <td>{{ $value->surah_index }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->count_serve }}</td>
                                <td>{{ $value->type }}</td>
                                <td>@if($value->use_bismillah == 1)
                                    Menggunakan
                                    @else
                                    Tidak Menggunakan
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
            <form action="{{ route('data-surah.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
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
                            <select class="form-control" name="section_id" required>
                                <option value="">- Pilih Juz -</option>
                                @foreach($section as $sections)
                                <option value="{{ $sections->section_index }}">{{ $sections->section_index }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Index</label>
                            <input type="number" min="1" max="114" name="index" class="form-control" placeholder="Masukkan Index" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Nama Surah</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Surah" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Jumlah Ayat</label>
                            <input type="number" name="count_serve" class="form-control" placeholder="Masukkan Jumlah Ayat" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Tipe</label>
                            <select name="type" class="form-control" required>
                                <option value="">Pilih Tipe</option>
                                <option value="makiyah">Makiyah</option>
                                <option value="madaniyah">Madaniyah</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Lafadz</label>
                            <input type="text" name="lafadz" class="form-control" placeholder="Masukkan Lafadz" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Terjemah Surah</label>
                            <input type="text" name="translate_name" class="form-control" placeholder="Masukkan Terjemah Surah" required>
                        </div>
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Menggunakan Bismillah</label>
                            <select name="use_bismillah" class="form-control" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
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
                                    <td>Juz</td>
                                    <td>:</td>
                                    <td>
                                        <div id="section_view"></div>
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
                                    <td>Nama Surah</td>
                                    <td>:</td>
                                    <td>
                                        <div id="name_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jumlah Ayat</td>
                                    <td>:</td>
                                    <td>
                                        <div id="count_serve_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tipe</td>
                                    <td>:</td>
                                    <td>
                                        <div id="type_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lafadz</td>
                                    <td>:</td>
                                    <td>
                                        <div id="lafadz_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Terjemah Surah</td>
                                    <td>:</td>
                                    <td>
                                        <div id="translate_name_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Menggunakan Bismillah</td>
                                    <td>:</td>
                                    <td>
                                        <div id="use_bismillah_view"></div>
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
                                    <select class="form-control" name="section_id" id="section_id" required>
                                        <option value="">- Pilih Juz -</option>
                                        @foreach($section as $sections)
                                        <option value="{{ $sections->section_index }}">{{ $sections->section_index }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Index</label>
                                    <input type="number" min="1" max="114" name="index" id="index" class="form-control" placeholder="Masukkan Index" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Nama Surah</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Surah" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Jumlah Ayat</label>
                                    <input type="number" name="count_serve" id="count_serve" class="form-control" placeholder="Masukkan Jumlah Ayat" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Tipe</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="makiyah">Makiyah</option>
                                        <option value="madaniyah">Madaniyah</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Lafadz</label>
                                    <input type="text" name="lafadz" id="lafadz" class="form-control" placeholder="Masukkan Lafadz" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Terjemah Surah</label>
                                    <input type="text" name="translate_name" id="translate_name" class="form-control" placeholder="Masukkan Terjemah Surah" required>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <label>Menggunakan Bismillah</label>
                                    <select name="use_bismillah" id="use_bismillah" class="form-control" required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
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
                <h4 class="modal-title">Import Surah</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <br>
                <p><b>Tata Cara Import data Surah</b> </p>
                <ol>
                    <li>Download template data import dengan klik tombol Export <a href="{{ route('tblSurah.templateExport') }}" class="btn btn-success btn-sm"><span class="demo-pli-file-excel"></span>Export</a> </li>
                    <li>Buka file template yang telah di download </li>
                    <li>Kemudian isi data template</li>
                    <img src="{{ asset('assets/images/import/surah-1.png')}}" style="width:450px;">
                    <br> <br>
                    <p><b>Keterangan Data Template</b> </p>
                    <ol type="a">
                        <li>Section_id adalah <b>Index Juz</b></li>
                        <img src="{{ asset('assets/images/import/surah-2.png')}}" style="width:350px;">
                        <li>Index adalah <b>Urutan dari Surah</b></li>
                        <img src="{{ asset('assets/images/import/surah-3.png')}}" style="width:350px;">
                        <li>Name adalah <b>Nama Surah</b> </li>
                        <li>Count Serve adalah <b>Jumlah ayat</b> Pada Surah Tersebut </li>
                        <li>Tipe adalah <b> Kategori surah makiyah atau madaniyah (Pilih Salah satu)</b> </li>
                        <li>Lafadz adalah <b>Penulisan Surah Dalam Bahasa Arab</b> </li>
                        <li>Use Bismillah adalah <b> penandaan surah tersebut menggunakan bismillah atau tidak </b>untuk cara mengisinya dengan nilai 1 (menggunakan) atau 0 (tidak menggunakan) bismillah</li>

                    </ol>
                    <li>Upload data template Pada Import Data Berikut:</li>
                </ol>
                <p></p>
            </div>

            <form action="{{ route('tblSurah.import') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="importform">
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
</div>
</div>
@endsection
@section('js-custom')

<script type="text/javascript">
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');
            var r = "{{ route('data-surah.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-surah.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    console.log(data)
                    $('#id').val(data.id);
                    $('#section_id').val(data.section_id);
                    $('#index').val(data.surah_index);
                    $('#name').val(data.name);
                    $('#count_serve').val(data.count_serve);
                    $('#type').val(data.type);
                    $('#lafadz').val(data.lafadz);
                    $('#translate_name').val(data.translate_name);
                    if (data.use_bismillah == true) {
                        $('#use_bismillah').val(1);
                    }
                    else {
                        $('#use_bismillah').val(0);
                    }
                    document.getElementById('section_view').innerHTML = data.section_name;
                    document.getElementById('index_view').innerHTML = data.surah_index;
                    document.getElementById('name_view').innerHTML = data.name;
                    document.getElementById('count_serve_view').innerHTML = data.count_serve;
                    document.getElementById('type_view').innerHTML = data.type;
                    document.getElementById('lafadz_view').innerHTML = data.lafadz;
                    document.getElementById('translate_name_view').innerHTML = data.translate_name;
                    var use_bismillah;
                    if (data.use_bismillah == 0) {
                        use_bismillah = "Tidak";
                    } else {
                        use_bismillah = "Ya";
                    }
                    document.getElementById('use_bismillah_view').innerHTML = use_bismillah;
                    $('#edit-form').attr('action', route);
                }
            });
        });

    });
</script>
@endsection