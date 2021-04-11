<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(){
    	$categories = Category::query()
			->withCount('shops')
			->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(){
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request){
        $request->validate([
        	'name' => [
        		'required','string','max:255',
				Rule::unique(Category::class)
			]
		]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category){
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Category $category){
		$request->validate([
			'name' => [
				'required','string','max:255',
				Rule::unique(Category::class)->ignoreModel($category)
			]
		]);

		$category->name = $request->name;
		$category->save();

		return redirect()->route('admin.categories.index')->with('success', 'Data telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return string
	 */
    public function destroy(Category $category){
        if($category->shops()->count()){
        	return redirect()->back()->with('error', 'Data tidak bisa dihapus.');
		}
        else{
        	$category->delete();

			return redirect()->back()->with('success', 'Data telah dihapus.');
		}
    }
}
