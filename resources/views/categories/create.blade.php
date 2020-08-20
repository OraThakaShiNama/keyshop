@extends('layouts.app')
@section('title') Create Category Book @endsection
@section('informasi')
Create Categories
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="form-row">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col">
                <div class="form-group">
                    <label for="Name">Category Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}"
                        placeholder="Categories Books.." autofocus>
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                </div>
            </div>
            <div class="col">
                <label for="categoryImage">Image</label>
                <input type="file" name="image" id="categoryImage"
                    class="form-control {{ $errors->first('image') ? "is-invalid" : "" }}">
                <div class="invalid-feedback">
                    {{$errors->first('image')}}
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3"><i class="far fa-save"></i> Save</button>
        </form>
    </div>
</div>
@endsection