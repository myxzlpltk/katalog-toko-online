<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\FeedPlan;
use App\Models\FeedPlanDesign;
use Illuminate\Http\Request;

class FeedPlanDesignController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Http\Response
     */
    public function index(FeedPlan $feedPlan){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(FeedPlan $feedPlan){
        $this->authorize('create', [FeedPlanDesign::class, $feedPlan]);

        return view('console.feed-plan-designs.create', compact('feedPlan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Http\JsonResponse
	 */
    public function store(Request $request, FeedPlan $feedPlan){
		$this->authorize('create', [FeedPlanDesign::class, $feedPlan]);

		$request->validate([
			'file' => 'required|image|max:2048'
		]);

		$path = $request->file('file')->store('designs');

		$feedPlanDesign = new FeedPlanDesign();
		$feedPlanDesign->design = basename($path);
		$feedPlan->designs()->save($feedPlanDesign);

		return response()->json(['file' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return \Illuminate\Http\Response
     */
    public function show(FeedPlan $feedPlan, FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return \Illuminate\Http\Response
     */
    public function edit(FeedPlan $feedPlan, FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeedPlan  $feedPlan
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeedPlan $feedPlan, FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(FeedPlan $feedPlan, FeedPlanDesign $feedPlanDesign){
        $this->authorize('delete', $feedPlanDesign);

        $feedPlanDesign->delete();

		return redirect()->back()->with('success', 'Data telah dihapus.');
    }
}
