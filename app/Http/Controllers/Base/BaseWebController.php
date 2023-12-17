<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class BaseWebController extends Controller
{
    public function __construct(
        protected string $class,
        protected ?string $indexView = null,
        protected ?string $createView = null,
        protected ?string $editView = null,
        protected ?string $showView = null,
    ) {
        if (!is_subclass_of($this->class, BaseModel::class)) {
            throw new \InvalidArgumentException("A classe {$this->class} não é uma subclasse \App\Models\Base\BaseModel");
        }

        $this->class      = $class;
        $this->indexView  = $indexView;
        $this->createView = $createView;
        $this->editView   = $editView;
        $this->showView   = $showView;
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
    public function create(Request $request)
    {
        $data = $this->getCreateData();

        return view($this->createView, compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, string $id)
    {
        $data    = $this->getEditData($id);
        $element = $this->class::find($id);

        if (!$element) abort(404);

        return view($this->editView, compact('data', 'element'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, string $id)
    {
        $data    = $this->getShowData($id);
        $element = $this->class::find($id);

        if (!$element) abort(404);

        return view($this->showView, compact('data', 'element'));
    }

    /**
     * @return array<int|null>
     */
    public function getCreateData()
    {
        return [];
    }

    /**
     * @return array<int|null>
     */
    public function getEditData(string $id)
    {
        return [];
    }

    /**
     * @return array<int|null>
     */
    public function getShowData(string $id)
    {
        return [];
    }
}
