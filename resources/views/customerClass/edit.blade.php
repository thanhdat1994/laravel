@extends('adminlte::page')

@section('title', 'Customer classes')

@section('content_header')
    <h1>Update Category</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('customer-class.index') }}"><i
                                class="fas fa-backspace"></i> Back</a>
                    </h3>
                </div>
                <form action="{{ route('customer-class.update', $customerClass->id) }}" method="POST" enctype="multipart/form-data"
                      class="form-horizontal justify-content-center align-items-center">
                    @method('PATCH')
                    @csrf
                    <div class="card-body col-6">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-4 col-form-label text-right">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="inputNameCustomerClass" placeholder="Name"
                                       value="{{ $customerClass->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-4 col-form-label text-right">Image</label>
                            <div class="col-sm-8 form-input-file">
                                <input name="image" value="{{ $customerClass->path }}" type="hidden">
                                <input id="imgInput" type="file" name="inputImage" class="form-control mb-2" value="{{ $customerClass->path }}">
                                <img id="image"
                                    src="{{ $customerClass->path ? Storage::url($customerClass->path) : 'https://via.placeholder.com/135x90?text=Image' }}"
                                    class="img-thumbnail img-lg image-custom">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success"><i class="fas fa-pen-fancy"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">
        .form-input-file input.form-control {
            padding: 0.175rem 0.25rem;
        }
        .image-custom {
            width: 145px;
        }
    </style>
@stop

@section('js')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInput").change(function() {
            readURL(this);
        });
    </script>
@stop
