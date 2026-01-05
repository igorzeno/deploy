<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TravelFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreTravelRequest;
use App\Http\Requests\V1\StoreTravelRequest;
use App\Http\Requests\V1\UpdateTravelRequest;
use App\Http\Resources\V1\TravelCollection;

use App\Http\Resources\V1\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new TravelFilter();
        $queryItems = $filter->transForm($request);
        $includeTours = $request->query('includeTours');

        $travels = Travel::where($queryItems);
        if($includeTours){
            $travels = $travels->with('tours');
        }
//        if ($request->has('fields')) {
//            $fieldsArray = explode(',', $request->fields);
//            $travels = Travel::select($fieldsArray)->where($queryItems);
//        }
        return new TravelCollection($travels->paginate()->appends($request->query()));
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
    public function store(StoreTravelRequest $request)
    {
        return new TravelResource(Travel::create($request->all()));
    }

    public function bulkStore(BulkStoreTravelRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['isPublic', 'numberOfDays']);
        });
        Travel::insert($bulk->toArray());
    }


    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        $includeTours = request()->query('includeTours');
        if($includeTours){
            return new TravelResource($travel->loadMissing('tours'));
        }
        return new TravelResource($travel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        return $travel->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        //
    }
}
