@if(is_null($published_at))
	<form action="{{ route('admin.reviews.publish', $id) }}" class="d-inline" method="POST">
		@csrf
		@method('PATCH')

		<button type="submit" class="btn btn-primary btn-sm" @confirmation>Publish</button>
	</form>
@endif

<form action="{{ route('admin.reviews.destroy', $id) }}" class="d-inline" method="POST">
	@csrf
	@method('DELETE')

	<button type="submit" class="btn btn-danger btn-sm" @confirmation>Hapus</button>
</form>
