@extends('layouts.app')
@section('title') keyshop - Manage Books Data @endsection
@section('informasi')Informasi Data Books @endsection

@section('content')
<!-- alert sukses -->
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- NAVIGASI -->
<div class="row">
    <div class="col-lg-12 mb-2">
        <ul class="nav nav-pills card-header-pills fa-pull-right">
            <li class="nav-item">
                <a href="{{ route('books.index') }}"
                    class="nav-link {{ Request::get('status') == NULL && Request::path() == 'books' ? 'active' : '' }}">All</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('books.index', ['status' => 'publish']) }}"
                    class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}">Publish</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('books.index', ['status' => 'draft']) }}"
                    class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}">Draft</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('books.trash') }}"
                    class="nav-link {{ Request::path() == 'books/trash' ? 'active' : '' }}">Trash</a>
            </li>
        </ul>
    </div>
</div>

<!-- BUTTON TAMBAH DATA DAN SEARCH -->
<div class="row">
    <!-- BUTTON CREATE BOOK -->
    <div class="col-lg-6">
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus-circle"></i>
            Create Book</a>
    </div>
    <!-- BUTTON SEARCH DATA BOOKS -->
    <div class="col-lg-6">
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search fa-pull-right"
            action="{{ route('books.index') }}">
            <div class="input-group">
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search fa-pull-right"
                    action="{{ route('books.index') }}">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" name="search"
                            value="{{Request::get('name')}}" placeholder="Search for..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" value="Filter" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>

<!-- TABLE DATA BOOKS -->
<div class="table table-striped table-hover">
    <table class="table">
        <thead style="text-align: center">
            <tr>
                <th>NO</th>
                <th>COVER</th>
                <th>TITLE</th>
                <th>AUTHOR</th>
                <th>STATUS</th>
                <th>CATEGORIES</th>
                <th>STOCK</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $key => $book)

            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    @if ($book->cover)
                    <img src="{{ asset('storage/'. $book->cover) }}" alt="" class="img-thumbnail" width="70px"
                        height="70px">
                    @endif
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    @if ($book->status == "PUBLISH")
                    <span class="badge badge-primary">{{ $book->status }}</span>
                    @else
                    <span class="badge badge-danger">{{ $book->status }}</span>
                    @endif
                </td>
                <td>
                    <ul class="pl-3">
                        @foreach ($book->categories as $category)
                        <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $book->stock }}</td>
                <td>{{ $book->price }}</td>
                <td>
                    <a href="{{ route('books.edit', [$book->id]) }}" class="btn btn-warning btn-sm"><i
                            class='fas fa-edit'></i></a>
                    <form action="{{ route('books.destroy', [$book->id]) }}" method="POST"
                        onsubmit="return confirm('Move category to trash?')" class="d-inline">
                        @csrf

                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm" value="Trash"><i
                                class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-12 pagination justify-content-end pagination-sm">
                {{$books->appends(Request::all())->links()}}
            </div>
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

</script>
{{-- end ajax books --}}
@endsection