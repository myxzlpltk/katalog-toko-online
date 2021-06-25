<?php

namespace App\DataTables\Scopes;

use App\Models\Teacher;
use Yajra\DataTables\Contracts\DataTableScope;

class TeacherFilter implements DataTableScope{

	private $teacher;

	public function __construct(Teacher $teacher){
		$this->teacher = $teacher;
	}

	/**
	 * Apply a query scope.
	 *
	 * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
	 * @return mixed
	 */
	public function apply($query){
		return $query->where('teacher_id', $this->teacher->id);
	}
}
