@extends('layouts.dashboard')


@section('title')
    Store Dashboard Transactions Details
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">{{ 'INVMBP-'.$transaction->transaction->id ?? '' }}</h2>
        <p class="dashboard-subtitle">
            Transaction Details
        </p>
        </div>
        <div class="dashboard-content" id="transactionDetails">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                    <img
                        src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                        alt=""
                        class="w-100 mb-3"
                    />
                    </div>
                    <div class="col-12 col-md-8">
                    <div class="row">
                        
                        <div class="col-12 col-md-6">
                        <div class="product-title">Nama Product</div>
                        <div class="product-subtitle">
                            {{ $transaction->product->name ?? '' }}
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">
                            Tanggal Transaksi
                        </div>
                        <div class="product-subtitle">
                            {{ $transaction->created_at ?? '' }}
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">Payment Status</div>
                        @if ($transaction->transaction->transaction_status == 'Batal')
                            <div class="product-subtitle text-danger">
                                {{ $transaction->transaction->transaction_status ?? '' }}
                            </div>
                        @else
                            <div class="product-subtitle">
                                {{ $transaction->transaction->transaction_status ?? '' }}
                            </div>
                        @endif
                        
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="product-title">Mobile</div>
                            <div class="product-subtitle">
                                +628 2020 11111
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">Harga Satuan</div>
                        <div class="product-subtitle">Rp. {{ number_format($transaction->price) ?? '' }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">QTY</div>
                        <div class="product-subtitle">
                            {{ $transaction->total }}
                        </div>

                        </div>
                    </div>
                    </div>
                </div>

                @if ($transaction->transaction->address_id == 0)
                <div class="row">
                    <div class="col-12 mt-4">
                        <h5>
                            Metode Pengambilan
                        </h5>
                        <div class="row">
                            <div class="col-6 col-md-6">
                            Jemput Sendiri
                            </div>
                            <div class="col-6 col-md-6">
                                NAGOYA THAMRIN CITY NO. A1 – A3 LUBUK BAJA BATAM, KEPULAUAN RIAU
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <div class="row">
                    <div class="col-12 mt-4">
                    <h5>
                        Alamat Pengiriman
                    </h5>
                    <div class="row">
                        <div class="col-12 col-md-6">
                        <div class="product-title">Address 1</div>
                        <div class="product-subtitle">
                            {{ ($transaction->transaction->address->address1) }}
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">Address 2</div>
                        <div class="product-subtitle">
                            {{ ($transaction->transaction->address->address2) }}
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">
                            {{ ($transaction->transaction->address->address1) }}
                        </div>
                        <div class="product-subtitle">
                            {{ App\Models\Province::find($transaction->transaction->address->province)->name }}
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">City</div>
                        <div class="product-subtitle">
                            {{ App\Models\Regency::find($transaction->transaction->address->city)->name }}
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">Postal Code</div>
                        <div class="product-subtitle">{{ ($transaction->transaction->address->zip) }}</div>
                        </div>
                        <div class="col-12 col-md-6">
                        <div class="product-title">Country</div>
                        <div class="product-subtitle">
                            {{ ($transaction->transaction->address->country) }}
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endif
                
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection

@push('addon-scripts')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
            status: "SHIPPING",
            resi: "BDO12308012132",
        },
        });
    </script>
@endpush