@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" data-toast-message="{{ session('success') }}">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif
@if (session('error') || $errors->has('pita') || $errors->has('kategori'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-octagon-fill me-2"></i>
        {{ session('error') ?? $errors->first('pita') ?? $errors->first('kategori') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif
