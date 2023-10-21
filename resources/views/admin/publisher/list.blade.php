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
                    {{-- filtreleme bolumu --}}
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-8 my-2 ">
                                <input type="text" class="form-control" value="{{ request()->get('name') }}" name="name"
                                    placeholder="Filtrelemek istediginiz yayinevi adi...">
                            </div>

                            <div class="col-4 my-2 mb-5 text-end justify-content-center d-flex">
                                <button type="submit" class="btn btn-primary w-100 me-2">Filtrele</button>
                                <button type="reset" class="btn btn-warning w-100">Filtreyi Temizle</button>
                            </div>
                            <hr>
                        </div>
                    </form>

                    <table class="display table table-striped table-hover" style="width:100%" role="grid">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Book</th>
                                <th>User</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publishers as $publisher)
                                <tr id="row-{{ $publisher->id }}">
                                    <td>{{ $publisher->name }}</td>
                                    @foreach ($publisher->books as $book)
                                        <td>{{ $book->title }} </td>
                                    @endforeach
                                    <td>{{ isset($book->users?->name) ? $book->users?->name : 'User bulunamadi' }}
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
                                <th># Name</th>
                                <th># Book</th>
                                <th># User</th>
                                <th># Created</th>
                                <th># Updated</th>
                                <th># Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $publishers->onEachside(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            // burada jquery, ajax ve sweetalert2 kullanimi mevcut
            $('.btnDelete').click(function() {
                let id = $(this).data('id');
                let dataName = $(this).data('name');

                Swal.fire({
                    title: dataName + " yayinevini silmek istediğinize emin misiniz?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Evet',
                    denyButtonText: `Hayir`,
                    cancelButtonText: "İptal"
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                Swal.fire({
                                    title: "Basarili",
                                    text: "Yayinevi Silindi",
                                    confirmButtonText: 'Tamam',
                                    icon: "success"
                                });
                            },
                            error: function() {
                                console.log("hata geldi");
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire({
                            title: "Bilgi",
                            text: "Herhangi bir islem yapilmadi",
                            confirmButtonText: 'Tamam',
                            icon: "info"
                        });
                    }
                })
            });

        });

        $('#selectBooks').select2();
    </script>
@endsection
