@extends('admin.layouts.admin-master')

@section('title')
  {{-- this page title --}}
  {!!(isset($title)) ? $title : 'Upload Image Page'!!}
@stop

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.css" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <p>
      {!! link_to_route('admin.products.index', trans('product.products-index-add_index'), [], ['class' => 'btn btn-default btn-flat']) !!}
			{!! link_to_route('admin.products.edit', trans('product.products-index-add_edit'), ['id'=>$product->id], ['class' => 'btn btn-info btn-flat']) !!}
      {!! link_to_route('admin.products.show', trans('product.products-index-add_show'), ['id'=>$product->id], ['class' => 'btn btn-primary btn-flat']) !!}
    </p>

      @if($product != null)
        <div class="box box-primary"><!-- .box -->
          <div class="box-header with-border"><!-- .box-header -->
            <h3 class="box-title pull-left">
              {!!trans('product.images-upload-image')!!}
            </h3>
          </div><!-- /.box-header -->

          <div class="box-body"><!-- box-body -->
            <div class="row">
              @include('admin.products._single_top')
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12" id="product_template">
                  @include('admin.products._single')
                </div>
              </div>
            </div>
          </div><!-- /.box-body -->

          <div class="box-footer"><!-- .box-footer-->
            {{ trans('product.images-upload-footer') }}
          </div><!-- /.box-footer-->

        </div><!-- /.box -->
      @else
        {{ trans('product.images-upload-no_entry_found') }}
      @endif
    </div>
  @endsection

  @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.js"></script>

    <script type="text/javascript">
    var baseUrl = '';
    $(document).ready(function(){
      baseUrl = "{{url('/')}}";
    });

    Dropzone.options.productDropzone = {
      //autoProcessQueue	: false,
      //uploadMultiple		: true,
      maxFilesize			    : 10,
      maxFiles			      : 1,
      acceptedFiles       : 'image/*',
      thumbnailWidth      : 180,
      thumbnailHeight     : 120,
      parallelUploads     : 100,
      success             : function(file, response){
        if(file.status == 'success'){
          handleResponse.handleSuccess(response);
        }else{
          handleResponse.handleError(response);
        }
      },
      init: function() {
        this.on("sending", function(file, xhr, formData) {
          formData.append('_token', '{{ csrf_token() }}');
        });
      },
    };
    var handleResponse = {
      handleSuccess  : function(response){
        var uri = response.file_path;
        var name = response.file_name;
        var url = baseUrl +  uri;
        var resize = baseUrl +'/assets/images/products/resize/'+name;
        //$("#image-lists li a").append
        $("ul#image-lists").last()
        .append('<li style="margin: 0; padding: 0; list-style: none; float: left; padding-right: 10px ">'+
                  '<a href="'+url+'" data-lightbox="product" target="_blank">'+
                    '<img src="'+resize+'" alt="'+name+'" class="img-responsive" style="width: 240px; height: 160; border: 2px solid black; margin-bottom: 10px">'+
                '</a>'+
              '</li>');
        //$('#image-lists ul')
        //.append('<li style="margin: 0; padding: 0; list-style: none; float: left; padding-right: 10px "><a href="'+url+'" data-lightbox="product" target="_blank"><img src="'+url+'" alt="'+name+'" class="img-responsive" style="width: 240px; height: 160; border: 2px solid black; margin-bottom: 10px"></a></li>');
      },
      handleError  : function(response){

      },
    };
    </script>endsection
