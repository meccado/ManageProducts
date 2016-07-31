@extends('admin.layouts.admin-master')

@section('content')

  <div class="row">
    <div class="col-md-3" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 10px;">
      <div class="box box-primary"><!-- .box -->
        <div class="box-header with-border"><!-- .box-header -->
          <h3 class="box-title pull-left">
            {{ trans('mng_product::product.products-show-create_product_menu') }}
          </h3>
        </div><!-- /.box-header -->

        <div class="box-body"><!-- .box-body -->
          <div class="row">
            <div class="col-sm-12">
              @unless ($product->brands->isEmpty())
                <h5>Tag:</h5>
                <ul>
                  @foreach ($product->brands as $brand)
                    <li>{!! link_to_action('Admin\TagController@show', $brand->name, ['name' => $brand->name]) !!}</li>
                  @endforeach
                </ul>
              @endif

              @unless ($product->categories->isEmpty())
                <h5>Category:</h5>
                <ul>
                  @foreach ($product->categories as $category)
                    <li>{!! link_to_action('Admin\CategoryController@show', $category->name, ['name' => $category->name]) !!}</li>
                  @endforeach
                </ul>
              @endif
            </div>
          </div>
        </div><!-- /.box-body -->

        <div class="box-footer"><!-- .box-footer-->
          {{ trans('mng_product::product.products-show-footer_menu') }}
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </div><!-- /.col -->

    <div class="col-md-8" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 35px;">
      <div class="box box-primary"><!-- .box -->
        <div class="box-header with-border"><!-- .box-header -->
          <h3 class="box-title pull-left">
            {{ trans('mng_product::product.products-show-create_product') }}
          </h3>
        </div><!-- /.box-header -->

        <div class="box-body"><!-- .box-body -->
          <div class="row">
            <div class="col-sm-8">
              <h1>{{ $product->name }}</h1>
              <product>
                {!! $product->description !!}
              </product>
            </div>
            <div class="col-sm-4">
              <ul id="image-lists" style="margin: 0; padding: 0;">
                @if(isset($product) && isset($product->images[0]))
                  <li style="margin: 0; padding: 0; list-style: none; float: left; padding-right: 10px ">
                    <a href="{{asset($product->images[0]->file_path)}}" data-lightbox="product" target="_blank">
                      <img src="{{asset('/assets/images/products/thumbnail/'.$product->images[0]->file_name)}}" alt="{{$product->images[0]->file_name}}" class="img-responsive"
                      style="width: 240px; height: 160; border: 2px solid black; margin-bottom: 10px">
                    </a>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer"><!-- .box-footer-->
          {{ trans('mng_product::product.products-show-footer') }}
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection
