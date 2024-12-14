<div class="offcanvas offcanvas-end" tabindex="-1" id="editProductOffcanvas" aria-labelledby="editProductOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="editProductOffcanvasLabel">
            <i class="feather-edit me-2"></i>Edit Flower Product
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="nama_bunga" class="form-label">Flower Name</label>
                <input type="text" class="form-control @error('nama_bunga') is-invalid @enderror" 
                       id="nama_bunga" 
                       name="nama_bunga" 
                       required>
                @error('nama_bunga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                           class=" form-control @error('harga') is-invalid @enderror" 
                           id="harga" 
                           name="harga" 
                           min="0" 
                           step="1000" 
                           required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Description (Optional)</label>
                <textarea class="form-control" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="image-edit" class="form-label">Flower Image (Leave blank to keep current image)</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image-edit" 
                       name="image" 
                       accept="image/jpeg,image/png,image/jpg">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <div class="mt-2">
                    <img id="image-preview-edit" src="" alt="Current Image" 
                         class="img-fluid" style="display:none; max-height: 200px;">
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="feather-save me-2"></i>Update Flower Product
                </button>
            </div>
        </form>
    </div>
</div>