@extends('layouts.user_app')

@section('content')
    <!-- Breadcrumbs Area -->
    <div class="bg-white">
        <div class="breadcrumbs-area position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="breadcrumb-content position-relative section-content">
                            <h3 class="title-3">Shopping Cart</h3>
                            <ul>
                                <li><a href="{{ route('guest.home') }}">Home</a></li>
                                <li><a href="{{ route('user.cart.index') }}">Cart</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->

        <!-- Checkout Area Start Here -->
        <div class="col-12 col-custom">
            <div class="your-order">
                <h3>Your order</h3>
                <div class="your-order-table table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="cart-product-name">Product</th>
                                <th class="cart-product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr class="cart_item">
                                    <td class="cart-product-name">{{ $item->product->nama_bunga }}<strong class="product-quantity"> × {{ $item->quantity }}</strong></td>
                                    <td class="cart-product-total text-center"><span class="amount">Rp {{ number_format($item->quantity * $item->product->harga, 2) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <th>Cart Subtotal</th>
                                <td class="text-center"><span class="amount">Rp {{ number_format($total_spend, 2) }}</span></td>
                            </tr>
                            <tr class="order-total">
                                <th>Order Total</th>
                                <td class="text-center"><strong><span class="amount">Rp {{ number_format($total_spend, 2) }}</span></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="payment-method">
                    <div class="payment-accordion">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="#payment-1">
                                    <h5 class="panel-title mb-3">
                                        <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Direct Bank Transfer
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body mb-2 mt-2">
                                        <p>Make your payment directly into our bank account. Your order will not be shipped until the funds have cleared.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="#payment-2">
                                    <h5 class="panel-title mb-3">
                                        <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Check Payments
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body mb-2 mt-2">
                                        <p>Pay via check. Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="#payment-3">
                                    <h5 class="panel-title mb-3">
                                        <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            PayPal
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body mb-2 mt-2">
                                        <p>Pay via PayPal, you can pay with your credit card if you don’t have a PayPal account.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-button-payment">
                            <form action="{{ route('user.transaction.placeOrder') }}" method="post" id="orderForm">
                                @csrf
                                <button type="submit" class="btn flosun-button secondary-btn black-color rounded-0 w-100">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            setTimeout(function() {
                window.location.href = "{{ route('guest.shop') }}";
            }, 1000);
        });
    </script>
@endpush
