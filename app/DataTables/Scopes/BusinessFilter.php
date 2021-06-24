<?php

namespace App\DataTables\Scopes;

use App\Models\Business;
use Yajra\DataTables\Contracts\DataTableScope;

class BusinessFilter implements DataTableScope{

	private $business;

	public function __construct(Business $business){
		$this->business = $business;
	}

	/**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query){
         return $query->where('business_id', $this->business->id);
    }
}
