<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\BusinessField;
use App\Models\BusinessType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusinessTypeController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(BusinessField $businessField){
		$this->authorize('view-any', BusinessType::class);

		return view('admin.business-types.index', compact('businessField'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(BusinessField $businessField){
		$this->authorize('create', BusinessType::class);

		return view('admin.business-types.create', compact('businessField'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request, BusinessField $businessField){
		$this->authorize('create', BusinessType::class);

		$request->validate([
			'name' => [
				'required', 'string', 'max:255',
				Rule::unique(BusinessType::class)
			]
		]);

		$businessTypes = new BusinessType();
		$businessTypes->businessField()->associate($businessField);
		$businessTypes->name = $request->name;
		$businessTypes->save();

		return redirect()->route('admin.business-fields.business-types.index', $businessField)->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @param  \App\Models\BusinessType  $businessType
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessField $businessField, BusinessType $businessType){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @param  \App\Models\BusinessType  $businessType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(BusinessField $businessField, BusinessType $businessType){
		$this->authorize('update', $businessType);

		return view('admin.business-types.edit', compact('businessType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessField  $businessField
     * @param  \App\Models\BusinessType  $businessType
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, BusinessField $businessField, BusinessType $businessType){
		$this->authorize('update', $businessType);

		$request->validate([
			'name' => [
				'required', 'string', 'max:255',
				Rule::unique(BusinessType::class)->ignoreModel($businessType)
			]
		]);

		$businessType->name = $request->name;
		$businessType->save();

		return redirect()->route('admin.business-fields.business-types.index', $businessType->businessField)->with('success', 'Data telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @param  \App\Models\BusinessType  $businessType
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(BusinessField $businessField, BusinessType $businessType){
		$this->authorize('delete', $businessType);

		$businessType->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
