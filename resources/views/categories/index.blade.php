@extends('layouts.app')
@section('title') keyshop - Manage Category @endsection
@section('informasi') Manage Category Books @endsection

@section('content')

<!-- trashed Categories -->
<div class="row">
    <div class="col-md-12 mb-3">
        <ul class="nav nav-pills card-header-pills fa-pull-right">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('categories.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('categories.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
</div>

<!-- alert sukses -->
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <!-- BUTTON CREATE CATEGORIES -->
    <div class="col-lg-6">
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm mb-3"><i
                class="fas fa-plus-circle"></i>
            Create Categories</a>
    </div>
    <!-- BUTTON SEARCH DATA CATEGORIES -->
    <div class="col-lg-6">
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search fa-pull-right"
            action="{{ route('categories.index') }}">
            <div class="input-group">
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search fa-pull-right"
                    action="{{ route('categories.index') }}">
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

<table class="table table-striped table-responsive-md table-md"> {{-- awal table keterangan --}}
    <thead>
        <tr>
            <th scope="col">NO</th>
            <th scope="col">NAME</th>
            <th scope="col">SLUG</th>
            <th scope="col">IMAGE</th>
            <th scope="col">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $key => $category)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>
                @if ($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" width="50px" height="50px" class="img-rounded">
                @else
                N/A
                @endif
            </td>
            <td>
                <!-- Button trigger modal profile -->
                <a href="#" value="{{ route('categories.show', [$category->id]) }}"
                    class="btn btn-sm btn-primary btn-sm" title="Show Data" data-toggle="modal"
                    data-target="#ProfileCategory{{ $category->id }}"><span class="glyphicon glyphicon-eye-open"><i
                            class="fas fa-info-circle"></i></span></a>

                <!-- Modal profile -->
                <div class="modal fade" id="ProfileCategory{{ $category->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="Profile" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ProfileCategory">ProfileCategory</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{asset('storage/'. $category->image)}}" class="card-img"
                                                style="width: 150px; height: 200px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h4>{{ $category->name }}</h4>
                                                <small>{{ $category->slug }}</small>
                                                <small class="text-muted">{{ $category->created_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal edit -->
                <a href="#" value="{{ route('categories.edit', [$category->id]) }}"
                    class="btn btn-sm btn-warning btn-sm" title="Show Data" data-toggle="modal"
                    data-target="#EditCategory{{ $category->id }}"><span class="glyphicon glyphicon-eye-open"><i
                            class='fas fa-edit'></i></span></a>

                <!-- Modal Edit User -->
                <div class="modal fade" id="EditCategory{{ $category->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="EditCategory" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditCategory">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data"
                                    action="{{route('categories.update', [$category->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="PUT" name="_method">

                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}"
                                            for="category" value="{{$category->name}}" name="nameCategory" id="category"
                                            placeholder="Categories Name..">
                                        <div class="invalid-feedback">
                                            {{$errors->first('name')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Category Slug</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}"
                                            for="category" value="{{$category->slug}}" name="slugCategory" id="slug"
                                            placeholder="Categories Slug..">
                                        <div class="invalid-feedback">
                                            {{$errors->first('slug')}}
                                        </div>
                                    </div>

                                    <div class="form-row mb-3">
                                        <div class="col-2">
                                            <img src="{{asset('storage/'. $category->image)}}" alt="..."
                                                class="img-thumbnail" width="120px" height="120px">
                                        </div>

                                        <div class="form-group col-10">
                                            <label for="CM">Category Image</label>
                                            <input type="file"
                                                class="form-control-file {{ $errors->first('image') ? "is-invalid" : "" }}"
                                                name="image" id="CM">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                            <div class="invalid-feedback">
                                                {{$errors->first('name')}}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <form action="{{ route('categories.destroy', [$category->id]) }}" method="POST"
                    onsubmit="return confirm('Move category to trash?')" class="d-inline">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm" value="Trash"
                        style="height: 33px; width:31px;"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> {{-- akhir tabel keterangan menu --}}

<div class="row">
    <div class="col-lg-12">
        <div class="col-md-12 pagination justify-content-end pagination-sm">
            {{$categories->appends(Request::all())->links()}}
        </div>
    </div>
</div>
@endsection