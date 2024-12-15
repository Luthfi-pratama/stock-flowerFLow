<div class="offcanvas offcanvas-end" tabindex="-1" id="editProductOffcanvas" aria-labelledby="editProductOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="editProductOffcanvasLabel">
            <i class="feather-edit me-2"></i>Edit Flower Product
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="edit.nama_bunga" class="form-label">Flower Name</label>
                <input type="text" 
                    class="form-control @error('nama_bunga') is-invalid @enderror" 
                    id="edit.nama_bunga" 
                    name="nama_bunga" 
                    required>
                @error('nama_bunga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="edit.harga" class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" 
                        class="form-control @error('harga') is-invalid @enderror" 
                        id="edit.harga" 
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
                <label for="edit.deskripsi" class="form-label">Description (Optional)</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                        id="edit.deskripsi" 
                        name="deskripsi" 
                        rows="3"></textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image-edit" class="form-label">Flower Image (Optional)</label>
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
                        class="img-fluid" style="max-height: 200px; display: none;">
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editProductOffcanvas = document.getElementById('editProductOffcanvas');

            editProductOffcanvas.addEventListener('show.bs.offcanvas', function (event) {
                const button = event.relatedTarget;

                // Get product data from button attributes
                const produkId = button.getAttribute('data-produk-id');
                const namaBunga = button.getAttribute('data-nama-bunga');
                const harga = button.getAttribute('data-harga');
                const deskripsi = button.getAttribute('data-deskripsi');
                const image = button.getAttribute('data-image');

                // Populate form fields
                document.getElementById('edit.nama_bunga').value = namaBunga;
                document.getElementById('edit.harga').value = harga;
                document.getElementById('edit.deskripsi').value = deskripsi;

                // Update image preview
                const imagePreview = document.getElementById('image-preview-edit');
                imagePreview.src = image || '';
                imagePreview.style.display = image ? 'block' : 'none';

                // Update form action
                const editProductForm = document.getElementById('editProductForm');
                editProductForm.action = `/produk/${produkId}`;
            });
        });
    </script>
@endpush