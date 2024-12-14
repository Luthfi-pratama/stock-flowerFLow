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
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
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
                                        <td>{{ $produk->deskripsi }}</td>
                                        <td>Rp. {{ $produk->harga }}</td>
                                        <td>
                                            <div class="d-flex" role="group">
                                                <button type="button" class="btn btn-warning btn-sm me-2" 
                                                        data-bs-toggle="offcanvas" 
                                                        data-bs-target="#editProductOffcanvas"
                                                        data-nama-bunga="{{ $produk->nama_bunga }}"
                                                        data-harga="{{ $produk->harga }}"
                                                        data-deskripsi="{{ $produk->deskripsi }}"
                                                        data-image="{{ Storage::url($produk->image_path) }}"
                                                        data-produk-id="{{ $produk->id }}">
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
                    
                    {{ $produks->links() }}
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

            document.getElementById('editProductOffcanvas').addEventListener('show.bs.offcanvas', function(event) {
                const button = event.relatedTarget;
                const namaBunga = button.getAttribute('data-nama-bunga');
                const harga = button.getAttribute('data-harga');
                const deskripsi = button.getAttribute('data-deskripsi');
                const image = button.getAttribute('data-image');

                // Set the values in the form
                document.getElementById('nama_bunga').value = namaBunga;
                document.getElementById('harga').value = harga;
                document.getElementById('deskripsi').value = deskripsi;

                // Set the image preview
                const imagePreview = document.getElementById('image-preview-edit');
                imagePreview.src = image;
                imagePreview.style.display = 'block';
            });
        });
    </script>
@endpush