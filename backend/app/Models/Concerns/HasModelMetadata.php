<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\Relation;

trait HasModelMetadata
{
    private static $morphAlias;

    private static $tableName;

    /**
     * Alias for morph relationships.
     */
    public static function getMorphAlias()
    {
        return self::$morphAlias ??= Relation::getMorphAlias(static::class);
    }

    /**
     * Get the table name for the model.
     */
    public static function getTableName()
    {
        return self::$tableName ??= new static()->getTable();
    }
}
