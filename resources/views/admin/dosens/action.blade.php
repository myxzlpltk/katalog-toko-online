<a href="{{ route('admin.dosens.edit', $id) }}" class="btn btn-warning btn-sm">Edit</a>
<form action="{{ route('admin.dosens.destroy', $id) }}" class="d-inline" method="POST">
	@csrf
	@method('DELETE')

	<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
</form>
