<?php

namespace App\Services\Seo;

use App\Data\Seo\MetaData;

class MetaManager
{
    /**
     * Stores the title separator.
     */
    protected string $titleSeparator = ' – ';

    /**
     * Stores the default title.
     */
    protected string $defaultTitle = '';

    /**
     * Stores the meta title.
     */
    protected string $title = '';

    /**
     * Stores the meta description.
     */
    protected string $description = '';

    public function __construct()
    {
        $this->titleSeparator = config('meta.title.separator', $this->titleSeparator);
        $this->defaultTitle = config('meta.title.default', $this->defaultTitle);
    }

    /**
     * Sets the meta title.
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Prepends a string to the current meta title.
     */
    public function prependTitle(string $title): void
    {
        $this->title = "{$title}{$this->titleSeparator}{$this->defaultTitle}";
    }

    /**
     * Sets the meta description.
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns the meta information as a MetaData object.
     */
    public function toData(): MetaData
    {
        return MetaData::from([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }

    /**
     * Resets the meta title and description to empty strings.
     */
    public function reset(): void
    {
        $this->title = '';
        $this->description = '';
    }
}
