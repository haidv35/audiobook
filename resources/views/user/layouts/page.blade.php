@extends('user.layouts.app')
@section('app-main')
    <div class="container-fluid">
        <h2>@yield('custom-header')</h2>
        <hr>
        {{ Form::open(array('method' => 'post','id'=>'upload-form')) }}
            @yield('custom-form')
            <div class="form-group">
                {!! Form::label('title', 'Tiêu đề') !!}
                {!! Form::text('title', isset($page) ? $page->title : '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content', 'Nội dung') !!}
                {!! Form::textarea('content',isset($page) ? $page->content : '',['class' => 'form-control','id'=>'content']) !!}
            </div>
            {!! Form::submit("Lưu lại", ['class'=>'btn btn-outline-success']) !!}
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
    <script src="/ckeditor/custom.js"></script>
    <script>
        initSample('content');
    </script>
@endsection
