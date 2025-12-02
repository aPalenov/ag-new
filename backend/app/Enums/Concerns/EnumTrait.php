<?php

namespace App\Enums\Concerns;

use ArchTech\Enums\Comparable;
use ArchTech\Enums\From;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

trait EnumTrait
{
    use Comparable;
    use From;
    use Metadata;
    use Names;
    use Options;
    use Values;
}
