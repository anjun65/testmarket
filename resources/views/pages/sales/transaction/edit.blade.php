@extends('layouts.sales')


@section('title')
    Transactions
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transactions</h2>
            <p class="dashboard-subtitle">
                Edit Transactions
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
                            <form action="{{ route('transactions-sales.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('sales-generate-pdf', $item->id) }}" class="btn btn-primary px-5">
                                            Cetak Invoice
                                        </a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->user->name }}" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Produk</th>
                                                        <th>Gambar</th>
                                                        <th>QTY</th>
                                                        <th>Harga Satuan</th>
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($transaction_details as $detail)
                                                    <tr>
                                                        <td>
                                                            {{ $detail->product->name }}
                                                        </td>
                                                        <td>
                                                            
                                                            <img
                                                                src="{{ Storage::url($detail->product->galleries->first()->photos) ?? '' }}"
                                                                class="w-50"/>
                                                        </td>
                                                        <td>{{ $detail->total }}</td>
                                                        <td>{{ $detail->price }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Harga</label>

                                            <input type="text" name="name" class="form-control" value="{{ number_format($item->total_price)}}" disabled>
                                        </div>
                                    </div>

                                    @if ($item->address_id == 0)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Metode Pengambilan</label>
                                            <input type="text" name="name" class="form-control" value="Jemput Sendiri" disabled>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address 1</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->address->address1 }}" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->address->address2 }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input type="text" name="name" class="form-control" value="{{ App\Models\Province::find($item->address->province)->name }}" disabled>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input type="text" name="name" class="form-control" value="{{ App\Models\Regency::find($item->address->city)->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->address->zip }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor HP</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->address->mobile }}" disabled>
                                        </div>
                                    </div>
                                    @endif
                                    

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="transaction_status" class="form-control">
                                            <option value={{ $item->transaction_status }} selected>{{ $item->transaction_status }}</option>
                                            
                                            @foreach (App\Transaction::STATUSES as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                            
                                            </select>
                                        </div>
                                    </div>

                                    @isset($item->last_edited)
                                        @if($item->last_edited != 0)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Last Edited by {{ $item->last_edit->name }}</label>
                                            </div>
                                        </div>
                                        @endif
                                    @endisset
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