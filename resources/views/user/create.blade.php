@extends('layouts.app')
@section('title') Create User @endsection
@section('informasi') Create User Data @endsection

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control {{ $errors->first('name') ? "is-invalid": ""}}" placeholder="Full Name.. ">
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username"
                        class="form-control {{ $errors->first('username') ? "is-invalid": "" }}"
                        placeholder="User Name.. ">
                    <div class="invalid-feedback">
                        {{$errors->first('username')}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}" name="address"
                    id="address" placeholder="Address"></textarea>
                <div class="invalid-feedback">
                    {{$errors->first('address')}}
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" name="phone" id="phone"
                    class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}" placeholder="+62">
                <div class="invalid-feedback">
                    {{$errors->first('phone')}}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email"
                        class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}"
                        placeholder="example@email.com">
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="profile">Image</label>
                    <input type="file" name="avatar" id="profile"
                        class="form-control {{ $errors->first('avatar') ? "is-invalid" : "" }}">
                    <div class="invalid-feedback">
                        {{$errors->first('avatar')}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="roles">Roles</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}" type="radio"
                        name="roles[]" value="ADMIN" id="admin">
                    <label class="form-check-label" for="admin">Administrator</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}" type="radio"
                        name="roles[]" value="STAFF" id="staff">
                    <label class="form-check-label" for="staff">Staff</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}" type="radio"
                        name="roles[]" value="CUSTEMMER" id="custemmer">
                    <label class="form-check-label" for="custemmer">Custemmer</label>
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('roles')}}
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control {{ $errors->first('password') ? "is-invalid" : "" }}"
                        placeholder="Password">
                    <div class="invalid-feedback">
                        {{$errors->first('password')}}
                    </div>
                </div>
                <div class="col">
                    <label for="confirmpassword">Password Confirmation</label>
                    <input type="password" name="confirmpassword" id="confirmpassword"
                        class="form-control {{ $errors->first('confirmpassword') ? "is-invalid" : "" }}"
                        placeholder="Password Confirmation">
                    <div class="invalid-feedback">
                        {{$errors->first('confirmpassword')}}
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2 btn-sm"><i class="far fa-save"></i> SAVE</button>
        </form>
    </div>
</div>
@endsection