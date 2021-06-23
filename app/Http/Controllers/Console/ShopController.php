<?php

namespace App\Http\Controllers\Console;

use App\DataTables\ReviewDataTable;
use App\DataTables\Scopes\PublishedReview;
use App\DataTables\Scopes\ShopFilter;
use App\DataTables\ShopDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ShopController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShopDataTable $dataTable){
        return $dataTable->render('admin.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(){
    	$categories = Category::all();

        return view('admin.shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request){
		$request->validate([
			'name' => 'required|string|max:255',
			'category_id' => ['required', Rule::exists(Category::class, 'id')],
			'description' => 'required|string',
			'address' => 'required|string|max:255',
			'phone_number' => 'required|string|max:255',
			'logo' => 'nullable|image|max:2048',
			'min_price' => 'exclude_if:max_price,null|nullable|integer|lte:max_price',
			'max_price' => 'exclude_if:min_price,null|nullable|integer|gte:min_price',
			'sunday_open' => 'nullable|date_format:H:i',
			'sunday_close' => 'nullable|date_format:H:i|after:sunday_open',
			'monday_open' => 'nullable|date_format:H:i',
			'monday_close' => 'nullable|date_format:H:i|after:monday_open',
			'tuesday_open' => 'nullable|date_format:H:i',
			'tuesday_close' => 'nullable|date_format:H:i|after:tuesday_open',
			'wednesday_open' => 'nullable|date_format:H:i',
			'wednesday_close' => 'nullable|date_format:H:i|after:wednesday_open',
			'thursday_open' => 'nullable|date_format:H:i',
			'thursday_close' => 'nullable|date_format:H:i|after:thursday_open',
			'friday_open' => 'nullable|date_format:H:i',
			'friday_close' => 'nullable|date_format:H:i|after:friday_open',
			'saturday_open' => 'nullable|date_format:H:i',
			'saturday_close' => 'nullable|date_format:H:i|after:saturday_open',
		]);

    	$shop = new Shop();
		$shop->name = $request->name;
		$shop->category_id = $request->category_id;
		$shop->description = $request->description;
		$shop->address = $request->address;
		$shop->phone_number = $request->phone_number;
		$shop->min_price = $request->min_price;
		$shop->max_price = $request->max_price;
		$shop->sunday_open = $request->sunday_open;
		$shop->sunday_close = $request->sunday_close;
		$shop->monday_open = $request->monday_open;
		$shop->monday_close = $request->monday_close;
		$shop->tuesday_open = $request->tuesday_open;
		$shop->tuesday_close = $request->tuesday_close;
		$shop->wednesday_open = $request->wednesday_open;
		$shop->wednesday_close = $request->wednesday_close;
		$shop->thursday_open = $request->thursday_open;
		$shop->thursday_close = $request->thursday_close;
		$shop->friday_open = $request->friday_open;
		$shop->friday_close = $request->friday_close;
		$shop->saturday_open = $request->saturday_open;
		$shop->saturday_close = $request->saturday_close;

		if($request->file('logo')){
			$image = Image::make($request->file('logo'));
			$dim = min($image->width(), $image->height(), 500);

			$shop->logo = Str::random(64).'.jpg';
			Storage::put("logos/$shop->logo", $image->fit($dim)->encode('jpg', 80));
		}

		$shop->save();

		return redirect()->route('admin.shops.show', $shop)->with('success', 'Data telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Shop $shop, ReviewDataTable $dataTable){
    	$shop->load('category');
    	$shop->loadAvg('public_reviews', 'rating');

        return $dataTable
			->addScope(new ShopFilter($shop))
			->addScope(new PublishedReview())
			->render('admin.shops.view', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Shop $shop){
		$categories = Category::all();

        return view('admin.shops.edit', compact('categories', 'shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Shop $shop){
		$request->validate([
			'name' => 'required|string|max:255',
			'category_id' => ['required', Rule::exists(Category::class, 'id')],
			'description' => 'required|string',
			'address' => 'required|string|max:255',
			'phone_number' => 'required|string|max:255',
			'logo' => 'nullable|image|max:2048',
			'min_price' => 'exclude_if:max_price,null|nullable|integer|lte:max_price',
			'max_price' => 'exclude_if:min_price,null|nullable|integer|gte:min_price',
			'sunday_open' => 'nullable|date_format:H:i',
			'sunday_close' => 'nullable|date_format:H:i|after:sunday_open',
			'monday_open' => 'nullable|date_format:H:i',
			'monday_close' => 'nullable|date_format:H:i|after:monday_open',
			'tuesday_open' => 'nullable|date_format:H:i',
			'tuesday_close' => 'nullable|date_format:H:i|after:tuesday_open',
			'wednesday_open' => 'nullable|date_format:H:i',
			'wednesday_close' => 'nullable|date_format:H:i|after:wednesday_open',
			'thursday_open' => 'nullable|date_format:H:i',
			'thursday_close' => 'nullable|date_format:H:i|after:thursday_open',
			'friday_open' => 'nullable|date_format:H:i',
			'friday_close' => 'nullable|date_format:H:i|after:friday_open',
			'saturday_open' => 'nullable|date_format:H:i',
			'saturday_close' => 'nullable|date_format:H:i|after:saturday_open',
		]);

		$shop->name = $request->name;
		$shop->category_id = $request->category_id;
		$shop->description = $request->description;
		$shop->address = $request->address;
		$shop->phone_number = $request->phone_number;
		$shop->min_price = $request->min_price;
		$shop->max_price = $request->max_price;
		$shop->sunday_open = $request->sunday_open;
		$shop->sunday_close = $request->sunday_close;
		$shop->monday_open = $request->monday_open;
		$shop->monday_close = $request->monday_close;
		$shop->tuesday_open = $request->tuesday_open;
		$shop->tuesday_close = $request->tuesday_close;
		$shop->wednesday_open = $request->wednesday_open;
		$shop->wednesday_close = $request->wednesday_close;
		$shop->thursday_open = $request->thursday_open;
		$shop->thursday_close = $request->thursday_close;
		$shop->friday_open = $request->friday_open;
		$shop->friday_close = $request->friday_close;
		$shop->saturday_open = $request->saturday_open;
		$shop->saturday_close = $request->saturday_close;

		if($request->file('logo')){
			$image = Image::make($request->file('logo'));
			$dim = min($image->width(), $image->height(), 500);

			$shop->logo = Str::random(64).'.png';
			Storage::put("logos/$shop->logo", $image->fit($dim)->encode('png', 80));
		}

		$shop->save();

		return redirect()->route('admin.shops.show', $shop)->with('success', 'Data telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return string
	 */
    public function destroy(Shop $shop){
        $shop->delete();

        return redirect()->route('admin.shops.index')->with('success', 'Data telah dihapus');
    }
}
