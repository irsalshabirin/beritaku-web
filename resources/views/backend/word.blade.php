@extends('backend.master')

@section('header-library')
<link href="{{ URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
@endsection


@section('content-admin')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    @if (session('failed'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ session('failed') }}
                    </div>
                    @elseif (session('success'))
                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Sukses:</span>
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="x_title">
                        <h2>Word </h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="pull-right">
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#add-modal">Add</button>
                    </div>


                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Word</th>
                                    <th>Tipe</th>
                                    <th>#</th>
                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>

        </div>

        <!-- Add modal - start -->
        <div class="modal fade" id="add-modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ URL::asset('admin/word/store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Word</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Word</label>
                                        <input type="text" name="word" class="form-control" placeholder="Word" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div id="type" class="form-group">
                                        <label>Type</label>
                                        <input type="text" name="type" class="form-control" placeholder="Tipe" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <input type="submit" value="Add" class="btn btn-success" />
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Add modal - end -->

        <!-- Add edit - start -->
        <div class="modal fade" id="edit-modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ URL::asset('admin/word/update') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <input type="hidden" name="id" id="id" value="" />

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Word</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Word</label>
                                        <input type="text" name="word" id="word" class="form-control" placeholder="Word" />
                                    </div>
                                </div>

                                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" name="type" id="type" class="form-control" placeholder="Tipe" />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <input type="submit" value="Update" class="btn btn-success" />
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Add modal - end -->

        <!-- Delete modal -start -->
        <div class="modal fade" id="delete-modal" role="dialog">
            <div class="modal-dialog modal-md">
                <form id="form-delete" method="post" action="{{ URL::asset('admin/word/destroy') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" id="id" value="" />

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus Word</h4>
                        </div>
                        <div class="modal-body">
                            Anda ingin menghapus Word "<span id="word"></span>" ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <input type="submit" value="Hapus" class="btn btn-flat btn-danger"/>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div>
        <!--delete modal - end -->
    </div>
</div>
<!-- /page content -->
@stop


@section('footer-library')
<!-- Datatables -->
<script src="{{ URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script>

<script src="{{ URL::asset('bower_components/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
<!-- Datatables -->
<script>
$(document).on("click", ".delete-modal", function () {
    var id = $(this).data('id');
    $(".modal-dialog #id").val(id);

    var word = $(this).data('word');
    $(".modal-dialog #word").html(word);
});

$(document).on("click", ".edit-modal", function () {
    var id = $(this).data('id');
    $(".modal-dialog #id").val(id);

    var word = $(this).data('word');
    $(".modal-dialog #word").val(word);

    var type = $(this).data('type');
    $(".modal-dialog #type").val(type);
});

</script>
<!-- /Datatables -->
@stop


@push('footer-script')
<script>
    $(document).ready(function () {

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
//                handleDataTableButtons();
                }
            };
        }();

//    $('#datatable').dataTable();

        $('#datatable').dataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
//            scroller: true,
            ajax: '{!! URL::asset("admin/word/data") !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'word', name: 'word'},
                {data: 'type', name: 'type'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

//    $('#datatable').dataTable({
////        ajax: "js/datatables/json/scroller-demo.json",
//        deferRender: true,
////        scrollY: 380,
////        scrollCollapse: true,
////        scroller: true
//    });

//    $('#datatable-responsive').DataTable();

        TableManageButtons.init();
    });

</script>
@endpush