<a href="{{ route('console.teachers.edit', $id) }}" class="btn btn-warning btn-sm">Edit</a>
<form action="{{ route('console.teachers.destroy', $id) }}" class="d-inline" method="POST">
	@csrf
	@method('DELETE')

	<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
</form>
