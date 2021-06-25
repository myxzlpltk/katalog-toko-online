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
				return $business->owner->user->name;
			})
			->editColumn('teacher', function (Business $business){
				return $business->teacher->user->name;
			})
			->editColumn('businessType', function (Business $business){
				return $business->businessType->name;
			})
			->editColumn('businessField', function (Business $business){
				return $business->businessType->businessField->name;
			})
			->editColumn('name', function (Business $business){
				return view('console.businesses.name', compact('business'));
			})
			->addColumn('logo', 'console.businesses.logo')
			->addColumn('action', 'console.businesses.action')
			->rawColumns(['logo', 'action', 'name']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Business $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Business $model){
		return $model->newQuery()
			->with('owner.user')
			->with('teacher.user')
			->with('businessType.businessField')
			->has('owner.user')
			->has('teacher.user')
			->has('businessType.businessField');
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
			Column::make('owner', 'owner.user.name')->title('Direktur'),
			Column::make('teacher', 'teacher.user.name')->title('Dosen Pembimbing'),
			Column::computed('action')->title('Aksi'),
			Column::make('businessType', 'businessType.name')->hidden(),
			Column::make('businessField', 'businessType.businessField.name')->hidden(),
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
