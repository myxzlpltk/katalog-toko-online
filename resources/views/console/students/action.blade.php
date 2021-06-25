<form action="{{ route('console.students.destroy', $id) }}" class="d-inline" method="POST">
	@csrf
	@method('DELETE')

	<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
</form>
