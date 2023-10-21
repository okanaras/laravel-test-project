@extends('layouts.index')

@section('title')
    {{ isset($users) ? 'Update' : 'Create' }} User
@endsection


@section('css')
@endsection

@section('contentTitle')
    {{ isset($users) ? 'Update' : 'Create' }} User
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ isset($users) ? 'Update' : 'Create New' }} user</h2>
            <div class="example-container">
                <div class="example-content">

                    {{-- herhangi bir hata varsa eger --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    {{-- create and update form --}}
                    <form action="{{ isset($users) ? route('user.edit', ['id' => $users->id]) : route('user.create') }}"
                        method="POST" id="userForm">
                        @csrf

                        <label for="name" class="form-label">Kullanici Ad Soyad</label>
                        <input type="text" class="form-control form-control-solid-bordered m-b-sm"
                            placeholder="Kullanici Ad Soyad" id="name" name="name"
                            value="{{ isset($users) ? $users->name : '' }}">

                        <label for="password" class="form-label">Parola</label>
                        <input type="password" id="password"
                            class="form-control form-control-solid-bordered m-b-sm
                            @if ($errors->has('password')) border-danger @endif"
                            placeholder="Parola" name="password" value="" required>

                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control form-control-solid-bordered m-b-sm" placeholder="Email"
                            id="email" name="email" value="{{ isset($users) ? $users->email : '' }}">

                        <hr>
                        <div class="col-6 mx-auto mt-5">
                            <button type="button" id="btnSave"
                                class="btn btn-success btn-rounded w-100">{{ isset($users) ? 'Update' : 'Create' }}
                                User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let name = $('#name');
        let email = $('#email');

        $(document).ready(function() {
            $('#btnSave').click(function() {
                if (name.val().trim() === "" || name.val().trim() == null) {
                    Swal.fire({
                        title: "Uyari",
                        text: "Kullanici ad-soyad bos birakilamaz!",
                        confirmButtonText: "Tamam",
                        icon: "info"
                    });
                } else if (email.val().trim() === "" || email.val().trim() == null) {
                    Swal.fire({
                        title: "Uyari",
                        text: "Kullanici email bos birakilamaz!",
                        confirmButtonText: "Tamam",
                        icon: "info"
                    });
                } else {
                    $('#userForm').submit();
                }
            });
        });
    </script>
@endsection
