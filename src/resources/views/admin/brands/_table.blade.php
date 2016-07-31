<table id="datatable" class="table table-striped table-hover table-responsive datatable">
  <thead>
    <tr>
      <th>{{ trans('mng_product::brand.brands-index-name') }}</th>
      <th>&nbsp;</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($brands as $brand)
      <tr>
        <td>
          {{ $brand->name }}
        </td>
        <td>
          <div class="row">
              <div class="col-md-2">
                <a href="{{route('admin.brands.edit',['id'=>$brand->id])}}"
                  data-toggle="tooltip"
                  data-original-title="{!! trans('mng_product::brand.brands-update_tooltip') !!}"
                  class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                </div>
                <div class="col-md-2">
                  {!! Form::open(['route' => ['admin.brands.destroy', $brand->id],
                    'class' => 'form-horizontal confirm',
                    'onsubmit' => 'return confirm(\'' . trans('mng_product::brand.brands-index-are_you_sure') . '\');',
                    'role' => 'form', 'method' => 'DELETE']) !!}
                    <button data-toggle="tooltip"
                    data-original-title="{{trans('mng_product::brand.brands-delete_tooltip') }}"
                    type="submit" class="btn btn-danger confirm-btn btn-flat">
                    <i class="fa fa-trash-o"></i>
                  </button>
                  {!! Form::close() !!}
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>
            <button class="btn btn-primary" type="button">
              Brands <span class="badge">{{count($brands)}}</span>
            </button>
          </th>
        </tr>
      </tfoot>
    </table>
