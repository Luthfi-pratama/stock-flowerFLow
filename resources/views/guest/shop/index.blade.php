@extends('layouts.user_app')

@section('content')

    <!-- Breadcrumbs Area -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Shop</h3>
                        <ul>
                            <li><a href="{{ route('guest.home') }}">Home</a></li>
                            <li>Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Area -->
    <div class="shop-main-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 col-12 col-custom widget-mt">
                    <div class="row product-row">
                        @foreach($produk as $product)
                        <div class="col-md-6 col-sm-6 col-lg-4 col-custom product-area">
                            <div class="product-item">
                                <div class="single-product position-relative mr-0 ml-0">
                                    <div class="product-image">
                                        <a class="d-block" href="#">
                                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->nama_bunga }}" class="product-image-1 w-100">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title-2"> <a href="#">{{ $product->nama_barang }}</a></h4>
                                        </div>
                                        <div class="product-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star{{ $i <= $product->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price">{{ number_format($product->harga, 2) }}</span>
                                        </div>
                                        <form action="{{ route('user.cart.add') }}" method="POST" class="d-flex align-items-center justify-content-center">
                                            @csrf
                                            <input type="hidden" name="produks_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn product-cart">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-custom">
                            <div class="toolbar-bottom">
                                <div class="pagination">
                                    {{ $produk->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection