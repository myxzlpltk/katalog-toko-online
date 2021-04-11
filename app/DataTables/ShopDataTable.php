<?php

namespace App\DataTables;

use App\Models\Shop;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShopDataTable extends DataTable{

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
			->editColumn('category', function (Shop $shop){
				return $shop->category->name;
			})
			->addColumn('action', 'admin.shops.action');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Shop $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Shop $model){
		return $model->newQuery()
			->has('category')
			->with('category');
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html(){
		return $this->builder()
			->setTableId('shop-table')
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
			Column::make('name')->title('Nama Toko'),
			Column::make('category', 'category.name')->title('Kategori'),
			Column::make('address')->title('Alamat'),
			Column::computed('action')->title('Aksi'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename(){
		return 'Shop_' . date('YmdHis');
	}
}
