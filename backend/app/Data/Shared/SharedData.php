<?php

namespace App\Data\Shared;

use App\Data\App\AppData;
use App\Data\Breadcrumb\BreadcrumbItemData;
use App\Data\Navigation\NavigationData;
use App\Data\PageBuilder\PageData;
use App\Data\Seo\MetaData;
use App\Enums\PageBuilder\PageBuilderThemeEnum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SharedData extends Data
{
    public function __construct(
        public AppData $app,

        public SharedSettingsData $settings,

        public NavigationData $navigation,

        public MetaData $meta,

        /** @var DataCollection<BreadcrumbItemData> */
        public DataCollection $breadcrumbs,

        public PageData $page,

        public PageBuilderThemeEnum $theme,
    ) {}
}
