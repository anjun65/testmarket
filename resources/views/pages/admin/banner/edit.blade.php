@extends('layouts.admin')


@section('title')
    Banner
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Banner</h2>
            <p class="dashb oard-subtitle">
                Edit Banner
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('banner.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                            src="{{ Storage::url($item->photos) }}"
                                            alt=""
                                            class="w-100"
                                        />
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tampilkan ? </label>
                                            <select name="is_show" class="form-control">
                                                <option value="{{ ($item->is_show) }}" selected>
                                                    @if($item->is_show == 1)
                                                        Iya
                                                    @else
                                                        Tidak
                                                    @endif
                                                </option>
                                                <option value="1">Iya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button class="btn btn-success px-5">
                                            Save now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection