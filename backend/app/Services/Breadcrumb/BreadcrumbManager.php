<?php

namespace App\Services\Breadcrumb;

use App\Data\Breadcrumb\BreadcrumbItemData;
use Illuminate\Support\Collection;

class BreadcrumbManager
{
    /** @var Collection<BreadcrumbItemData> */
    protected Collection $breadcrumbs;

    /**
     * Initialize the breadcrumb manager with an empty collection.
     */
    public function __construct()
    {
        $this->breadcrumbs = collect();
    }

    /**
     * Add a new breadcrumb item to the collection.
     */
    public function add(string $title, ?string $url = null): self
    {
        $this->breadcrumbs->push(
            BreadcrumbItemData::from([
                'title' => $title,
                'url' => $url,
                'isActive' => is_null($url),
            ]),
        );

        return $this;
    }

    /**
     * Add the home page breadcrumb item.
     */
    public function addHome(): self
    {
        return $this->add(trans('pages.home.breadcrumbs'), '/');
    }

    /**
     * Add the 404 not found page breadcrumb item.
     */
    public function addNotFound(): self
    {
        return $this->add(trans('pages.errors.404.breadcrumbs'));
    }

    /**
     * Get the collection of breadcrumb items.
     */
    public function get(): Collection
    {
        return $this->breadcrumbs;
    }

    /**
     * Returns the breadcrumb information as a BreadcrumbItemData collection.
     */
    public function toData()
    {
        return BreadcrumbItemData::collect($this->breadcrumbs);
    }

    /**
     * Check if the breadcrumb collection is empty.
     */
    public function isEmpty(): bool
    {
        return $this->breadcrumbs->isEmpty();
    }

    /**
     * Clear all breadcrumb items from the collection.
     */
    public function clear(): self
    {
        $this->breadcrumbs = collect();

        return $this;
    }
}
