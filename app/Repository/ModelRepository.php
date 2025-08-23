<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\ModelFilter;
use App\Http\Resources\ModelResource;
use App\Interfaces\ModelInterface;
use App\Models\Model;

class ModelRepository extends BaseRepositoryImplementation implements ModelInterface
{
    public function model()
    {
        return Model::class;
    }

    public function addModel($data)
    {
        $model = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($model), ApiResponseCodes::CREATED);
    }

    public function updateModel(Model $model, $data)
    {
        $newModel = $this->updateById($model->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newModel));
    }

    public function deleteModel(Model $model)
    {
        $this->deleteById($model->id);

        return ApiResponseHelper::sendMessageResponse('delete model  successfully');
    }

    public function showModel(Model $model)
    {
        $showModel = $this->getById($model->id);
        $showModel = ModelResource::make($showModel);

        return ApiResponseHelper::sendResponse(new Result($showModel));
    }

    public function indexModel(ModelFilter $filters)
    {
        $this->with = ['brand'];
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        if (! is_null($filters->getBrandId())) {
            $this->where('brand_id', $filters->getBrandId());
        }
        $this->orderBy('id', 'DESC');
        $models = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total' => $models->total(),
            'current_page' => $models->currentPage(),
            'last_page' => $models->lastPage(),
            'per_page' => $models->perPage(),
        ];
        $models = ModelResource::collection($models->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($models, 'get models successfully', $pagination));

    }
}
