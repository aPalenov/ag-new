<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\HeroBanner\HeroBannerData;
use Spatie\LaravelData\Data;

class HeroBannerBlock
{
    public function viewData(): ?Data
    {
        return HeroBannerData::from([
            'title' => config('app.tenant'),
            'subtitle' => 'Добро пожаловать',
            'cta' => 'Подробнее',
        ]);
    }
}
