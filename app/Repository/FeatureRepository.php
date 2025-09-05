<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\FeatureFilter;
use App\Http\Resources\FeatureResource;
use App\Interfaces\FeatureInterface;
use App\Models\Feature;

class FeatureRepository extends BaseRepositoryImplementation implements FeatureInterface
{
    public function model()
    {
        return Feature::class;
    }

    public function addFeature($data)
    {
        $FAQ = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($FAQ), ApiResponseCodes::CREATED);
    }

    public function updateFeature(Feature $feature, $data)
    {
        $newFeature = $this->updateById($feature->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newFeature));
    }

    public function deleteFeature(Feature $feature)
    {
        $this->deleteById($feature->id);

        return ApiResponseHelper::sendMessageResponse('delete feature  successfully');
    }

    public function showFeature(Feature $feature)
    {
        $showFeature = $this->getById($feature->id);
        $showFeature = FeatureResource::make($showFeature);

        return ApiResponseHelper::sendResponse(new Result($showFeature));
    }

    public function indexFeature(FeatureFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');

        }
        $features = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $features = FeatureResource::collection($features);
        $pagination = [
            'total' => $features->total(),
            'current_page' => $features->currentPage(),
            'last_page' => $features->lastPage(),
            'per_page' => $features->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($features, 'get features successfully', $pagination));
    }
}
