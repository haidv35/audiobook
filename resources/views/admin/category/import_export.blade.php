@extends('admin.layouts.app')
@section('custom-header')
    <link rel="stylesheet" href="/pnotify/dist/PNotifyBrightTheme.css">
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
                                        {{ Form::open(array('files'=>'true','method' => 'post','id'=>'upload-form')) }}
                                            @csrf
                                            <fieldset>
                                                <legend>Thêm Mới Danh Mục</legend>
                                                <div class="form-group">
                                                    <div class="form-group mt-2">
                                                        <div class="row justify-content-between mx-2">
                                                            {!! Form::label('import_file', 'File dữ liệu') !!}
                                                            <a href="/excel/mau-sach-noi-import.xlsx" style="color:red;"><i class="fas fa-download"></i>Tải mẫu file excel</a>
                                                        </div>
                                                        <div class="custom-file">
                                                            {!! Form::file('import_file',['class'=>'custom-file-input']) !!}
                                                            <label class="custom-file-label" for="import_file">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <hr class="mb-4">
                                                    <button class="btn btn-success btn-lg btn-block" type="button" id="importBtn">Nhập</button>
                                                    {{-- {!! Form::submit('Nhập', ['class'=>"btn btn-success btn-lg btn-block"]) !!} --}}
                                                </div>
                                            </fieldset>

                                        {{ Form::close() }}
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
    let admin_category_import = "{{ route('admin.category.import') }}";
</script>
<script src="/js/admin/category/import-export.js"></script>
@endsection
