<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Filter\PaginationFilter;
use App\Http\Resources\BannerResource;
use App\Interfaces\BannerInterface;
use App\Models\Banner;

class BannerRepository extends BaseRepositoryImplementation implements BannerInterface
{
    public function model()
    {
        return Banner::class;
    }

    public function addBanner($data)
    {
        $offer = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($offer), ApiResponseCodes::CREATED);
    }

    public function updateBanner(Banner $banner, $data)
    {
        $newBanner = $this->updateById($banner->id, $data);
        if (isset($data['photo'])) {
            deleteImage($banner->photo);
        }
        if (isset($data['photo_ar'])) {
            deleteImage($banner->photo_ar);
        }

        return ApiResponseHelper::sendResponse(new Result($newBanner));
    }

    public function deleteBanner(Banner $banner)
    {
        $this->deleteById($banner->id);
        deleteImage($banner->photo);
        deleteImage($banner->photo_ar);

        return ApiResponseHelper::sendMessageResponse('delete banner  successfully');
    }

    public function showBanner(Banner $banner)
    {
        $showBanner = $this->getById($banner->id);

        $showBanner = BannerResource::make($showBanner);

        return ApiResponseHelper::sendResponse(new Result($showBanner, 'get banner successfully'));

    }

    public function indexBanner(PaginationFilter $filters)
    {

        $banners = $this->paginate($filters->per_page, ['*'], 'page', $filters->page);
        $pagination = [
            'total' => $banners->total(),
            'current_page' => $banners->currentPage(),
            'last_page' => $banners->lastPage(),
            'per_page' => $banners->perPage(),
        ];
        $banners = BannerResource::collection($banners->items());

        return ApiResponseHelper::sendResponseWithPagination(new Result($banners, 'get banners successfully', $pagination));
    }

    public function allBanner()
    {
        $banners = $this->where('active', 1)->get();

        return $banners = BannerResource::collection($banners);

    }
}
