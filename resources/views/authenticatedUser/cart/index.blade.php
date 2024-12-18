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
                                <li>Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->

        <!-- Cart Main Wrapper Start -->
        <div class="cart-main-wrapper mt-no-text">
            <div class="container custom-area">
                <div class="row">
                    <div class="col-lg-12 col-custom">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td class="pro-thumbnail">
                                            <a href="#"><img class="img-fluid" src="{{ Storage::url($item->product->image_path) }}" alt="{{ $item->product->nama_bunga }}" /></a>
                                        </td>
                                        <td class="pro-title"><a href="#">{{ $item->product->nama_bunga }}</a></td>
                                        <td class="pro-price"><span>Rp {{ number_format($item->product->harga, 2) }}</span></td>
                                        <td class="pro-quantity">
                                            <div class="quantity">
                                                <div class="cart-plus-minus">
                                                   <button type="button" class="dec qtybutton" onclick="changeQuantity(this, -1)">-</button>
                                                        <input 
                                                            class="cart-plus-minus-box" 
                                                            name="quantity" 
                                                            value="{{ $item->quantity }}" 
                                                            type="number" 
                                                            min="1" 
                                                            max="10" 
                                                            data-price="{{ $item->product->harga }}" 
                                                            data-id="{{ $item->id }}" 
                                                            onchange="updateQuantityAjax(this)" 
                                                            aria-label="Quantity"
                                                        >
                                                    <button type="button" class="inc qtybutton" onclick="changeQuantity(this, 1)">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pro-subtotal"><span>Rp {{ number_format($item->quantity * $item->product->harga, 2) }}</span></td>
                                        <td class="pro-remove">
                                            <form action="{{ route('user.cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0" onclick="return confirm('Are you sure you want to remove this item?')">
                                                    <i class="lnr lnr-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto col-custom">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Cart Totals</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">Rp {{ number_format($total_spend, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="{{ route('user.transaction.index') }}" class="btn flosun-button primary-btn rounded-0 black-btn w-100">Proceed To Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateQuantityAjax(input) {
                const quantity = parseInt(input.value);
                const cartId = input.getAttribute('data-id');

                if (quantity < 1 || quantity > 10) {
                    input.value = quantity < 1 ? 1 : 10;
                    return;
                }

                const row = input.closest('tr');
                row.classList.add('loading');

                fetch('{{ route('user.cart.update') }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ id: cartId, quantity: quantity }),
                })
                .then(response => {
                    return response.json(); 
                })
                .then(data => {
                    console.log('Response Data:', data);
                    const subTotal = parseFloat(data.subTotal.replace(/,/g, ''));
                    const total = parseFloat(data.total_spend.replace(/,/g, ''));
                    input.closest('tr').querySelector('.pro-subtotal span').textContent = `Rp ${subTotal.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    document.querySelector('.total-amount').textContent = `Rp ${total.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    row.classList.remove('loading');
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                    row.classList.remove('loading');
                    alert('Failed to update quantity. Please try again.');
                });
            }

            window.changeQuantity = function (button, delta) {
                const input = button.closest('.cart-plus-minus').querySelector('input');
                input.value = Math.max(1, Math.min(10, parseInt(input.value) + delta));
                input.dispatchEvent(new Event('change'));
            };

            window.updateQuantityAjax = updateQuantityAjax;
        });

    </script>

@endpush