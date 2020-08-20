@extends('layouts.app')
@section('title') Trashed Categories @endsection

@section('content')

<div class="row"> {{-- awal menu --}}
    <div class="col-lg-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="{{route('categories.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('categories.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
    <div class="col-lg-6">
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
</div> {{-- end top menu --}}

<table class="table table-striped mt-3"> {{-- awal table keterangan --}}
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Slug</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;?>
        @foreach ($categories as $category)
        <?php $no++ ;?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>
                @if ($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" width="50px" height="50px">
                @else
                N/A
                @endif
            </td>
            <td>
                <a href="{{ route('categories.restore', [$category->id]) }}" class="btn btn-success btn-sm"><i
                        class="fas fa-redo-alt"></i> Restore</a>

                <form action="{{ route('categories.delete-permanent', [$category->id]) }}" method="POST"
                    onsubmit="return confirm('Delete this category permanently?')" class="d-inline">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm" value="Trash"><i class="fas fa-trash-alt"></i>
                        Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> {{-- akhir tabel keterangan menu --}}

<div class="row"> {{-- pagination --}}
    <div class="col-md-12 justify-content-end">
        {{$categories->appends(Request::all())->links()}}
    </div>
</div> {{-- akhir pagination --}}

@endsection