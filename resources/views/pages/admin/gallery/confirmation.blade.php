<div class="modal-header">
  <h6 class="modal-title">Konfirmasi</h6>
  <button type="button" class="close" data-dismiss="modal" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <p>Apakah kamu yakin ingin menghapus galeri paket travel ini?</p>
</div>
<div class="modal-footer">
  <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
    @csrf
    @method('delete')
    <button class="btn btn-light" type="button" data-dismiss="modal">Tidak</button>
    <button class="btn btn-primary" type="submit">Yakin</button>
  </form>
</div>