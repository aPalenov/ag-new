<?php

namespace App\Models;

use App\Models\Concerns\HasModelCacheAttributes;
use App\Models\Concerns\HasModelMetadata;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasModelCacheAttributes;
    use HasModelMetadata;
}
