@extends('layouts.layout')
@section('title','Data-faq')
@section('content')

<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('data-faq.destroy', 'delete') }}" method="POST" id="myform" enctype="multipart/form-data">
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
                                <th data-field="question_id" data-sortable="true">Pertanyaan</th>
                                <th data-field="content" data-sortable="true">Jawaban</th>
                                <th data-field="action" data-align="center" data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1; ?>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td><input type="checkbox" name="check[]" type="checkbox" value="{{ $value->id }}" form="myform"></td>
                                <td>{{ $no++ }}</td>
                                @if($value->question_id == null)
                                <td>{!! $value->content !!}</td>
                                <td></td>
                                @else
                                <td>{!! $value->question->content !!}</td>
                                <td>{!! $value->content !!}</td>
                                @endif
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
            <form action="{{ route('data-faq.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="userform">
                {{ csrf_field() }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Type</label>
                        <select class="form-control" name="type" id="typeFilter" onchange="tagsType()" required>
                            <option value="">- Pilih Type -</option>
                            <option value="1">Pertanyaan</option>
                            <option value="2">Jawaban</option>
                        </select>
                    </div>
                    <div class="form-group" id="answer">
                        <label>Pertanyaan</label>
                        <select class="form-control" name="question_id">
                            <option value="">- Pilih Pertanyaan -</option>
                            @foreach($question as $packages)
                            <option value="{{ $packages->id }}">{!! $packages->content !!}</option>
                            @endforeach
                        </select>

                        <label>Jawaban</label>
                        <textarea type="text" name="contentAnswer" id="contentAnswer2" rows="5" class="form-control" ></textarea>
                    </div>
                    <div class="form-group" id="question">
                      
                        <label>Pertanyaan</label>
                        <textarea type="text" name="contentQuestion" id="contentQuestion2" rows="5" class="form-control" ></textarea>
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
                                    <td>Pertanyaan</td>
                                    <td>:</td>
                                    <td>
                                        <div id="question_view"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jawaban</td>
                                    <td>:</td>
                                    <td>
                                        <div id="answer_view"></div>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="edit-data">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group">
                                <label>Pilih Type</label>
                                <select class="form-control" name="type" id="typeFilter2" onchange="tagsType2()" required>
                                    <option value="">- Pilih Type -</option>
                                    <option value="1">Pertanyaan</option>
                                    <option value="2">Jawaban</option>
                                </select>
                            </div>
                            <div class="form-group" id="answer2">
                                <label>Pertanyaan</label>
                                <select class="form-control" name="question_id" id="question_id">
                                    <option value="">- Pilih Pertanyaan -</option>
                                    @foreach($question as $packages)
                                    <option value="{{ $packages->id }}">{{ $packages->content }}</option>
                                    @endforeach
                                </select>

                                <label>Jawaban</label>
                                <textarea type="text" name="contentAnswer" id="contentAnswer" rows="5" class="form-control" ></textarea>
                            </div>
                            <div class="form-group" id="question2">
                                <label>Pertanyaan</label>
                                <textarea type="text" name="contentQuestion" id="contentQuestion" rows="5" class="form-control" ></textarea>
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
            var r = "{{ route('data-faq.index') }}";
            var route = r + "/" + rowid;
            $.ajax({
                type: 'GET',
                url: "{{ route('data-faq.index') }}/" + rowid + "/edit",
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#question_id').val(data.question_id);
                    $('#contentQuestion').val(data.questions);
                    CKEDITOR.replace(contentQuestion, {
                        language: 'en-gb',
                        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form',
                        allowedContent: true
                    });
                    $('#contentAnswer').val(data.answer);
                    CKEDITOR.replace(contentAnswer, {
                        language: 'en-gb',
                        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form',
                        allowedContent: true
                    });
                    if (data.question_id == null) {
                        $('#typeFilter2').val(1);
                        $('#answer2').hide();
                        $('#question2').show();
                    } else {
                        $('#typeFilter2').val(2);
                        $('#answer2').show();
                        $('#question2').hide();
                    }
                    document.getElementById('question_view').innerHTML = data.questions;
                    document.getElementById('answer_view').innerHTML = data.answer;
                    $('#edit-form').attr('action', route);
                }
            });
        });

    });

    //change type
    $('#question').hide();
    $('#answer').hide();

    function tagsType() {
        var type = $('#typeFilter').val();

        if (type == 1) {
            $('#answer').hide();
            $('#question').show();
        } else if (type == 2) {
            $('#answer').show();
            $('#question').hide();

        }
    }

    function tagsType2() {
        var type = $('#typeFilter2').val();

        if (type == 1) {
            $('#answer2').hide();
            $('#question2').show();
        } else if (type == 2) {
            $('#answer2').show();
            $('#question2').hide();

        }
    }

    var content_qu = document.getElementById("contentQuestion2");
    CKEDITOR.replace(contentQuestion2, {
        language: 'en-gb',
        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
    var content_qu = document.getElementById("contentAnswer2");
    CKEDITOR.replace(contentAnswer2, {
        language: 'en-gb',
        filebrowserUploadUrl: "{{ route('all.uploadLatex', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
</script>
@endsection