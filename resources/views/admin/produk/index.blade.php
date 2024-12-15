@extends('layouts.app')

@section('title', 'Flower Products')

@section('body-class', 'page-produk')

@push('styles')
    <style>
        .product-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        
        #toastNotification {
            min-width: 300px;
            max-width: 400px;
            z-index: 1055;
        }

        .input-group {
            position: relative;
        }
        .input-group .form-control {
            border-radius: 0.5rem 0 0 0.5rem;
        }
        .input-group .input-group-text {
            border-radius: 0 0.5rem 0.5rem 0;
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-4">
            @if(session('success'))
                <div id="toastNotification" class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="feather-check-circle me-2"></i>{{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="feather-slack me-2"></i>Flower Products
                    </h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#addProductOffcanvas">
                        <i class="feather-plus-circle me-2"></i>Add New Product
                    </button>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('produk.index') }}" class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ old('search', $search) }}">
                                    <span class="input-group-text">
                                        <i class="feather-search"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="length" class="form-select">
                                    <option value="5" {{ $length == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $length == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ $length == 20 ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="feather-search me-2"></i>Search
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Rating</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($produk->image_path)
                                               <img src="{{ Storage::url($produk->image_path) }}" alt="{{ $produk->nama_bunga }}" class="product-image">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $produk->nama_bunga }}</td>
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($produk->rating))
                                                    <i class="fa fa-star text-warning"></i> 
                                                @elseif ($i <= $produk->rating)
                                                    <i class="fa fa-star-half-o text-warning"></i>
                                                @else
                                                    <i class="fa fa-star-o text-muted"></i>
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{ $produk->deskripsi }}</td>
                                        <td>Rp. {{ $produk->harga }}</td>
                                        <td>
                                            <div class="d-flex" role="group">
                                                <button type="button" class="btn btn-warning btn-sm me-2" 
                                                    data-bs-toggle="offcanvas" 
                                                    data-bs-target="#editProductOffcanvas"
                                                    data-produk-id="{{ $produk->id }}"
                                                    data-nama-bunga="{{ $produk->nama_bunga }}"
                                                    data-harga="{{ $produk->harga }}"
                                                    data-deskripsi="{{ $produk->deskripsi }}"
                                                    data-image="{{ Storage::url($produk->image_path) }}">
                                                    <i class="feather-edit"></i>
                                                </button>
                                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="feather-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No products found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $produks->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.produk.create')
@include('admin.produk.edit')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('toastNotification');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
                toast.show();
            }
            // Image preview for create form
            document.getElementById('image-create')?.addEventListener('change', function(e) {
                const preview = document.getElementById('image-preview-create');
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush