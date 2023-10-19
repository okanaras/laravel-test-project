@extends('layouts.index')

@section('title')
    {{ isset($books) ? 'Update' : 'Create' }} Book
@endsection

@section('css')
@endsection

@section('contentTitle')
    {{ isset($books) ? 'Update' : 'Create' }} Book
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ isset($books) ? 'Update' : 'Create New' }} Book</h2>
            <div class="example-container">
                <div class="example-content">

                    {{-- herhangi bir hata varsa eger --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    {{-- create and update form --}}
                    <form action="{{ isset($books) ? route('book.edit', ['id' => $books->id]) : route('book.create') }}"
                        method="POST" id="bookForm">
                        @csrf
                        <div>
                            <label for="title" class="form-label">Book Title</label>
                            <input type="text" id="title"
                                class="form-control form-control-solid-bordered m-b-sm
                                @if ($errors->has('title')) border-danger @endif"
                                placeholder="Book Title" name="title" value="{{ isset($books) ? $books->title : '' }}"
                                required>
                        </div>

                        <div>
                            <label for="author_id" class="form-label">Choose Author</label>
                            <select class="form-select bg-light m-b-sm" id="author_id" name="author_id">
                                <option value="{{ null }}">Choose Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ isset($books) && $books->author_id == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="publisher_id" class="form-label">Choose Publisher</label>
                            <select class="form-select bg-light m-b-sm" id="publisher_id" name="publisher_id">
                                <option value="{{ null }}">Choose Publisher</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}"
                                        {{ isset($books) && $books->publisher_id == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <div class="col-6 mx-auto mt-5">
                            <button type="button" id="btnSave"
                                class="btn btn-success btn-rounded w-100">{{ isset($books) ? 'Update' : 'Create' }}
                                Book
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
        let name = $('#title');
        let author_id = $('#author_id');
        let publisher_id = $('#publisher_id');

        $(document).ready(function() {
            $('#btnSave').click(function() {
                if (name.val().trim() === "" || name.val().trim() == null) {
                    alert("Title alani bos birakilamaz")
                } else if (author_id.val().trim() === "" || author_id.val().trim() == null) {
                    alert("Yazar alani bos birakilamaz")
                } else if (publisher_id.val().trim() === "" || publisher_id.val().trim() == null) {
                    alert("Yayinci alani bos birakilamaz")
                } else {
                    $('#bookForm').submit();
                }
            });
        });
    </script>
@endsection
