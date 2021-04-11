<?php

namespace App\DataTables;

use App\Models\Review;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReviewDataTable extends DataTable{

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
			->editColumn('created_at', function (Review $review){
				return $review->created_at->translatedFormat('d F Y');
			})
			->filterColumn('created_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(reviews.created_at,'%d %M %Y') like ?", ["%$keyword%"]);
			})
			->editColumn('shop', function (Review $review){
				return $review->shop->name;
			})
			->addColumn('action', 'admin.reviews.publish');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Review $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Review $model){
		return $model->newQuery()
			->has('shop')
			->with('shop');
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html(){
		return $this->builder()
			->setTableId('review-table')
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
			Column::make('created_at')->title('Tanggal'),
			Column::make('shop', 'shop.name')->title('Toko'),
			Column::make('name')->title('Nama'),
			Column::make('rating')->title('Rating'),
			Column::make('review_text')->title('Review'),
			Column::computed('action')->title('Aksi'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename(){
		return 'Review_' . date('YmdHis');
	}
}
