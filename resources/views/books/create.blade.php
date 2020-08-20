@extends('layouts.app')
@section('title') Create book @endsection
@section('informasi') Create Books Data @endsection

@section('content')

<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col">
            <label for="title">Title</label>
            <input type="text" class="form-control {{$errors->first('title') ? "is-invalid" : ""}}" name="title"
                id="title" placeholder="Tiitle Books..." autofocus>
            <div class="invalid-feedback">
                {{$errors->first('title')}}
            </div>
        </div>
        <div class="form-group col">
            <label for="author">author</label>
            <input type="text" class="form-control {{$errors->first('author') ? "is-invalid" : ""}}" name="author"
                id="author" placeholder="Author">
            <div class="invalid-feedback">
                {{$errors->first('author')}}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <textarea name="description" id="description"
            class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" cols="5" rows="5"
            placeholder="Give a description about this book"></textarea>
        <div class="invalid-feedback">
            {{$errors->first('description')}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="price">Price</label>
            <input type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price"
                id="price" placeholder="Rp.">
            <div class="invalid-feedback">
                {{$errors->first('price')}}
            </div>
        </div>
        <div class="form-group col">
            <label for="stock">Stock</label>
            <input type="number" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock"
                id="stock" min="0" value="0" placeholder="Stock...">
            <div class="invalid-feedback">
                {{$errors->first('stock')}}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="categories">Categories</label>
        <select name="categories[]" multiple class="form-control {{$errors->first('categories') ? "is-invalid" : ""}}"
            id="categories"></select>
        <div class="invalid-feedback">
            {{$errors->first('categories')}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="publisher">publisher</label>
            <input type="text" class="form-control {{$errors->first('publisher') ? "is-invalid" : ""}}" name="publisher"
                id="publisher" placeholder="Book publisher">
            <div class="invalid-feedback">
                {{$errors->first('categories')}}
            </div>
        </div>
        <div class="form-group col">
            <label for="cover">Cover</label>
            <input type="file" class="form-control {{$errors->first('cover') ? "is-invalid" : ""}}" name="cover"
                id="cover">
            <div class="invalid-feedback">
                {{$errors->first('cover')}}
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2" name="save_action" value="PUBLISH"><i class="far fa-save"></i>
        Publish</button>
    <button type="submit" class="btn btn-success mt-2" name="save_action" value="DRAFT"><i class="fas fa-archive"></i>
        Draft</button>
</form>

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

</script>
{{-- end ajax books --}}
@endsection