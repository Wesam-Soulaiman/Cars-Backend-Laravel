<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\ColorFilter;
use App\Interfaces\ColorInterface;
use App\Models\Color;

class ColorRepository extends BaseRepositoryImplementation implements ColorInterface
{
    public function model()
    {
        return Color::class;
    }

    public function addColor($data)
    {
        $color = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($color), ApiResponseCodes::CREATED);
    }

    public function updateColor(Color $color, $data)
    {
        $newColor = $this->updateById($color->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newColor));
    }

    public function deleteColor(Color $color)
    {
        $this->deleteById($color->id);
        return ApiResponseHelper::sendMessageResponse('delete color successfully');
    }

    public function showColor(Color $color)
    {
        $showColor = $this->getById($color->id, ['id', 'name', 'name_ar' , 'hex']);
        return ApiResponseHelper::sendResponse(new Result($showColor));
    }

    public function indexColor(ColorFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
            $this->orWhere('name_ar', '%'.$filters->getName().'%', 'like');
        }
        $colors = $this->paginate($filters->per_page, ['id', 'name', 'name_ar' , 'hex'], 'page', $filters->page);
        $pagination = [
            'total' => $colors->total(),
            'current_page' => $colors->currentPage(),
            'last_page' => $colors->lastPage(),
            'per_page' => $colors->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($colors->items(), 'get colors successfully', $pagination));
    }
}
