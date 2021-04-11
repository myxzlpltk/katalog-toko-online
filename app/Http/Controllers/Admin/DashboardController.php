<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewDataTable;
use App\DataTables\Scopes\UnpublishedReview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(ReviewDataTable $dataTable, Request $request){
        return $dataTable
			->addScope(new UnpublishedReview())
			->render('admin.dashboard');
    }

}
