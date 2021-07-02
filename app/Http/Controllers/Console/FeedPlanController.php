<?php

namespace App\Http\Controllers\Console;

use App\DataTables\FeedPlanDataTable;
use App\DataTables\Scopes\BusinessFilter;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\FeedPlan;
use Illuminate\Http\Request;

class FeedPlanController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(FeedPlanDataTable $dataTable, Business $business){
        $this->authorize('view-any', [FeedPlan::class, $business]);

        return $dataTable
			->addScope(new BusinessFilter($business))
			->render('console.feed-plans.index', compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Business $business){
    	$this->authorize('create', [FeedPlan::class, $business]);

        $feedIndex = max($business->feedplans()->max('feed_index'), 0) + 1;

        return view('console.feed-plans.create', compact('business', 'feedIndex'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request, Business $business){
        $this->authorize('create', [FeedPlan::class, $business]);

		$request->validate([
			'topic' => 'required|string|max:255',
			'content' => 'required|string',
			'caption' => 'required|string',
			'headline' => 'required|string',
			'plan_date' => 'required|date|after:now',
			'brief_image' => 'required|image|max:2048',
		]);

		$feedPlan = new FeedPlan();
		$feedPlan->feed_index = max($business->feedplans()->max('feed_index'), 0) + 1;
		$feedPlan->business()->associate($business);
		$feedPlan->topic = $request->topic;
		$feedPlan->content = $request->get('content');
		$feedPlan->caption = $request->caption;
		$feedPlan->headline = $request->headline;
		$feedPlan->plan_date = $request->plan_date;
		$feedPlan->brief_image = basename($request->file('brief_image')->store('briefs'));
		$feedPlan->save();

		return redirect()->route('console.feed-plans.show', $feedPlan)->with('success', 'Data telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Business $business, FeedPlan $feedPlan){
        $this->authorize('view', $feedPlan);

        $feedPlan->load('designs.feedPlan');
        $feedPlan->load('business');

        return view('console.feed-plans.view', compact('feedPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Business $business, FeedPlan $feedPlan){
		$this->authorize('update', $feedPlan);

		return view('console.feed-plans.edit', compact('feedPlan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Business $business, FeedPlan $feedPlan){
		$this->authorize('update', $feedPlan);

		$request->validate([
			'topic' => 'required|string|max:255',
			'content' => 'required|string',
			'caption' => 'required|string',
			'headline' => 'required|string',
			'plan_date' => 'required|date|after:now',
			'brief_image' => 'nullable|image|max:2048',
		]);

		$feedPlan->topic = $request->topic;
		$feedPlan->content = $request->get('content');
		$feedPlan->caption = $request->caption;
		$feedPlan->headline = $request->headline;
		$feedPlan->plan_date = $request->plan_date;

		if($request->file('brief_image')){
			$feedPlan->brief_image = basename($request->file('brief_image')->store('briefs'));
		}

		$feedPlan->save();

		return redirect()->route('console.feed-plans.show', $feedPlan)->with('success', 'Data telah diperbarui.');
    }

	/**
	 * Show form for updating comment in resource
	 *
	 * @param Business $business
	 * @param FeedPlan $feedPlan
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function editComment(Business $business, FeedPlan $feedPlan){
    	$this->authorize('update-comment', $feedPlan);

    	return view('console.feed-plans.edit-comment', compact('feedPlan'));
	}

	/**
	 * Update comment in resource
	 *
	 * @param Request $request
	 * @param Business $business
	 * @param FeedPlan $feedPlan
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateComment(Request $request, Business $business, FeedPlan $feedPlan){
		$this->authorize('update-comment', $feedPlan);

		$request->validate(['comment' => 'required|string']);

		$feedPlan->comment = $request->comment;
		$feedPlan->save();

		return redirect()->route('console.feed-plans.show', $feedPlan)->with('success', 'Komentar telah diperbarui.');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Business $business, FeedPlan $feedPlan){
		$this->authorize('delete', $feedPlan);

		$feedPlan->delete();

		return redirect()->route('console.businesses.feed-plans.index', $feedPlan->business)->with('success', 'Data telah dihapus.');
    }
}
