<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base\BaseModel;

class BaseWebController extends Controller
{
    public function __construct(protected BaseModel $class)
    {
        $this->class = $class;
    }
}
