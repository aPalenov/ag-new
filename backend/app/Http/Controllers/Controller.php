<?php

namespace App\Http\Controllers;

use App\Models\MetaTag;
use App\Services\Breadcrumb\BreadcrumbManager;
use App\Services\Seo\MetaManager;
use Illuminate\Database\Eloquent\Model;

abstract class Controller
{
    protected $meta;

    protected $breadcrumbs;

    protected function meta(): MetaManager
    {
        return $this->meta ??= app(MetaManager::class);
    }

    protected function breadcrumbs(): BreadcrumbManager
    {
        $breadcrumbs = $this->breadcrumbs ??= app(BreadcrumbManager::class);
        $breadcrumbs->addHome();

        return $breadcrumbs;
    }

    protected function breadcrumbsWithoutHome(): BreadcrumbManager
    {
        return $this->breadcrumbs ??= app(BreadcrumbManager::class);
    }

    public function abortNotFound(): void
    {
        $this->meta()->prependTitle(trans('pages.errors.404.meta.title'));

        // Set up breadcrumbs for 404 page
        $this->breadcrumbs()->addNotFound();

        abort(404);
    }

    /**
     * Sets the meta information by determining the source type and applying any replacements provided.
     */
    public function setMetaInfo(Model|string $source, array $replacements = [])
    {
        $metaData = $this->getMetaData($source);
        $metaData = $this->replaceMetaData($metaData, $replacements);
        $this->applyMetaData($metaData);
    }

    /**
     * Retrieves meta data from the given source which could be Model instance or string.
     */
    protected function getMetaData(Model|string $source): array
    {
        if ($source instanceof MetaTag) {
            return $source->toArray();
        } elseif ($source instanceof Model) {
            return $this->getMetaDataFromModel($source);
        } elseif (is_string($source)) {
            return $this->getMetaDataFromString($source);
        }

        return [];
    }

    /**
     * Fetch meta data from a model instance, either by its related MetaTag or default MetaTitle.
     */
    protected function getMetaDataFromModel(Model $model): array
    {
        if (!empty($model->metaTag?->title)) {
            return $model->metaTag->toArray();
        }

        return [
            'title' => $model->getDefaultMetaTitle(),
        ];
    }

    /**
     * Retrieves meta data based on a given string key, typically used for translation.
     */
    protected function getMetaDataFromString(string $source): array
    {
        return trans("pages.{$source}.meta");
    }

    /**
     * Applies the replacements to the meta title within the meta data array.
     */
    protected function replaceMetaData(array $metaData, array $replacements): array
    {
        $fieldsToReplace = ['title', 'description'];

        foreach ($fieldsToReplace as $field) {
            if (!empty($metaData[$field])) {
                foreach ($replacements as $key => $value) {
                    $metaData[$field] = str_replace("{{$key}}", $value, $metaData[$field]);
                }
            }
        }

        return $metaData;
    }

    /**
     * Applies meta data to the page, modifying the title and description accordingly.
     */
    protected function applyMetaData(array $metaData)
    {
        if ($metaData['is_full_title'] ?? false) {
            $this->meta()->setTitle($metaData['title'] ?? '');
        } else {
            $this->meta()->prependTitle($metaData['title'] ?? '');
        }

        $this->meta()->setDescription($metaData['description'] ?? '');
    }
}
