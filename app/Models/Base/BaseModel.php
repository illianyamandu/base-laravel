<?php

namespace App\Models\Base;

use App\Traits\Guid;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use Guid;
}
