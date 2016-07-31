<div class="col-md-12">
   <ul id="image-lists" style="margin: 0; padding: 0;">
        @if(isset($product->images))
          @foreach($product->images as $image)
              <li style="margin: 0; padding: 0; list-style: none; float: left; padding-right: 10px ">
                  <a href="{{asset($image->file_path)}}" data-lightbox="product" target="_blank">
                      <img src="{{asset('/assets/images/products/resize/'.$image->file_name)}}" alt="{{$image->file_name}}" class="img-responsive" style="width: 240px; height: 160; border: 2px solid black; margin-bottom: 10px">
                  </a>
              </li>
          @endforeach
        @endif
   </ul>
</div>
<div class="col-md-12">
    <h3>{{$product->name}} <small> :: {{$product->description}}</small></h3>
</div>
