@extends('layouts.app')
@section('title') User List @endsection
@section('informasi') Information User @endsection

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

<div class="row">
    <!-- button create users -->
    <div class="col-lg-6">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus-circle"></i>
            Create User</a>
    </div>
    <!-- button search data users -->
    <div class="col-lg-6">
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search fa-pull-right"
            action="{{ route('users.index') }}">
            <div class="input-group">
                <div class="form-check form-check-inline">
                    <input type="radio" name="status" id="active" value="active" class="form-check-input"
                        {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} <label for="active"
                        class="form-check-label">ACTIVE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="status" id="inactive" value="inactive" class="form-check-input"
                        {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} <label for="inactive"
                        class="form-check-label">INACTIVE</label>
                </div>
                <input type="text" class="form-control bg-light border-0 small" value="{{ Request::get('keyword') }}"
                    name="keyword" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" value="Filter" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Users Information -->
<table class="table table-hover table-responsive-sm table-sm">
    <thead>
        <th scope="col">NO</th>
        <th scope="col">NAME</th>
        <th scope="col">USER NAME</th>
        <th scope="col">E-MAIL</th>
        <th scope="col">STATUS</th>
        <th scope="col">ACTION</th>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>

                @if ($user->status == 'ACTIVE')
                <span class="badge badge-pill badge-success">Active</span>
                @else
                <span class="badge badge-pill badge-danger">{{ $user->status }}</span>
                @endif
            </td>
            <td>
                <!-- Button trigger modal profile -->
                <a href="#" value="{{ route('users.show', [$user->id]) }}" class="btn btn-sm btn-primary btn-sm"
                    title="Show Data" data-toggle="modal" data-target="#Profile{{ $user->id }}"><span
                        class="glyphicon glyphicon-eye-open"><i class="fas fa-info-circle"></i></span></a>

                <!-- Modal profile -->
                <div class="modal fade" id="Profile{{ $user->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="Profile" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Profile">Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{asset('storage/'. $user->avatar)}}" class="card-img"
                                                style="width: 150px; height: 200px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h4>{{ $user->name }}</h4>
                                                <small>{{ $user->address }} <i class="fa fa-map-marker"
                                                        aria-hidden="true"></i></small>
                                                <p class="card-text"><small>
                                                        <i class="fa fa-envelope"
                                                            aria-hidden="true"></i>{{ $user->email }}
                                                        </br>
                                                        <i class="fa fa-mobile"
                                                            aria-hidden="true"></i>{{ $user->phone }}
                                                    </small>
                                                </p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins
                                                        ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal edit -->
                <a href="#" value="{{ route('users.edit', [$user->id]) }}" class="btn btn-sm btn-warning btn-sm"
                    title="Show Data" data-toggle="modal" data-target="#EditUser{{ $user->id }}"><span
                        class="glyphicon glyphicon-eye-open"><i class='fas fa-edit'></i></span></a>

                <!-- Modal Edit User -->
                <div class="modal fade" id="EditUser{{ $user->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="EditUser" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditUser">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" action="{{route('users.update', [$user->id])}}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="PUT" name="_method">

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control {{ $errors->first('name') ? "is-invalid": ""}}"
                                                value="{{ $user->name }}">
                                            <div class="invalid-feedback">
                                                {{$errors->first('name')}}
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label for="username">UserName</label>
                                            <input type="text" name="username" id="username"
                                                value="{{ $user->username }}" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address"
                                            class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}">{{ $user->address }}</textarea>
                                        <div class="invalid-feedback">
                                            {{$errors->first('address')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone"
                                            class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}"
                                            value="{{ $user->phone }}">
                                        <div class="invalid-feedback">
                                            {{$errors->first('phone')}}
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="email">E-mail</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}"
                                                value="{{ $user->email }}">
                                            <div class="invalid-feedback">
                                                {{$errors->first('email')}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            @if ($user->avatar)
                                            <img class="rounded-circle" src="{{asset('storage/'.$user->avatar)}}"
                                                width="100px" height="100px" />
                                            @else
                                            No Image
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="imageprofile">Image Profile</label>
                                                <input type="file" name="avatar" class="form-control-file"
                                                    id="imageprofile">
                                                <small class="text-muted">Kosongkan Jika tidak berganti foto</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status"><b>STATUS : </b></label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="status" id="active" value="active"
                                                class="form-check-input"
                                                {{ $user->status == "ACTIVE" ? "checked" : "" }}>
                                            <label for="active" class="form-check-label">ACTIVE</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="status" id="inactive" value="inactive"
                                                class="form-check-input"
                                                {{ $user->status == "INACTIVE" ? "checked" : "" }}>
                                            <label for="inactive" class="form-check-label">INACTIVE</label>
                                        </div>

                                        <label for="roles"><b>ROLES : </b></label>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}"
                                                {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }}
                                                type="radio" name="roles[]" value="ADMIN" id="admin">
                                            <label class="form-check-label" for="admin">Administrator</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}"
                                                {{in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }}
                                                type="radio" name="roles[]" id="staff" value="STAFF">
                                            <label class="form-check-label" for="staff">Staff</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}"
                                                {{in_array("CUSTEMMER", json_decode($user->roles)) ? "checked" : "" }}
                                                type="radio" name="roles[]" id="custemmer" value="CUSTEMMER">
                                            <label class="form-check-label" for="custemmer">Custemer</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            {{$errors->first('roles')}}
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

                <!-- button delete users -->
                <form action="{{ route('users.destroy', [$user->id]) }}" method="POST"
                    onsubmit="return confirm('delete this permanently!')" class="d-inline">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" style="height: 33px; width:31px;"><i
                            class="fas fa-user-minus"></i></button>
                </form>
            </td>
        </tr>

        @endforeach
        <tr></tr>
    </tbody>
</table>

<div class="row">
    <div class="col-lg-12">
        <div class="col-md-12 pagination justify-content-end pagination-sm">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection