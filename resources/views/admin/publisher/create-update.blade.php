@extends('layouts.index')

@section('title')
    {{ isset($publishers) ? 'Update' : 'Create' }} Publisher
@endsection

@section('css')
@endsection

@section('contentTitle')
    {{ isset($publishers) ? 'Update' : 'Create' }} Publisher
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ isset($publishers) ? 'Update' : 'Create New' }} Publisher</h2>
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
                        action="{{ isset($publishers) ? route('publisher.edit', ['id' => $publishers->id]) : route('publisher.create') }}"
                        method="POST" id="publisherForm">
                        @csrf

                        <label for="name" class="form-label">Publisher FullName</label>
                        <input type="text" id="name"
                            class="form-control form-control-solid-bordered m-b-sm
                        @if ($errors->has('name')) border-danger @endif"
                            placeholder="Publisher FullName" name="name"
                            value="{{ isset($publishers) ? $publishers->name : '' }}" required>

                        <hr>
                        <div class="col-6 mx-auto mt-5">
                            <button type="button" id="btnSave"
                                class="btn btn-success btn-rounded w-100">{{ isset($publishers) ? 'Update' : 'Create' }}
                                Publisher
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
        $(document).ready(function() {
            $('#btnSave').click(function() {
                if (name.val().trim() === "" || name.val().trim() == null) {
                    Swal.fire({
                        title: "Uyari",
                        text: "Yayinevi adi bos birakilamaz!",
                        confirmButtonText: "Tamam",
                        icon: "info"
                    });
                } else {
                    $('#publisherForm').submit();
                }
            });
        });
    </script>
@endsection
