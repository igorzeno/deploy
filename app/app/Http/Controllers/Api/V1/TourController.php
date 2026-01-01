<?php

namespace App\Http\Controllers\Api\V1;

use App\Casts\PriceCast;
use App\Filters\V1\TourFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreTourRequest;
use App\Http\Requests\V1\StoreTourRequest;
use App\Http\Requests\V1\UpdateTourRequest;
use App\Http\Resources\V1\TourCollection;
use App\Http\Resources\V1\TourResource;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new TourFilter();
        $queryItems = $filter->transForm($request);

        if(count($queryItems) == 0){
            return new TourCollection(Tour::paginate());
        }
        else {
            $tours = Tour::where($queryItems)->paginate();
            return new TourCollection($tours->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        return new TourResource(Tour::create($request->all()));
    }

    public function bulkStore(BulkStoreTourRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['travelId', 'startingDate', 'endingDate']);
        });
        Tour::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        return new TourResource($tour);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        return $tour->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
