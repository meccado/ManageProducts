<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Meccado\ManageProducts\Http\Requests\ProductFormRequest as ProductFormRequest;
use Meccado\ManageProducts\Http\Requests\ImageFormRequest as ImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use App\Product as Product;
use App\Category as Category;
use App\Brand as Brand;
use Illuminate\Support\Facades\File as File;
use Image as Image;

class ProductController extends Controller
{

  /**
  * @var Brand
  */
  protected $products;

  public function __construct(Product $products)
  {
    $this->products = $products;
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $products =  $this->products->latest('published_at')
    ->published()
    ->get();
    //$products = Product::with('Categories')->get();
    return view('admin.products.index',['products' => $products]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $category_items = Category::lists('name', 'id')->toarray();
    $brand_items = Brand::lists('name', 'id')->toarray();
    $categories_selected = [];
    $brands_selected = [];
    return view('admin.products.store', compact('category_items', 'categories_selected', 'brand_items', 'brands_selected'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(ProductFormRequest $request)
  {
    $product = $this->products->create([
      'name'              => $request->get('name'),
      'description'       => $request->get('description'),
      'sku'               => str_slug($request->get('sku')),
      'price'             =>$request->get('price'),
      'published'         => $request->input('published') === 'on' ? true : false,
      'published_at'      => $request->input('published_at'),
    ]);
    $product->save();
    foreach ($request->categories as $index =>$category_id) {
      $category = Category::whereId($category_id)->first();
      $product->assignCategory($category);
    }

    foreach ($request->brands as $index =>$brand_id) {
      $brand = Brand::whereId($brand_id)->first();
      $product->assignBrand($brand);
    }

    return \Redirect::route('admin.products.index')->with('flash_message', 'Product added!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Product $products)
  {
    //$product = $this->products->findOrFail($id);
    return view('mng_product::admin.products.show', ['product' => $products]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $product = $this->products->findOrFail($id);
    $categories_selected = $product->categories->lists('id')->toarray();
    $brands_selected = $product->brands->lists('id')->toarray();
    $brand_items = Brand::lists('name', 'id')->toarray();
    $category_items = Category::lists('name', 'id')->toarray();
    return view('admin.products.update', compact('product', 'brands_selected', 'categories_selected', 'category_items', 'brand_items'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(ProductFormRequest $request, $id)
  {
    $product = $this->products->whereId($id)->first();
    $product->categories()->detach();
    $product->brands()->detach();
    $product->name              = $request->get('name');
    $product->description       = $request->get('description');
    $product->sku               = str_slug($request->get('sku'));
    $product->price             =>$request->get('price'),
    $product->published         = $request->input('published') === 'on' ? true : false;
    $product->published_at      = $request->input('published_at');
    $product->update();

    foreach ($request->categories as $index =>$category_id) {
      $category = Category::whereId($category_id)->first();
      $product->assignCategory($category);
    }

    foreach ($request->brands as $index =>$brand_id) {
      $brand = Brand::whereId($brand_id)->first();
      $product->assignBrand($brand);
    }
    return \Redirect::route('admin.products.index')->with('flash_message', 'Product added!');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $product = $this->products->findOrFail($id);
    if($product){
      $product->delete();
      return \Redirect::to('admin/products')
      ->with('flash_message', 'Product Deleted');
    }
    return \Redirect::to('admin/products')
    ->with('flash_message', 'Something went wrong, please try again');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function getUpload($id)
  {
    $product = $this->products->findOrFail($id);
    return \View::make('admin.products.upload')->with(compact('product'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function upload(ImageFormRequest $request, $id)
  {
    if(Input::hasFile('file')) {
      $file = $request->file('file');
      $filename = uniqid() . $file->getClientOriginalName();
      $original ='assets\images\products\original\\'.$filename;
      $thumbnail = 'assets\images\products\thumbnail\\'.$filename;
      $resize = 'assets\images\products\resize\\'.$filename;
      if (!File::exists('assets\images\products\original'))
      {
        File::makeDirectory('assets\images\products\original', $mode = 0777, true, true);
        if (!File::exists('assets\images\products\thumbnail')){File::makeDirectory('assets\images\products\thumbnail', $mode = 0777, true, true);}
        if (!File::exists('assets\images\products\resize')){File::makeDirectory('assets\images\products\resize', $mode = 0777, true, true);}
      }
      // upload new image
      $img = Image::make($file->getRealPath());
      $img->save($original);// original
      $img->fit('150', '150'); // thumbnail (grab)
      $img->save($thumbnail);
      $img->resize('300', '300'); // resize and set true if you want proportional image resize
      $img->save($resize);
      $img->destroy();
      $product = $this->products->find($id);
      $image = $product->images()->create([
        'product_id'   => $request->input('product_id'),
        'file_name'     => $filename,
        'file_size'     => $file->getClientSize(),
        'file_mime'     => $file->getClientMimeType(),
        'file_path'     => 'assets/images/products/original/'.$filename,
        'created_by'    => \Auth::user() ? \Auth::user()->id : 0,
      ]);
      return response()->json($image, 200);
    }else{
      return response()->json(false, 200);
    }
  }

}
