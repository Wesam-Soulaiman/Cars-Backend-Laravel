<?php

namespace App\Filter;

//class ProductFilter extends BaseFilter
//{
//    public function __construct()
//    {
//        $this->id = null;
//        $this->name = null;
//        $this->MaxPrice = null;
//        $this->MinPrice = null;
//        $this->structure_id = null;
//        $this->brand_id = null;
//        $this->model_id = null;
//        $this->store_id = null;
//        $this->minYear = null;
//        $this->maxYear = null;
//        $this->type = null;
//        $this->fuel_type_id = null;
//        $this->color_id = null;
//        $this->gear_id = null;
//        $this->light_id = null;
//        $this->deal_id = null;
//        $this->cylinders = null;
//        $this->cylinder_capacity = null;
//        $this->drive_type = null;
//        $this->number_of_seats = null;
//        $this->sunroof = null;
//        $this->additional_features = null;
//    }
//
//    protected ?int $id;
//    protected ?string $name;
//    protected ?string $type;
//    protected ?int $fuel_type_id;
//    protected ?int $color_id;
//    protected ?int $gear_id;
//    protected ?int $light_id;
//    protected ?int $deal_id;
//    protected ?float $MaxPrice;
//    protected ?float $MinPrice;
//    protected ?int $brand_id;
//    protected ?int $structure_id;
//    protected ?int $model_id;
//    protected ?int $store_id;
//    protected ?string $minYear;
//    protected ?string $maxYear;
//    protected ?int $cylinders;
//    protected ?float $cylinder_capacity;
//    protected ?int $drive_type;
//    protected ?int $number_of_seats;
//    protected ?bool $sunroof;
//    protected ?string $additional_features;
//
//    public function getId(): ?int { return $this->id; }
//    public function setId(?int $id): void { $this->id = $id; }
//
//    public function getName(): ?string { return $this->name; }
//    public function setName(?string $name): void { $this->name = $name; }
//
//    public function getMaxPrice(): ?float { return $this->MaxPrice; }
//    public function setMaxPrice(?float $MaxPrice): void { $this->MaxPrice = $MaxPrice; }
//
//    public function getMinPrice(): ?float { return $this->MinPrice; }
//    public function setMinPrice(?float $MinPrice): void { $this->MinPrice = $MinPrice; }
//
//    public function getStructureId(): ?int { return $this->structure_id; }
//    public function setStructureId(?int $structure_id): void { $this->structure_id = $structure_id; }
//
//    public function getBrandId(): ?int { return $this->brand_id; }
//    public function setBrandId(?int $brand_id): void { $this->brand_id = $brand_id; }
//
//    public function getModelId(): ?int { return $this->model_id; }
//    public function setModelId(?int $model_id): void { $this->model_id = $model_id; }
//
//    public function getStoreId(): ?int { return $this->store_id; }
//    public function setStoreId(?int $store_id): void { $this->store_id = $store_id; }
//
//    public function getMinYear(): ?string { return $this->minYear; }
//    public function setMinYear(?string $minYear): void { $this->minYear = $minYear; }
//
//    public function getMaxYear(): ?string { return $this->maxYear; }
//    public function setMaxYear(?string $maxYear): void { $this->maxYear = $maxYear; }
//
//    public function getType(): ?string { return $this->type; }
//    public function setType(?string $type): void { $this->type = $type; }
//
//    public function getFuelTypeId(): ?int { return $this->fuel_type_id; }
//    public function setFuelTypeId(?int $fuel_type_id): void { $this->fuel_type_id = $fuel_type_id; }
//
//    public function getColorId(): ?int { return $this->color_id; }
//    public function setColorId(?int $color_id): void { $this->color_id = $color_id; }
//
//    public function getGearId(): ?int { return $this->gear_id; }
//    public function setGearId(?int $gear_id): void { $this->gear_id = $gear_id; }
//
//    public function getLightId(): ?int { return $this->light_id; }
//    public function setLightId(?int $light_id): void { $this->light_id = $light_id; }
//
//    public function getDealId(): ?int { return $this->deal_id; }
//    public function setDealId(?int $deal_id): void { $this->deal_id = $deal_id; }
//
//    public function getCylinders(): ?int { return $this->cylinders; }
//    public function setCylinders(?int $cylinders): void { $this->cylinders = $cylinders; }
//
//    public function getCylinderCapacity(): ?float { return $this->cylinder_capacity; }
//    public function setCylinderCapacity(?float $cylinder_capacity): void { $this->cylinder_capacity = $cylinder_capacity; }
//
//    public function getDriveType(): ?int { return $this->drive_type; }
//    public function setDriveType(?int $drive_type): void { $this->drive_type = $drive_type; }
//
//    public function getNumberOfSeats(): ?int { return $this->number_of_seats; }
//    public function setNumberOfSeats(?int $number_of_seats): void { $this->number_of_seats = $number_of_seats; }
//
//    public function getSunroof(): ?bool { return $this->sunroof; }
//    public function setSunroof(?bool $sunroof): void { $this->sunroof = $sunroof; }
//
//    public function getAdditionalFeatures(): ?string { return $this->additional_features; }
//    public function setAdditionalFeatures(?string $additional_features): void { $this->additional_features = $additional_features; }
//}



