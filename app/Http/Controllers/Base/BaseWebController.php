<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class BaseWebController extends Controller
{
    public function __construct(
        protected BaseModel $class,
        protected ?string $indexView = null,
        protected ?string $createView = null,
        protected ?string $showView = null,
        protected ?string $editView = null,
    ) {
        $this->class      = $class;
        $this->indexView  = $indexView;
        $this->createView = $createView;
        $this->showView   = $showView;
        $this->editView   = $editView;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $data = $this->class::listing($request);

        return view($this->indexView, compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data = $this->getCreateData();

        return view($this->createView, compact('data'));
    }

    /**
     * @return array<int|null>
     */
    public function getCreateData()
    {
        return [];
    }
}
