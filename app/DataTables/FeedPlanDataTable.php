<?php

namespace App\DataTables;

use App\Models\FeedPlan;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FeedPlanDataTable extends DataTable{

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
			->editColumn('plan_date', function (FeedPlan $feedplan){
				return $feedplan->plan_date->translatedFormat('j F Y H:i');
			})
			->filterColumn('plan_date', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(plan_date,'%d %M %Y %H:%i') like ?", ["%$keyword%"]);
			})
			->addColumn('action', 'console.feed-plans.action');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\FeedPlan $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(FeedPlan $model){
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html(){
		return $this->builder()
			->setTableId('feedplan-table')
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
			Column::make('feed_index')->title('No.'),
			Column::make('plan_date')->title('Tanggal Rencana'),
			Column::make('topic')->title('Topik'),
			Column::computed('action')->title('Aksi'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename(){
		return 'FeedPlan_' . date('YmdHis');
	}
}
