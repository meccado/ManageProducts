@extends('admin.layouts.admin-master')

@section('title')
     {{-- this page title --}}
     {!!(isset($title)) ? $title : 'Edit Product Page'!!}
@stop

@section('styles')
   {{-- this page specialised styles --}}
@stop

@section('content')
   <p>
     {!! link_to_route('admin.products.index', trans('product.products-index-add_index'), [], ['class' => 'btn btn-default btn-flat']) !!}
   </p>
	<div class="box box-primary"><!-- .box -->
		<div class="box-header with-border"><!-- .box-header -->
			<h3 class="box-title pull-left">
				{{ trans('product.products-edit-edit_product') }}
			</h3>
		</div><!-- /.box-header -->

		<div class="box-body"><!-- .box-body -->
			<div class="row">
		    @include('admin.products._form')
		</div><!-- /.box-body -->

		<div class="box-footer"><!-- .box-footer-->
			  {{ trans('product.products-edit-footer') }}
		</div><!-- /.box-footer-->
	</div><!-- /.box -->

@endsection

@section('scripts')
   {{-- this page specialised scripts --}}
   {{-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'content' , {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    </script> --}}
    {{-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> --}}
    {{-- <script type="text/javascript">
        $('textarea').ckeditor({
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    </script> --}}
@stop
