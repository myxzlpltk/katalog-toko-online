<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\BusinessField;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusinessFieldController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(){
    	$this->authorize('view-any', BusinessField::class);

    	$businessFields = BusinessField::withCount('businessTypes')->get();

		return view('console.business-fields.index', compact('businessFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(){
		$this->authorize('create', BusinessField::class);

		return view('console.business-fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request){
		$this->authorize('create', BusinessField::class);

		$request->validate([
			'name' => [
				'required','string','max:255',
				Rule::unique(BusinessField::class)
			]
		]);

		$businessFields = new BusinessField();
		$businessFields->name = $request->name;
		$businessFields->save();

		return redirect()->route('console.business-fields.index')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessField $businessField){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(BusinessField $businessField){
		$this->authorize('update', $businessField);

		return view('console.business-fields.edit', compact('businessField'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, BusinessField $businessField){
		$this->authorize('update', $businessField);

		$request->validate([
			'name' => [
				'required','string','max:255',
				Rule::unique(BusinessField::class)->ignoreModel($businessField)
			]
		]);

		$businessField->name = $request->name;
		$businessField->save();

		return redirect()->route('console.business-fields.index')->with('success', 'Data telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(BusinessField $businessField){
		$this->authorize('delete', $businessField);

		$businessField->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
