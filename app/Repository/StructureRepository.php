<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\StructureFilter;
use App\Interfaces\StructureInterface;
use App\Models\Structure;

class StructureRepository extends BaseRepositoryImplementation implements StructureInterface
{
    public function model()
    {
        return Structure::class;
    }

    public function addStructure($data)
    {
        $structure = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($structure), ApiResponseCodes::CREATED);
    }

    public function updateStructure(Structure $structure, $data)
    {
        $newStructure = $this->updateById($structure->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newStructure));
    }

    public function deleteStructure(Structure $structure)
    {
        $this->deleteById($structure->id);
        return ApiResponseHelper::sendMessageResponse('delete structure successfully');
    }

    public function showStructure(Structure $structure)
    {
        $showStructure = $this->getById($structure->id, ['id', 'name', 'name_ar']);
        return ApiResponseHelper::sendResponse(new Result($showStructure));
    }

    public function indexStructure(StructureFilter $filters)
    {
        if (! is_null($filters->getName())) {
            $this->where('name', '%'.$filters->getName().'%', 'like');
        }
        if (! is_null($filters->getNameAr())) {
            $this->where('name_ar', '%'.$filters->getNameAr().'%', 'like');
        }
        $structures = $this->paginate($filters->per_page, ['id', 'name', 'name_ar'], 'page', $filters->page);
        $pagination = [
            'total' => $structures->total(),
            'current_page' => $structures->currentPage(),
            'last_page' => $structures->lastPage(),
            'per_page' => $structures->perPage(),
        ];

        return ApiResponseHelper::sendResponseWithPagination(new Result($structures->items(), 'get structures successfully', $pagination));
    }
}
