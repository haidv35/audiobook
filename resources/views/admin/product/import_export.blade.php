@extends('admin.layouts.app')
@section('custom-header')
    <!-- pnotify -->
    <link rel="stylesheet" href="/pnotify/dist/PNotifyBrightTheme.css">
    {{-- <style>textarea {resize: none;}</style> --}}
@endsection
@section('app-main')
<main class="app-main">
    <div class="wrapper">
        <div class="page">
            <div class="page-inner">
                <div class="page-section">
                    <div class="d-xl-none">
                        <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
                    </div><!-- .card -->
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                                <div id="base-style" class="card">
                                        <!-- .card-body -->
                                        <div class="card-body">
                                        <form method="POST" action="/admin/product/export" accept-charset="UTF-8" id="upload-form" enctype="multipart/form-data">
                                        {{-- {{ Form::open(array('files'=>'true','method' => 'post','id'=>'upload-form')) }} --}}
                                            @csrf
                                            <fieldset>
                                                <legend>Thêm Mới Sản Phẩm</legend>
                                                <div class="form-group">
                                                    <div class="form-group mt-2">
                                                        <div class="row justify-content-between mx-2">
                                                            {!! Form::label('import_file', 'File dữ liệu') !!}
                                                            <a href="/excel/mau-sach-noi-import.xlsx" style="color:red;"><i class="fas fa-download"></i>Tải mẫu file excel</a>
                                                        </div>
                                                        <div class="custom-file">
                                                            {!! Form::file('import_file',['class'=>'custom-file-input']) !!}
                                                            <label class="custom-file-label" for="import_file">Chọn file ...</label>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-12">
                                                                <div class="alert alert-danger" role="alert">
                                                                    !!! Dữ liệu chỉ có thể nhập thêm từ file excel. Hãy đảm bảo dữ liệu của bạn không bị trùng
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mb-4">
                                                    <button class="btn btn-success btn-lg btn-block" type="button" id="importBtn">Nhập</button>
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit" id="exportBtn">Xuất</button>
                                                    {{-- {!! Form::submit('Nhập', ['class'=>"btn btn-success btn-lg btn-block"]) !!} --}}
                                                </div>
                                            </fieldset>
                                        </form>
                                        {{-- {{ Form::close() }} --}}
                                        </div>
                                    </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection

@section('custom-footer')
<script type="text/javascript" src="/pnotify/dist/iife/PNotify.js"></script>
<script type="text/javascript" src="/pnotify/dist/iife/PNotifyButtons.js"></script>
<script type="text/javascript" src="/pnotify/dist/iife/PNotifyHistory.js"></script>
<script type="text/javascript" src="/pnotify/showStackBottomRight.js"></script>
<script type="text/javascript">
    let admin_product_import = "{{ route('admin.product.import') }}";
</script>
<script type="text/javascript" src="/js/admin/product/import_export.js"></script>
@endsection
