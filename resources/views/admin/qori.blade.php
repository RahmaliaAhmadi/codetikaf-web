@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-qori.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal" data-target="#myModal"><i class="demo-pli-add"></i> Create</button>
                    <button id="deletebutton" type="submit" form='myform' class="btn btn-rounded btn-danger"><i class="demo-pli-cross" disabled></i> Delete</button>
                    <input type="hidden" class="alls" name="alls" value="0" form='myform'>
                </form>
                <br>
                @if($filter_status == 0)
                <form class="form-inline" action="{{ route('masterReciter.filter') }}" method="get">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input name="search" class="form-control" placeholder="Pencarian Nama Qori">
                        </select>
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <button class="btn btn-success form-control" type="submit">Search</button>
                    </div>
                </form>
                @else
                <form class="form-inline" action="{{ route('masterReciter.filter') }}" method="get">
                    {{ csrf_field() }}

                    <div class="form-group">
                    <input name="search" class="form-control" value="{{$search}}" placeholder="Pencarian Nama Qori">
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
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Nama</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                <img src="{{ asset('/images/qori/'.$value->image) }}" style="height: 100px; width: 100px;" />
                                    <form action="{{ route('data-qori.image') }}" method="post" enctype="multipart/form-data" id="form-upload">
                                        {{ csrf_field() }}
                                        <input class="form-control" type="file" name="image" id="file-upload" accept="image/*" required>
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <br>

                                        <button type="submit" name="submit" class="btn btn-primary btn-sm btn-rounded ">Submit</button>

                                    </form>
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
            <form action="{{ route('data-qori.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
                {{ csrf_field() }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
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
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <div id="name_view"></div>
                                    </td>
                                </tr>


                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="edit-data">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama" required>
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
            var r = "{{ route('data-qori.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-qori.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    document.getElementById('name_view').innerHTML = data.name;
                    $('#edit-form').attr('action', route);
                }
            });
        });

    });
    
</script>
@endsection