<?php

namespace App\Interfaces;

use App\Filter\PaginationFilter;
use App\Models\Offer;

interface OfferInterface
{
    public function addOffer($data);

    public function updateOffer(Offer $offer, $data);

    public function deleteOffer(Offer $offer);

    public function showOffer(Offer $offer);

    public function indexOffer(PaginationFilter $filters);

    public function activeOffer($page, $per_page);
}
