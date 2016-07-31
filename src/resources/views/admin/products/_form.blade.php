@if(isset($product))
  {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
@else
  {!! Form::open(['route' =>'admin.products.store', 'method' =>'POST', 'class'  =>'form-horizontal', 'files'  =>'true', ])!!}
@endif

<fieldset>


  <div class="row"
  {{-- style="background-color: #FFF;
                          padding: 20px 0px;

                          -moz-box-shadow: 0px 0px 5px rgba(101, 156, 239,0.5);
                          -webkit-box-shadow: 0px 0px 5px rgba(101, 156, 239, 0.5);
                          box-shadow: 0px 0px 3px rgba(101, 156, 239, 0.5);

                          margin-left: 0px;">
    <div class="col-md-3 pull-left" --}}
    {{-- style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 10px;" --}}
    >
      <div class="col-md-3">
      <!-- Brand Form Input -->
      <div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
        {!!Form::label('brand_id', trans('mng_product::product.products-create-brand_label'), ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!! Form::select('brands[]', $brand_items, $brands_selected, ['class' => 'form-control', 'multiple' => 'multiple']); !!}
          @if ($errors->has('brand_id'))
            <span class="help-block">
              <strong>{{ $errors->first('brand_id') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Categories Form Input -->
      <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
        {!!Form::label('categories', trans('mng_product::product.products-create-categories_label'), ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!! Form::select('categories[]', $category_items, $categories_selected, ['class' => 'form-control', 'multiple' => 'multiple']); !!}
          @if ($errors->has('categories'))
            <span class="help-block">
              <strong>{{ $errors->first('categories') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- SKU Form Input -->
      <div class="form-group{{ $errors->has('sku') ? ' has-error' : '' }}">
        {!!Form::label('sku', trans('mng_product::product.products-create-sku_label'), ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!!Form::text('sku', old('sku'), [ 'class' => 'form-control ', 'placeholder'=>'Type product sku here ..'])!!}
          @if ($errors->has('sku'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
        {!! Form::label('published', trans('mng_product::product.products-create-published_label') , ['class'=>'col-md-3 control-label']) !!}
        <div class="col-md-8 col-md-offset-1">
          <div class="checkbox icheck">
            {{Form::checkbox('published', old('published'))}}
            @if ($errors->has('published'))
              <span class="help-block">
                <strong>{{ $errors->first('published') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </div>

      <!-- Published_at Form Input -->
      <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }} ">
        {!! Form::label('published_at', trans('mng_product::product.products-create-published_at_label') , ['class'=>'col-md-3 control-label']) !!}
        <div class="col-md-9">
          @if(isset($product ))
            {!! Form::input('date', 'published_at', $product->published_at , ['class' => 'form-control']) !!}
          @else
            {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
          @endif
          @if ($errors->has('published_at'))
            <span class="help-block">
              <strong>{{ $errors->first('published_at') }}</strong>
            </span>
          @endif
        </div>
      </div>
    </div><!-- /.col -->

    <div class="col-md-9">

      <!-- Name Form Input -->
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!!Form::label('name', trans('mng_product::product.products-create-product_label'), ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!!Form::text('name', old('name'),['class' => 'form-control ', 'placeholder'=>'Type product here ..'])!!}
          @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Price Form Input -->
      <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        {!!Form::label('price', trans('mng_product::product.products-create-price_label'), ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!!Form::input('price', 'price', old('price'), ['class' => 'form-control ', 'placeholder'=>'Enter sort order for products'])!!}
          @if ($errors->has('price'))
            <span class="help-block">
              <strong>{{ $errors->first('price') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Product Description Form Input -->
      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!!Form::label('description', trans('mng_product::product.products-create-description_label'), ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
          {!!Form::textArea('description', old('description'),[ 'class' => 'form-control', 'placeholder'=>'Enter detail information of product', 'max-length'=>'250'])!!}
          @if ($errors->has('description'))
            <span class="help-block">
              <strong>{{ $errors->first('description') }}</strong>
            </span>
          @endif
        </div>
      </div>

    </div><!-- /.col -->


  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      @if (isset($product))
        {!! Form::button('<i class="fa fa-btn fa-save"></i> Update Product Item!', ['type'=>'submit', 'class' =>'btn btn-primary btn-flat']) !!}
      @else
        {!! Form::button('<i class="fa fa-btn fa-save"></i> Save Product Item!', ['type'=>'submit', 'class' =>'btn btn-primary btn-flat']) !!}
      @endif
    </div>
  </div>

</div><!-- /.row -->

</fieldset>
{!! Form::close() !!}
