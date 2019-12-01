@extends('admin.layouts.app')
@section('custom-header')
<link rel="stylesheet" href="/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">
@endsection
@section('app-main')
    <div class="container-fluid">
        <h2>@yield('custom-header')</h2>
        <hr>
        {{ Form::open(array('method' => 'post','id'=>'upload-form')) }}
            @yield('custom-form')
            {{-- <div class="form-group">
                {!! Form::label('title', 'Tiêu đề') !!}
                {!! Form::text('title', isset($page) ? $page->title : '', ['class'=>'form-control']) !!}
            </div> --}}
            <div class="form-group">
                {!! Form::textarea('value',isset($page) ? $page : '',['class' => 'form-control','id'=>'value']) !!}
            </div>
            {!! Form::submit("Lưu lại", ['class'=>'btn btn-outline-success']) !!}
            <a href="/{{ ($page_name == 'footer' || $page_name == 'slider') ? '' : $page_name }}" id="{{ $page_name }}" name="{{ $page_name }}" class="btn btn-outline-primary" role="button">Xem thử</a>
        {{ Form::close() }}
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
@endsection

@section('custom-footer')
    <script src="/ckeditor/ckeditor.js"></script>
    <script src="/ckeditor/default.js"></script>
    <script>
        initSample('value');
    </script>
@endsection
