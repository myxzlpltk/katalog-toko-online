<?php

namespace App\DataTables;

use App\Models\Business;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BusinessDataTable extends DataTable{

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
			->editColumn('owner', function (Business $business){
				return $business->owner->name;
			})
			->editColumn('teacher', function (Business $business){
				return $business->teacher->name;
			})
			->addColumn('logo', 'console.businesses.logo')
			->addColumn('action', 'console.businesses.action')
			->rawColumns(['logo', 'action']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Business $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Business $model){
		return $model->newQuery()
			->has('owner.user')
			->with('owner.user')
			->has('teacher.user')
			->with('teacher.user');
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html(){
		return $this->builder()
			->setTableId('business-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(2, 'asc')
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
			Column::computed('logo')->title('Logo'),
			Column::make('name')->title('Nama'),
			Column::make('owner', 'owner.name')->title('Direktur'),
			Column::make('teacher', 'teacher.name')->title('Dosen Pembimbing'),
			Column::computed('action')->title('Aksi'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename(){
		return 'Business_' . date('YmdHis');
	}
}
