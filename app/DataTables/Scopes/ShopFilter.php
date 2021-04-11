<?php

namespace App\DataTables\Scopes;

use App\Models\Shop;
use Yajra\DataTables\Contracts\DataTableScope;

class ShopFilter implements DataTableScope{

	private $shop;

	public function __construct(Shop $shop){
		$this->shop = $shop;
	}

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query){
        return $query->where('shop_id', $this->shop->id);
    }
}
