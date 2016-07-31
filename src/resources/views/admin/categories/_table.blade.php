<table id="datatable" class="table table-striped table-hover table-responsive datatable">
    <thead>
        <tr>
            <th>##</th>
            <th>{!! trans('mng_product::category.categories-index-name_label') !!}</th>
            <th>{!! trans('mng_product::category.categories-index-description_label')!!}</th>
            <th>{!! trans('mng_product::category.categories-index-parentid_label') !!}</th>
            <th>{!! trans('mng_product::category.categories-index-sortorder_label') !!}</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($categories as $category)
            <tr>
                <th>{{$category->id}}</th>
                <td>
                    {{$category->name}}
                </td>
                <td>{{$category->description}}</td>
                <td>{{$category->parent_id}}</td>
                <td>{{$category->sort_order}}</td>
                <td>
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{route('admin.categories.show', ['id'=>$category->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('mng_product::category.categories-view_tooltip') !!}"
                                class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="col-md-1 col-md-offset-1">
                            <a href="{{route('admin.categories.edit',['id'=>$category->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('mng_product::category.categories-update-btnupdate') !!}"
                                class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                        </div>
                        <div class="col-md-1 col-md-offset-1">
                            {!! Form::open(['route' => ['admin.categories.destroy', $category->id],
                            'class' => 'form-horizontal confirm',
                            'role' => 'form', 'method' => 'DELETE']) !!}
                                <button data-toggle="tooltip"
                                    data-original-title="{{trans('mng_product::category.categories-delete-btndelete') }}"
                                    type="submit" class="btn btn-danger confirm-btn btn-flat">
                                        <i class="fa fa-trash-o"></i>
                                </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </td>
                @foreach ($category->children as $child)
                           <tr>
                                <th>{{ $child->id }}</th>
                               <td>{{ $child->name }}</td>
                               <td>{{ $child->description }}</td>
                               <td>{{$child->parent_id}}</td>
                               <td>{{$child->sort_order}}</td>
                               <td>
                                 <div class="row">
                                     <div class="col-md-2">
                                         <a href="{{route('admin.categories.show', ['id'=>$child->id])}}"
                                             data-toggle="tooltip"
                                             data-original-title="{!! trans('mng_product::category.categories-view_tooltip') !!}"
                                             class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                                     </div>
                                     <div class="col-sm-1"></div>
                                     <div class="col-md-2">
                                         <a href="{{route('admin.categories.edit',['id'=>$child->id])}}"
                                             data-toggle="tooltip"
                                             data-original-title="{!! trans('mng_product::category.categories-update-btnupdate') !!}"
                                             class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                                     </div>
                                     <div class="col-sm-1"></div>
                                     <div class="col-md-2">
                                         {!! Form::open(['route' => ['admin.categories.destroy', $child->id],
                                         'class' => 'form-horizontal confirm',
                                         'role' => 'form', 'method' => 'DELETE']) !!}
                                             <button data-toggle="tooltip"
                                                 data-original-title="{{trans('mng_product::category.categories-delete-btndelete') }}"
                                                 type="submit" class="btn btn-danger confirm-btn btn-flat">
                                                     <i class="fa fa-trash-o"></i>
                                             </button>
                                         {!! Form::close() !!}
                                     </div>
                                 </div>
                               </td>
                           </tr>
                       @endforeach
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>
                <button class="btn btn-primary btn-flat" type="button">
                  {{trans('mng_product::category.categories-counter_badge') }} <span class="badge">{{count($categories)}}</span>
                </button>
            </th>
        </tr>
    </tfoot>
</table>
