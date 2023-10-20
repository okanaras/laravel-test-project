@extends('layouts.index')

@section('title')
    {{ isset($authors) ? 'Update' : 'Create' }} Author
@endsection

@section('css')
@endsection

@section('contentTitle')
    {{ isset($authors) ? 'Update' : 'Create' }} Author
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ isset($authors) ? 'Update' : 'Create New' }} Author</h2>
            <div class="example-container">
                <div class="example-content">

                    {{-- herhangi bir hata varsa eger --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    {{-- create and update form --}}
                    <form
                        action="{{ isset($authors) ? route('author.edit', ['id' => $authors->id]) : route('author.create') }}"
                        method="POST" id="authorForm">
                        @csrf

                        <label for="name" class="form-label">Author FullName</label>
                        <input type="text" id="name"
                            class="form-control form-control-solid-bordered m-b-sm
                        @if ($errors->has('name')) border-danger @endif"
                            placeholder="FullName" name="name" value="{{ isset($authors) ? $authors->name : '' }}"
                            required>

                        <hr>
                        <div class="col-6 mx-auto mt-5">
                            <button type="button" id="btnSave"
                                class="btn btn-success btn-rounded w-100">{{ isset($authors) ? 'Update' : 'Create' }}
                                Author
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
        // post islemini buttonu submit'e cevirip te yapabilirdim ama ben hem bi degisiklik olsun hem de kendimi biraz denemek amacli bu sekilde gondermeyi daha uygun gordum. (kod fazlaligi konusunda hemfikirim:)
        let name = $('#name');
        $(document).ready(function() {
            $('#btnSave').click(function() {
                if (name.val().trim() === "" || name.val().trim() == null) {
                    Swal.fire({
                        title: "Uyari",
                        text: "Yazar adi bos birakilamaz!",
                        confirmButtonText: "Tamam",
                        icon: "info"
                    });
                } else {
                    $('#authorForm').submit();
                }
            });
        });
    </script>
@endsection
