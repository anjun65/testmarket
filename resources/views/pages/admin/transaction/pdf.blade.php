@extends('layouts.pdf')


@section('title')
    Rekap Permintaan
@endsection


@section('content')

<div class="page-content page-home">
    <div class="container">
        <div class="row">
            <table class="table table-borderless" style="border-top: hidden;">
                <tbody>
                    <tr>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-right:hidden;"></td>
                        <td width="10%" style="border-top: hidden;border-left:hidden;border-left:hidden;border-right-color: white;"></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="5">
                            <b>To:</b><br/>
                            {{ $item->user->name }}<br/>
                            @if ($item->address_id != 0)
                            {{ $item->address->address1 }}<br/>
                            {{ $item->address->address2 }}<br/>
                            {{ App\Models\Province::find($item->address->province)->name }}<br/>
                            {{ App\Models\Regency::find($item->address->city)->name }}<br/>
                            @endif
                            
                        </td>
                        <td colspan="5" class="text-right" style="height: 10px">
                            <b>PT. Millenium Baja Prima</b><br/>
                            <img src="{{ asset('images/logo-mil.png') }}" style="width: 50%">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="10">
                            Invoice
                        </td>
                    </tr>

                    <tr>
                        <td colspan="10">
                            Date : {{ $item->created_at->toDateString() }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="10">
                            Dear {{ $item->user->name }},<br/>
                            Thank you for your interest in our company and opportunity to qoute. We are pleased to qoute as follows:
                        </td>
                    </tr>
                </tbody>
            </table>
                    
            <table class="table table-striped">
                <thead>
                    <tr >
                        <th colspan="3">
                            Product
                        </th>
                        <th colspan="4">
                            QTY
                        </th>
                        <th colspan="3">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction_details as $detail)
                    <tr>
                        <td colspan="3" style="border: 1px gray;">
                            {{ $detail->product->name }}
                        </td>
                        <td colspan="4" style="border: 1px gray;">{{ $detail->total }}</td>

                        <td colspan="3" style="border: 1px gray;">Rp.{{ number_format($detail->price) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            
                        </td>
                        <td colspan="4">
                            Total Price
                        </td>
                        <td colspan="3">
                            Rp.{{ number_format($item->total_price) }}
                        </td>
                    </tr>
                    
                </tbody>
              </table>

            
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td colspan="10">
                            All prices quoted are valid for 30 days from the date of stated on the quotation
                        </td>
                        
                    </tr>
        
                    <tr>
                        <td colspan="10">
                            Where you are unsure about any of the information supplied in this quotation, please contact to discuss further as the company will work with you to explain any element you are unsure of.
                        </td>
                        
                    </tr>
        
                    <tr>
                        <td colspan="10">
                            If you require a reasonable breakdown of your quotation please contact the company and we wil try where possible to
        clarify the costs quoted.
                        </td>
                    </tr>
                    
                </tbody>
              </table>

              
        
        </div>

    </div>

    
</div>

@endsection