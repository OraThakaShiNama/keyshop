@extends('layouts.app')
@section('title')Create Books @endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <form action="{{ route('books.update', [$book->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ $book->title }}"
                            class="form-control {{$errors->first('title') ? "is-invalid" : ""}}" id="title"
                            placeholder="Title Books..." autofocus>
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="authore">Author</label>
                        <input type="text" name="author" value="{{ $book->author }}"
                            class="form-control {{$errors->first('author') ? "is-invalid" : ""}}" id="authore"
                            placeholder="Authore...">
                        <div class="invalid-feedback">
                            {{$errors->first('author')}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" value="{{ $book->slug }}"
                        class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}" name="slug" id="slug"
                        placeholder="Slug..">
                    <div class="invalid-feedback">
                        {{$errors->first('slug')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control {{$errors->first('description') ? "is-invalid" : ""}}"
                        name="description" id="address" rows="3"
                        placeholder="Give a description about this book">{{ $book->description }}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('description')}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" value="{{ $book->price }}"
                            class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="price"
                            placeholder="Rp.">
                        <div class="invalid-feedback">
                            {{$errors->first('price')}}
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="stock">Stock</label>
                        <input type="number" value="{{$book->stock}}"
                            class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock" id="stock"
                            min=0 value="0" placeholder="Rp.">
                        <div class="invalid-feedback">
                            {{$errors->first('stock')}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select multiple class="form-control" name="categories[]" id="categories"></select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>PUBLISH</option>
                        <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="publisher">Publisher</label>
                        <input type="text" name="publisher" value="{{ $book->publisher }}"
                            class="form-control {{$errors->first('publisher') ? "is-invalid" : ""}}" id="publisher"
                            placeholder="Book publisher">
                        <div class="invalid-feedback">
                            {{$errors->first('publisher')}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            @if ($book->cover)
                            <img src="{{ asset('storage/'. $book->cover) }}" class="img-thumbnail mb-2" width="150px"
                                height="150px" alt="" srcset="">
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <small class="text-muted">Curent Cover</small>
                            <input type="file" name="cover" class="form-control-file" id="Cover">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary mt-2" value="PUBLISH"><i class="far fa-save"></i>
                    Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('core-select2')
{{-- ajax category create books --}}
<script>
    $("#categories").select2({
    ajax: {
        url: 'http://keyshop/ajax/categories/search',
        dataType: "json",
        type: "GET",
        data: function (params) {

            var queryParameters = {
                term: params.term
            }
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        id: item.id,
                        text: item.name
                    }
                })
            };
        }
    }
});

var categories = {!! $book->categories !!}
    categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
});

</script>
{{-- end ajax books --}}
@endsection