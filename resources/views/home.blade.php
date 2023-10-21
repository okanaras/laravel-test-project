@extends('layouts.index')

@section('title')
    Case Study
@endsection

@section('css')
    <style>
        .firstTags {
            text-decoration: none;
            color: #451952;
            font-weight:
        }

        .firstTags:hover,
        .main-header {
            color: #F99417;
        }
    </style>
@endsection

@section('contentTitle')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-danger">
                            <i class="material-icons-outlined">rate_review</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-amount">
                                <span class="main-header">Authors</span>
                            </span>
                            <div>
                                <a href="{{ route('author.create') }}" class="firstTags">
                                    <span>Create</span>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('author.index') }}" class="firstTags">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-easing="ease-in-out">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-danger">
                            <i class="material-icons-outlined">file_download</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-amount">
                                <span class="main-header">Publishers</span>
                            </span>
                            <div>
                                <a href="{{ route('publisher.create') }}" class="firstTags">
                                    <span>Create</span>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('publisher.index') }}" class="firstTags">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-easing="ease-in-out">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-danger">
                            <i class="material-icons-outlined">book </i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-amount">
                                <span class="main-header">Books</span>
                            </span>
                            <div>
                                <a href="{{ route('book.create') }}" class="firstTags">
                                    <span>Create</span>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('book.index') }}" class="firstTags">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-easing="ease-in-out">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-danger">
                            <i class="material-icons-outlined">person</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-amount">
                                <span class="main-header">Users</span>
                            </span>
                            <div>
                                <a href="{{ route('user.create') }}" class="firstTags">
                                    <span>Create</span>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('user.index') }}" class="firstTags">
                                    <span>List</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