class ProductFilter extends BaseFilter
{
    public function __construct()
    {
        $this->brand_id = null;
        $this->store_id = null;
        $this->model_id = null;
        $this->color_id = null;
        $this->fuel_type_id = null;
        $this->gear_id = null;
        $this->light_id = null;
        $this->deal_id = null;
        $this->structure_id = null;
        $this->minPrice = null;
        $this->maxPrice = null;
        $this->mileage = null;
        $this->minYear = null;
        $this->maxYear = null;
        $this->minRegisterYear = null;
        $this->maxRegisterYear = null;
        $this->number_of_seats = null;
        $this->drive_type = null;
        $this->cylinders = null;
        $this->cylinder_capacity = null;
        $this->creation_country = null;
        $this->used = null;
        $this->sunroof = null;
        $this->type = null;
        $this->order = null;
        $this->orderBy = null;
    }

    protected ?int $brand_id;
    protected ?int $store_id;
    protected ?int $model_id;
    protected ?int $color_id;
    protected ?int $fuel_type_id;
    protected ?int $gear_id;
    protected ?int $light_id;
    protected ?int $deal_id;
    protected ?int $structure_id;
    protected ?float $minPrice;
    protected ?float $maxPrice;
    protected ?int $mileage;
    protected ?int $minYear;
    protected ?int $maxYear;
    protected ?int $minRegisterYear;
    protected ?int $maxRegisterYear;
    protected ?int $number_of_seats;
    protected ?int $drive_type;
    protected ?int $cylinders;
    protected ?float $cylinder_capacity;
    protected ?string $creation_country;
    protected ?bool $used;
    protected ?bool $sunroof;
    protected ?string $type;
    public ?string $order;
     public ?string $orderBy;

    public function getBrandId(): ?int { return $this->brand_id; }
    public function setBrandId(?int $brand_id): void { $this->brand_id = $brand_id; }
    public function getStoreId(): ?int { return $this->store_id; }
    public function setStoreId(?int $store_id): void { $this->store_id = $store_id; }
    public function getModelId(): ?int { return $this->model_id; }
    public function setModelId(?int $model_id): void { $this->model_id = $model_id; }
    public function getColorId(): ?int { return $this->color_id; }
    public function setColorId(?int $color_id): void { $this->color_id = $color_id; }
    public function getFuelTypeId(): ?int { return $this->fuel_type_id; }
    public function setFuelTypeId(?int $fuel_type_id): void { $this->fuel_type_id = $fuel_type_id; }
    public function getGearId(): ?int { return $this->gear_id; }
    public function setGearId(?int $gear_id): void { $this->gear_id = $gear_id; }
    public function getLightId(): ?int { return $this->light_id; }
    public function setLightId(?int $light_id): void { $this->light_id = $light_id; }
    public function getDealId(): ?int { return $this->deal_id; }
    public function setDealId(?int $deal_id): void { $this->deal_id = $deal_id; }
    public function getStructureId(): ?int { return $this->structure_id; }
    public function setStructureId(?int $structure_id): void { $this->structure_id = $structure_id; }
    public function getMinPrice(): ?float { return $this->minPrice; }
    public function setMinPrice(?float $minPrice): void { $this->minPrice = $minPrice; }
    public function getMaxPrice(): ?float { return $this->maxPrice; }
    public function setMaxPrice(?float $maxPrice): void { $this->maxPrice = $maxPrice; }
    public function getMileage(): ?int { return $this->mileage; }
    public function setMileage(?int $mileage): void { $this->mileage = $mileage; }
    public function getMinYear(): ?int { return $this->minYear; }
    public function setMinYear(?int $minYear): void { $this->minYear = $minYear; }
    public function getMaxYear(): ?int { return $this->maxYear; }
    public function setMaxYear(?int $maxYear): void { $this->maxYear = $maxYear; }
    public function getMinRegisterYear(): ?int { return $this->minRegisterYear; }
    public function setMinRegisterYear(?int $minRegisterYear): void { $this->minRegisterYear = $minRegisterYear; }
    public function getMaxRegisterYear(): ?int { return $this->maxRegisterYear; }
    public function setMaxRegisterYear(?int $maxRegisterYear): void { $this->maxRegisterYear = $maxRegisterYear; }
    public function getNumberOfSeats(): ?int { return $this->number_of_seats; }
    public function setNumberOfSeats(?int $number_of_seats): void { $this->number_of_seats = $number_of_seats; }
    public function getDriveType(): ?int { return $this->drive_type; }
    public function setDriveType(?int $drive_type): void { $this->drive_type = $drive_type; }
    public function getCylinders(): ?int { return $this->cylinders; }
    public function setCylinders(?int $cylinders): void { $this->cylinders = $cylinders; }
    public function getCylinderCapacity(): ?float { return $this->cylinder_capacity; }
    public function setCylinderCapacity(?float $cylinder_capacity): void { $this->cylinder_capacity = $cylinder_capacity; }
    public function getCreationCountry(): ?string { return $this->creation_country; }
    public function setCreationCountry(?string $creation_country): void { $this->creation_country = $creation_country; }
    public function getUsed(): ?bool { return $this->used; }
    public function setUsed(?bool $used): void { $this->used = $used; }
    public function getSunroof(): ?bool { return $this->sunroof; }
    public function setSunroof(?bool $sunroof): void { $this->sunroof = $sunroof; }
    public function getType(): ?string { return $this->type; }
    public function setType(?string $type): void { $this->type = $type; }
    public function getOrder(): ?string { return $this->order; }
    public function setOrder(?string $order): void { $this->order = $order; }
    public function getOrderBy(): ?string { return $this->orderBy; }
    public function setOrderBy(?string $orderBy): void { $this->orderBy = $orderBy; }
}
