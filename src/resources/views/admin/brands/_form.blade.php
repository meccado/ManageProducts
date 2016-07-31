@if(isset($brand))
  {!! Form::model($brand,
    ['route'     => ['admin.brands.update', $brand->id],
    'method'     => 'PUT',
    'class'      => 'form-horizontal',
    'files'      => true])
    !!}
  @else
    {!! Form::open(['route' =>'admin.brands.store',
      'method' =>'POST',
      'class'  =>'form-horizontal',
      'files'  =>'true',
    ])
    !!}
  @endif

  <fieldset>
    <div class="row">

      <div class="col-md-3">
        @if(count((\APP\Brand::get())) > 0)
          <!-- Single button -->
          <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Product Brands <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              @foreach(\APP\Brand::get() as $brand)
                <li><a href="{{$brand->id}}">{{ucwords($brand->name)}}</a></li>
              @endforeach
            </ul>
          </div>
        @else
          <button type="button" class="btn btn-success">
            <span class="lead">  No Product Brands Found </span>
          </button>
        @endif
      </div>

      <div class="col-md-9">
        <!-- Text input-->
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', trans('mng_product::brand.brands-create-name'), ['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=> trans('mng_product::brand.brands-create-name_placeholder')]) !!}
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-10 col-sm-offset-2">
            @if (isset($brand))
              {!! Form::submit(trans('mng_product::brand.brands-edit-btnupdate'), ['class' => 'btn btn-primary']) !!}
            @else
              {!! Form::submit(trans('mng_product::brand.brands-create-btncreate'), ['class' => 'btn btn-primary']) !!}
            @endif
          </div>
        </div>
      </div>
    </div>

  </fieldset>
  {!! Form::close() !!}
