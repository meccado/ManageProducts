@if(isset($category))
  {!! Form::model($category,
    ['route'     => ['admin.categories.update', $category->id],
    'method'     => 'PUT',
    'class'      => 'form-horizontal',
    'files'      => true])
    !!}
  @else
    {!! Form::open(['route' =>'admin.categories.store',
      'method' =>'POST',
      'class'  =>'form-horizontal',
      'files'  =>'true',
    ])
    !!}
  @endif

  <fieldset>
    <div class="row">
      <div class="col-md-3">
        @if(count((\APP\Category::get())) > 0)
          <!-- Single button -->
          <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Product Categories <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              @foreach(\APP\Category::get() as $category)
                <li><a href="{{$category->id}}">{{ucwords($category->name)}}</a></li>
              @endforeach
            </ul>
          </div>
        @else
          <button type="button" class="btn btn-success">
            <span class="lead">  No Product Categories Found </span>
          </button>
        @endif
      </div>

      <div class="col-md-9">
        <!-- Name Form Input -->
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!!Form::label('name', 'Name', ['class'=>'col-md-3 control-label'])!!}
          <div class="col-md-9">
            {!!Form::text('name', old('name'),array('required','class' => 'form-control ','placeholder'=>'Type category here ..','max-length'=>'50'))!!}
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <!-- Sort Order Form Input -->
        <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
          {!!Form::label('sort_order', 'Sort Order', ['class'=>'col-md-3 control-label'])!!}
          <div class="col-md-9">
            {!!Form::input('number', 'sort_order', old('sort_order'),array('required','class' => 'form-control ','placeholder'=>'Enter sort order of product categories','max-length'=>'50'))!!}
            @if ($errors->has('sort_order'))
              <span class="help-block">
                <strong>{{ $errors->first('sort_order') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <!-- Parent Category Form Input -->
        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
          {!!Form::label('parent_id', 'Parent Category', ['class'=>'col-md-3 control-label'])!!}
          <div class="col-md-9">
            {!! Form::select('parent_id', ['' => '<Select Category ... >', '0' => 'Parent Category' ] +  $items, old('parent_id'), ['class' => 'form-control']) !!}
              @if ($errors->has('parent_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('parent_id') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <!-- SEO Description Form Input -->
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {!!Form::label('description', 'Description', ['class'=>'col-md-3 control-label'])!!}
            <div class="col-md-9">
              {!!Form::textArea('description', null,array('required','class' => 'form-control','placeholder'=>'Enter detail information of category','max-length'=>'250'))!!}
              @if ($errors->has('description'))
                <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              @if (isset($category))
                {!! Form::button('<i class="fa fa-btn fa-save"></i> Update Category Item!', ['type'=>'submit', 'class' =>'btn btn-primary']) !!}
              @else
                {!! Form::button('<i class="fa fa-btn fa-save"></i> Save Category Item!', ['type'=>'submit', 'class' =>'btn btn-primary']) !!}
              @endif
            </div>
          </div>
        </div>
      </div>

    </fieldset>
    {!! Form::close() !!}
