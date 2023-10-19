@extends('layouts.index')

@section('title')
    Publisher List
@endsection

@section('css')
    <style>
        .table-hover>tbody>tr:hover {
            --bs-table-hover-bg: transparent;
            background: #451952;
            color: #F99417;
        }

        table th,
        tr,
        td {
            vertical-align: middle !important;
            height: 60px;
            text-align: center;
        }
    </style>
@endsection

@section('contentTitle')
    Publisher List
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <table class="display table table-striped table-hover" style="width:100%" role="grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Book</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publishers as $publisher)
                                <tr id="row-{{ $publisher->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $publisher->name }}</td>
                                    @foreach ($publisher->books as $book)
                                        <td>{{ $book->title }}</td>
                                        {{-- <td>{{ isset($book) ? $book->title : 'bos birak' }}</td> --}}
                                    @endforeach
                                    <td>{{ Carbon\Carbon::parse($publisher->created_at)->translatedFormat('d F Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($publisher->updated_at)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('publisher.edit', ['id' => $publisher->id]) }}"
                                                class="btn btn-warning btn-sm me-2">
                                                <i class="material-icons ms-0">edit</i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDelete"
                                                data-id="{{ $publisher->id }}" data-name="{{ $publisher->name }}">
                                                <i class="material-icons ms-0">delete</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Book</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center">
            {{ $publishers->onEachside(1)->links() }}
        </div> --}}
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            // delete jq-ajax
            $('.btnDelete').click(function() {
                let id = $(this).data('id');

                $.ajax({
                    method: "POST",
                    url: "{{ route('publisher.delete') }}",
                    data: {
                        "_method": "DELETE",
                        id: id
                    },
                    async: false,
                    success: function(data) {

                        $('#row-' + id).remove();
                    },
                    error: function() {
                        console.log("hata geldi");
                    }
                })

            });
        });
    </script>
@endsection
