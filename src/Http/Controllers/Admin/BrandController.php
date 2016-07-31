<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Brand as Brand;

class BrandController extends Controller
{

  /**
  * @var Brand
  */
  protected $brands;

  public function __construct(Brand $brands)
  {
    $this->brands = $brands;
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\View\View
  */
  public function index()
  {
    $brands = $this->brands->get();
    return \View::make('admin.brands.index', compact('brands'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\View\View
  */
  public function create()
  {
    return \View::make('admin.brands.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\RedirectResponse
  */
  public function store(Request $request)
  {
    $this->brands->create($request->only('name'));
    return \Redirect::route('admin.brands.index')
    ->withMessage(trans('brand.brands-controller-successfully_created'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\View\View
  */
  public function show(Brand $brand)
  {
    $products = $brand->products()
                    ->latest('published_at')
                    ->published()->get();
		return view('admin.products.index', compact('products'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\View\View
  */
  public function edit($id)
  {
    $brand = $this->brands->findOrFail($id);
    return \View::make('admin.brands.edit', compact('brand'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\RedirectResponse
  */
  public function update(Request $request, $id)
  {
    $this->brands->findOrFail($id)->update($request->only('name'));
    return \Redirect::route('admin.brands.index')
    ->withMessage(trans('brand.brands-controller-successfully_updated'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\RedirectResponse
  */
  public function destroy($id)
  {
    $this->brands->findOrFail($id)->delete();
    return \Redirect::route('admin.brands.index')
    ->withMessage(trans('brand.brands-controller-successfully_deleted'));
  }
}
