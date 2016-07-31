<div class="col-md-12">
    <div class="col-md-12" id="product_template">
        <div class="dropzone-previews"></div>
        {!! Form::open(['route'     => ['admin.products.upload', $product->id],
                        'method'	=>'POST',
                        'class'		=>'dropzone',
                        'id'		  =>'product_dropzone',
                        'files'		=>'true',

                    ])
        !!}
        {!! Form::close() !!}
    </div>
</div>
