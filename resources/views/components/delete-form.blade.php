@props(['action', 'message' => 'Yakin ingin menghapus data ini?', 'label' => 'Hapus', 'small' => false])
<form method="POST" action="{{ $action }}" class="d-inline" data-confirm="{{ $message }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-{{ $small ? 'sm' : '' }} btn-outline-danger">
        <i class="bi bi-trash3"></i> {{ $label }}
    </button>
</form>
