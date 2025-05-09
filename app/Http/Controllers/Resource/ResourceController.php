<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Product\ProductStoreRequest;
use App\Services\Resource\BaseResourceService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    public function __construct(
        protected BaseResourceService $service,
        protected string $entity,
        protected string $storeRequestClassName,
        protected string $updateRequestClassName,
    ){}

    public function index(): View|Application|Factory
    {
        return view("$this->entity.resource.index", ['items' => $this->service->list()]);
    }

    public function create(): View|Application|Factory
    {
        return view("$this->entity.resource.create");
    }

    public function show(int $id): View|Application|Factory
    {
        $item = $this->service->show($id);

        $item ?: abort(404);

        return view("$this->entity.resource.show", compact('item'));
    }

    public function edit(int $id): View|Application|Factory
    {
        $item = $this->service->show($id);

        $item ?: abort(404);

        return view("$this->entity.resource.edit", compact('item'));
    }

    public function store(Request $request): RedirectResponse
    {
        try{
            $formRequest = $this->storeRequestClassName::createFrom($request);

            $values = $formRequest->validate($formRequest->rules());

            if($this->service->create($values)){
                return redirect()->route("$this->entity.index");
            }

        }catch (\Exception $exception){
            dd($exception->getMessage());
            // logging
        }

        return back()->withInput()->withErrors(['system' => "Something went wrong, try again later."]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try{

            $formRequest = $this->updateRequestClassName::createFrom($request);

            $values = $formRequest->validate($formRequest->rules());

            if($this->service->update($id, $values)){
                return redirect()->route("$this->entity.index");
            }

        }catch (\Exception $exception){
            dd($exception->getMessage());
            // logging
        }

        return back()->withInput()->withErrors(['system' => "Something went wrong, try again later."]);
    }

    public function destroy(int $id): RedirectResponse
    {
        try{

            if($this->service->delete($id)){
                return redirect()->route("$this->entity.index");
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }
}
