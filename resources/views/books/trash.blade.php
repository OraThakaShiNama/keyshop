@extends('layouts.app')
@section('title') Trash books @endsection
@section('informasi') Trash @endsection
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
<!-- TABLE DATA -->
<table class="table table-hovered table-sm">
    <thead>
        <th>NO</th>
        <th>COVER</th>
        <th>TITLE</th>
        <th>AUTHOR</th>
        <th>CATEGORIES</th>
        <th>STOCK</th>
        <th>PRICE</th>
        <th>ACTION</th>
    </thead>
    <tbody>
        @foreach ($books as $key => $book)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>
                @if ($book->cover)
                <img src="{{ asset('storage/'. $book->cover) }}" class="img-thumbnail" width="65px" height="65px" />
                @endif
            </td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>
                <ul>
                    @foreach ($book->categories as $category)
                    <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $book->stock }}</td>
            <td>{{ $book->price }}</td>
            <td>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <form action="{{route('books.restore', [$book->id])}}" method="POST">
                            @csrf
                            <button type="submit" value="restore" class="btn btn-success btn-sm"><i
                                    class="fas fa-redo-alt"></i></button>
                        </form>
                    </li>
                    <li class="nav-item ml-1">
                        <form action="{{ route('books.delete-permanent', [$book->id]) }}" method="POST"
                            onsubmit="return confirm('Delete This Book Permanently?')">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" value="Delete" class="btn btn-danger btn-sm"><i
                                    class="fas fa-trash-alt"></i></button>
                        </form>
                    </li>
                </ul>
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
@endsection