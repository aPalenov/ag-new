<?php

namespace App\Services\PageBuilder;

use App\Data\PageBuilder\PageBuilderBlockData;
use App\Enums\PageBuilder\PageBuilderBlockEnum;
use InvalidArgumentException;

class PageBuilder
{
    protected $blockList = [];

    public function buildPage(string $path): array
    {
        // public function buildPage(Model $model): array
        // $blockData = [];
        // foreach ($model->blocks ?? [] as $block) {
        //     if (array_key_exists($block['type'], $this->getBlockList())) {
        //         $type = PageBuilderBlockEnum::fromName($block['type']);
        //         $blockData[] = new PageBuilderBlockData(
        //             name: $type->value,
        //             data: $this->getBlockFromEnum($type)->viewData($block['data'], $model),
        //         );
        //     }
        // }

        // return $blockData;
        $types = [];

        if (str_ends_with($path, '/pages')) {
            $types = [
                PageBuilderBlockEnum::HeroBanner,
                PageBuilderBlockEnum::ModelSlider,
                PageBuilderBlockEnum::TextContent,
                PageBuilderBlockEnum::OfferSlider,
                PageBuilderBlockEnum::VideoSlider,
                PageBuilderBlockEnum::FeatureList,
                PageBuilderBlockEnum::CarSlider,
                PageBuilderBlockEnum::AsideList,
                PageBuilderBlockEnum::FeatureSlider,
                PageBuilderBlockEnum::MapContacts,
            ];
        } elseif (str_ends_with($path, '/models')) {
            $types = [
                //
                PageBuilderBlockEnum::ModelList,
                PageBuilderBlockEnum::FeatureSlider,
                PageBuilderBlockEnum::TextContent,
            ];
        } elseif (preg_match('/models\/.+/', $path)) {
            // Remove some blocks for models page
            $types = [
                PageBuilderBlockEnum::ModelGeneral,
                PageBuilderBlockEnum::SpecsShort,
                PageBuilderBlockEnum::SpecsTable,
                PageBuilderBlockEnum::ComplectationsTable,
                PageBuilderBlockEnum::TextContent,
                PageBuilderBlockEnum::CarSlider,
            ];
        }

        $blockData = [];
        foreach ($types as $type) {
            $blockData[] = new PageBuilderBlockData(
                name: $type->value,
                data: $this->getBlockFromEnum($type)->viewData()->toArray(),
            );
        }

        return $blockData;
    }

    public function getBlockList(): array
    {
        if (!empty($this->blockList)) {
            return $this->blockList;
        }

        foreach (PageBuilderBlockEnum::options() as $key => $blockClass) {
            $this->blockList[$key] = app("App\\Services\\PageBuilder\\Block\\{$blockClass}Block");
        }

        return $this->blockList;
    }

    public function getBlockFromEnum(PageBuilderBlockEnum $type)
    {
        return $this->getBlockList()[$type->name] ??
            throw new InvalidArgumentException("Block type {$type->name} not found.");
    }
}
