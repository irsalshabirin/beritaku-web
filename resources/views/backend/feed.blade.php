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
                        <h2>Feeds </h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="pull-right">
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#add-modal">Add</button>
                    </div>



                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Judul</th>
                                    <th>URL</th>
                                    <th>Icon</th>
                                    <th>#</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($feeds as $index => $feed)
                                <tr>
                                    <td>{{ $feed->id }}</td>
                                    <td> {{ $feed->title }} </td>
                                    <td> <a href="{{ $feed->feed_url }}" target="_blank"> {{ $feed->feed_url }} <i class="fa fa-rss"></i></a> </td>
                                    <td> <img src="{{ $feed->icon_url }}" /></td>
                                    <td> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                Action
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ URL::asset('admin/feed/' . $feed->id . '/article') }}" >Lihat Berita</a></li>
                                                <!--<li><a href="#" data-toggle="modal" data-target="#edit-modal" >Edit</a></li>-->
                                                <li><a href="#" data-toggle="modal" data-id="{{ $feed->id }}" data-title="{{ $feed->title }}" data-target="#delete-modal" class="delete-modal">Delete</a></li>
                                            </ul>
                                        </div> 
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <!-- Add modal -->
        <div class="modal fade" id="add-modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="{{ URL::asset('admin/feed/store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Feed</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div id="nama_barang" class="form-group">
                                        <label>URL Feed</label>
                                        <input type="text" name="feed_url" class="form-control" placeholder="URL Feed" />
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
        </div><!-- /.modal -->


        <!-- Delete modal -->
        <div class="modal fade" id="delete-modal" role="dialog">
            <div class="modal-dialog modal-md">
                <form id="form-delete" method="post" action="{{ URL::asset('admin/feed/destroy') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id" id="id" value="" />


                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hapus Feed</h4>
                        </div>
                        <div class="modal-body">
                            Anda ingin menghapus Feed "<span id="title"></span>" ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <input type="submit" value="Hapus" class="btn btn-flat btn-danger"/>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
$(document).ready(function () {
   
    $('#datatable').dataTable();

    TableManageButtons.init();
});

$(document).on("click", ".delete-modal", function () {
    var id = $(this).data('id');
    $(".modal-dialog #id").val(id);
    
    var title = $(this).data('title');
    $(".modal-dialog #title").html(title);
});
</script>
<!-- /Datatables -->
@stop