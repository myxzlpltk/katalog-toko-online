<?php

namespace App\DataTables;

use App\Models\Dosen;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DosenDataTable extends DataTable{

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
			->editColumn('name', function (Dosen $dosen){
				return $dosen->user->name;
			})
			->editColumn('email', function (Dosen $dosen){
				return $dosen->user->email;
			})
			->addColumn('action', 'admin.dosens.action');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Dosen $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Dosen $model){
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
			->setTableId('dosen-table')
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
		return 'Dosen_' . date('YmdHis');
	}
}
