<?php

namespace App\DataTables;

use App\Models\Student;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable{

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
			->editColumn('name', function (Student $student){
				return $student->user->name;
			})
			->editColumn('email', function (Student $student){
				return $student->user->email;
			})
			->editColumn('business', function (Student $student){
				return optional($student->business)->name ?? "-";
			})
			->addColumn('action', 'console.students.action');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Student $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Student $model){
		return $model->newQuery()
			->has('user')
			->with('user')
			->with('business');
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html(){
		return $this->builder()
			->setTableId('student-table')
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
			Column::make('nim')->title('NIM'),
			Column::make('name', 'user.name')->title('Nama'),
			Column::make('email', 'user.email')->title('Email'),
			Column::make('business', 'business.name')->title('Usaha'),
			Column::computed('action')->title('Aksi'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename(){
		return 'Student_' . date('YmdHis');
	}
}
