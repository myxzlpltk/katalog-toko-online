<?php

namespace App\DataTables;

use App\Models\Photo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PhotoDataTable extends DataTable{

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
            ->addColumn('file', 'admin.photos.file')
			->addColumn('action', 'admin.photos.action')
			->rawColumns(['action', 'file']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Photo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Photo $model){
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(){
        return $this->builder()
			->setTableId('photo-table')
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
			Column::computed('file')->title('Foto'),
			Column::make('created_at')->title('Tanggal'),
			Column::computed('action')->title('Aksi'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(){
        return 'Photo_' . date('YmdHis');
    }
}
