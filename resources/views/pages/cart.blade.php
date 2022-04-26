@extends('layouts.app')


@section('title')
    Store Cart
@endsection

@section('content')
<div class="page-content page-cart">
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Cart
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table
                class="table table-borderless table-cart"
                aria-describedby="Cart"
              >
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Menu</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  
                  $totalPrice = 0;
                  $totalProduct = 0;

                  @endphp
                  @foreach ($carts as $cart)
                  <tr>
                    <td style="width: 20%;">
                      @if ($cart->product->galleries)
                      <img
                          src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                          alt=""
                          class="cart-image"
                      />
                      @endif
                    </td>
                    <td style="width: 20%;">
                      <div class="product-title">{{ $cart->product->name }}</div>
                    </td>
                    <td style="width: 20%;">
                      <div class="product-title">{{ $cart->product->price }}</div>
                      <div class="product-subtitle">Rupiah</div>
                    </td>

                    <td style="width: 20%;">
                      <div class="product-title">
                        <input id="total_{{ $cart->id }}" cart="{{ $cart->id }}" type="number" class="form-control text-center" value="{{ $cart->total }}" min="1" max="40">
                      </div>
                    </td>

                    <td style="width: 20%;">
                      <form action="{{ route('cart-delete', $cart->id ) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-remove-cart">
                            Remove
                        </button>
                      </form>
                    </td>
                  </tr>
                  @php $totalPrice += $cart->product->price @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            

            
          </div>
          <div class="row">
            <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
 
            @csrf
            <div class="col-12">
              <h2 class="mb-4">Metode Pengiriman Barang</h2>

           
              <div class="form-check">
                <input class="form-check-input" type="radio" value="diantar" name="flexRadioDefault" id="diantar">
                <label class="form-check-label" for="diantar">
                  Diantar  <small class="text-muted"> dikenakan biaya shipment</small>
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" selected type="radio" value="jemput" name="flexRadioDefault" id="jemput">
                <label class="form-check-label" for="jemput">
                  Ambil di Toko
                </label>
              </div>

            </div>
            <div class="col-12 shipping">
              <h2 class="mb-4">Shipping Details</h2>
            </div>

            <div class="col-12 shipping">
            <input type="hidden" name="total_price" value={{  $totalPrice }}>
              <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address_one">Address 1</label>
                    <input
                      type="text"
                      class="form-control form-shipping"
                      id="address_one"
                      aria-describedby="emailHelp"
                      name="address_one"
                      value="Setra Duta Cemara"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address_two">Address 2</label>
                    <input
                      type="text"
                      class="form-control form-shipping"
                      id="address_two"
                      aria-describedby="emailHelp"
                      name="address_two"
                      value="Blok B2 No. 34"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="provinces_id">Province</label>
                    <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                      <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                    </select>
                    <select v-else class="form-control"></select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="regencies_id">City</label>
                    <select name="regencies_id" id="regencies_id" class="form-control form-shipping" v-if="regencies" v-model="regencies_id">
                      <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                    </select>
                    <select v-else class="form-control form-shipping"></select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="zip_code">Postal Code</label>
                    <input
                      type="text"
                      class="form-control form-shipping"
                      id="zip_code"
                      name="zip_code"
                      value="40512"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="country">Country</label>
                    <input
                      type="text"
                      class="form-control form-shipping"
                      id="country"
                      name="country"
                      value="Indonesia"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_number">Mobile</label>
                    <input
                      type="text"
                      class="form-control form-shipping"
                      id="phone_number"
                      name="phone_number"
                      value="628202011111"
                    />
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <hr />
                </div>
                <div class="col-12">
                  <h2>Payment Informations</h2>
                </div>
                <div class="col-6 col-md-6">
                  <div class="product-title text-success">Rp. {{ number_format($totalPrice) ?? 0}}</div>
                  <div class="product-subtitle">Total</div>
                </div>
                <div class="col-6 col-md-6">
                  <button
                    type="submit"
                    class="btn btn-success mt-4 px-4 btn-block"
                  >
                    Checkout Now
                  </button>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>
      </section>
    </div>
@endsection

@push('addon-scripts')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id : null,
          regencies_id : null,
        },
        methods: {
          getProvincesData(){
            var self = this;
            axios.get('{{ route('api-provinces') }}')
            .then(function(response){
              self.provinces = response.data;
            })
          },
          getRegenciesData(){
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
            .then(function(response){
              self.regencies = response.data;
            })
          },
        },

        watch: {
          provinces_id: function(val, oldVal){
            this.regencies_id = null;
            this.getRegenciesData();
          }
        }
      });
    </script>

    <script>
    $(function() {
        var tId;
        $('input[type="number"]').change(function(){
            clearTimeout(tId);
            var cart_id = $(this).attr("cart");
            var cart_total = $(this).val();

            tId=setTimeout(function(){                 
                axios.post('{{ route('api-total-cart') }}', {
                    id: cart_id,
                    user_id: {{ Auth::user()->id }},	
                    total: cart_total,
                })
                .then(function (response) {
                  var total_semua = 0;

                  $('input[type=number]').each(function(){
                     if ($('input[type="number"]').attr('cart')){
                        total_semua = total_semua + parseInt($(this).val());
                     }
                  });

                  $('#total_product').val(total_semua);
                })
                .catch(function (error) {
                  console.log(error);
                });



                
            },750);

            
        });
    });
    </script>
    
    <script>
      

      $( document ).ready(function() {
          $('.shipping').hide();
          $(".form-shipping").attr("disabled", false);

          $('input[type=radio][name=flexRadioDefault]').change(function() {
              if (this.id == 'jemput') {
                  $('.shipping').hide();
                  $(".form-shipping").attr("disabled", true);
              }
              else if (this.id == 'diantar') {
                  $('.shipping').show();
                  $(".form-shipping").attr("disabled", false);
                  
              }
          });
      });
    </script>
@endpush