<?php

namespace App\DataTables;

use App\Models\Teacher;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TeacherDataTable extends DataTable{

	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query){
		return datatables()
			->eloquent($query)
			->addIndexColumn()
			->editColumn('name', function (Teacher $teacher){
				return $teacher->user->name;
			})
			->editColumn('email', function (Teacher $teacher){
				return $teacher->user->email;
			})
			->addColumn('action', 'admin.teachers.action');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Teacher $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Teacher $model){
		return $model->newQuery()
			->has('user')
			->with('user');
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html(){
		return $this->builder()
			->setTableId('teacher-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1, 'asc')
			->parameters([
				'language' => [
					'url' => asset('vendor/datatables/id.json')
				],
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns(){
		return [
			Column::computed('DT_RowIndex')->title('No.'),
			Column::make('nidn')->title('NIDN'),
			Column::make('name', 'user.name')->title('Nama'),
			Column::make('email', 'user.email')->title('Email'),
			Column::computed('action')->title('Aksi'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename(){
		return 'Teacher_' . date('YmdHis');
	}
}
