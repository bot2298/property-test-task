<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\V1\PropertyCollection;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->get('limit') ?? 15;

        $property = Property::query();

        if ($request->has('name')) {
            $property->whereRaw("UPPER(`name`) LIKE '%". mb_strtoupper($request->input('name'))."%'");
        }
        if ($request->has('bedrooms')) {
            $property->whereBedrooms($request->input('bedrooms'));
        }
        if ($request->has('bathrooms')) {
            $property->whereBathrooms($request->input('bathrooms'));
        }
        if ($request->has('storeys')) {
            $property->whereStoreys($request->input('storeys'));
        }
        if ($request->has('garages')) {
            $property->whereGarages($request->input('garages'));
        }
        if ($request->has('price_min') or $request->has('price_max')) {
            $minPrice = $request->input('price_min') ?? 0;
            $maxPrice = $request->input('price_max') ?? Property::max('price');
            $property->whereBetween('price',[$minPrice, $maxPrice]);
        }

        return $this->sendResponse(new PropertyCollection($property->paginate($limit)));

    }
}
