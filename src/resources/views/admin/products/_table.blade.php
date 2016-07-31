<table id="datatable" class="table table-striped table-hover table-responsive datatable">
    <thead>
        <tr>
            <th>##</th>
            <th>{!! trans('product.products-index-name_label') !!}</th>
            {{-- <th>{!! trans('product.products-index-content_label')!!}</th> --}}
            <th>{!! trans('product.products-index-slug_label') !!}</th>
            <th>{!! trans('product.products-index-published_at_label') !!}</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
            <tr>
                <th>{{$product->id}}</th>
                <td>
                    <div class="col-md-1">
                        <a href="{{route('admin.products.image-upload',['id'=>$product->id])}}"
                            data-toggle="tooltip"
                            data-original-title="{!! trans('product.images-upload-btnupload') !!}"
                            class="btn btn-default btn-flat  pull-right "><i class="fa fa-upload"></i></a>
                    </div>
                    {{$product->name}}
                </td>
                {{-- <td>{{$product->content}}</td> --}}
                <td>{{$product->slug}}</td>
                <td>{{$product->published_at }}</td>
                <td>
                    <div class="row">
                        <div class="col-sm-1">
                            <a href="{{route('admin.products.show', ['id'=>$product->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('product.products-view_tooltip') !!}"
                                class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="col-sm-1 col-sm-offset-1">
                            <a href="{{route('admin.products.edit',['id'=>$product->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('product.products-update_tooltip') !!}"
                                class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                        </div>
                        <div class="col-sm-1 col-sm-offset-1">
                            {!! Form::open(['route' => ['admin.products.destroy', $product->id],
                            'class' => 'form-horizontal confirm',
                            'role' => 'form', 'method' => 'DELETE']) !!}
                                <button data-toggle="tooltip"
                                    data-original-title="{{trans('product.products-delete_tooltip') }}"
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
            <th></th>
            <th>
                <button class="btn btn-primary btn-flat" type="button">
                  {{trans('product.products-counter_badge') }} <span class="badge">{{count($products)}}</span>
                </button>
            </th>
        </tr>
    </tfoot>
</table>
