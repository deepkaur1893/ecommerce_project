@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')

@if($id>0)
    {{$image_required=""}}
@else
    {{$image_required="required"}}
@endif
    <h1 class="mb10">Manage Product</h1>  
    @if(session()->has('sku_error'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{session('sku_error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>  
    @endif
    @error('attr_image.*')
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>  
    @enderror
    @error('images.*')
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>  
    @enderror
    <!---<a href="product">-->
    <a href="{{url('admin/product')}}">   <!-- we used this to resolved error of pages /product/product in url-->
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <div class="row m-t-30">
        <div class="col-md-12">
        <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Name</label>
                                <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Slug</label>
                                <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('slug')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Image</label>
                                <input id="image" value="{{$image}}" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                                @if($image!='')
                                        <a href="{{asset('storage/media/'.$image)}}" target="_blank"><img src="{{asset('storage/media/'.$image)}}" width="50px" alt=""></a>
                                        @endif
                                @error('image')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="category_id" class="control-label mb-1">Category Id</label>
                                        <select id="category_id" name="category_id" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Categories</option>
                                            @foreach($category as $list)
                                                @if($category_id==$list->id)
                                                    <option value="{{$list->id}}" selected >{{$list->category_name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="brand" class="control-label mb-1">Brand</label>
                                        <select id="brand" name="brand" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Categories</option>
                                            @foreach($brands as $list)
                                                @if($brand==$list->id)
                                                    <option value="{{$list->id}}" selected >{{$list->name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="model" class="control-label mb-1">Model</label>
                                        <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('model')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="short_desc" class="control-label mb-1">Short Description</label>
                                <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>
                                @error('short_desc')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc" class="control-label mb-1">Description</label>
                                <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$desc}}</textarea>
                                @error('desc')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keywords" class="control-label mb-1">Keywords</label>
                                <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$keywords}}</textarea>
                                @error('keywords')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                                <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$technical_specification}}</textarea>
                                @error('technical_specification')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="uses" class="control-label mb-1">Uses</label>
                                <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$uses}}</textarea>
                                @error('uses')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="warranty" class="control-label mb-1">Warranty</label>
                                <textarea id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$warranty}}</textarea>
                                @error('warranty')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                        <input id="lead_time" value="{{$lead_time}}" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                        @error('$lead_time')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tax_id" class="control-label mb-1">Tax</label>
                                        <select id="tax_id" name="tax_id" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Taxes</option>
                                            @foreach($taxes as $list)
                                                @if($tax_id==$list->id)
                                                    <option value="{{$list->id}}" selected >{{$list->tax_desc}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->tax_desc}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('$tax_id')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                        <select id="is_promo" name="is_promo" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Promo</option>
                                                @if($is_promo==1)
                                                    <option value="1" selected >Yes</option>
                                                    <option value="0" >No</option>
                                                @else
                                                    <option value="1" >Yes</option>
                                                    <option value="0" selected>No</option>
                                                @endif
                                        </select>
                                        @error('$is_promo')
                                            <div class="alert alert-danger" role="alert">{{$is_promo}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                    <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                        <select id="is_featured" name="is_featured" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Featured</option>
                                                @if($is_featured==1)
                                                    <option value="1" selected >Yes</option>
                                                    <option value="0" >No</option>
                                                @else
                                                    <option value="1" >Yes</option>
                                                    <option value="0" selected>No</option>
                                                @endif
                                        </select>
                                        @error('$is_featured')
                                            <div class="alert alert-danger" role="alert">{{$is_featured}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                    <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                        <select id="is_discounted" name="is_discounted" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Discounted</option>
                                                @if($is_discounted==1)
                                                    <option value="1" selected >Yes</option>
                                                    <option value="0" >No</option>
                                                @else
                                                    <option value="1" >Yes</option>
                                                    <option value="0" selected>No</option>
                                                @endif
                                        </select>
                                        @error('$is_discounted')
                                            <div class="alert alert-danger" role="alert">{{$is_discounted}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                    <label for="is_tranding" class="control-label mb-1">Is Tranding</label>
                                        <select id="is_tranding" name="is_tranding" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Tranding</option>
                                                @if($is_tranding==1)
                                                    <option value="1" selected >Yes</option>
                                                    <option value="0" >No</option>
                                                @else
                                                    <option value="1" >Yes</option>
                                                    <option value="0" selected>No</option>
                                                @endif
                                        </select>
                                        @error('$is_tranding')
                                            <div class="alert alert-danger" role="alert">{{$is_tranding}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h2 class="mb10">&nbsp;Product Images</h2>  
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row" id="product_images_box">
                                @php
                                    $loop_count_num=1;
                                @endphp
                                @foreach($productImagesArr as $key=>$val)
                                @php
                                    $loop_count_prev=$loop_count_num;
                                    $pIAr=(array)$val;  ///convert object into array
                                @endphp
                                <input id="piid" name="piid[]" type="hidden" value="{{$pIAr['id']}}" >
                                    <div class="col-md-4 product_Images_{{$loop_count_num++}}" >
                                        <label for="images" class="control-label mb-1">Image</label>
                                        <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                        @if($pIAr['images']!='')
                                        <a href="{{asset('storage/media/'.$pIAr['images'])}}" target="_blank"><img src="{{asset('storage/media/'.$pIAr['images'])}}" width="50px" alt=""></a>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <label for="images" class="control-label mb-1">&nbsp;</label>
                                        @if($loop_count_num==2)
                                            <button type="button" onclick="add_image_more();" class="btn btn-success btn-lg form-control" >
                                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                                        @else
                                            <a href="{{url('admin/product/product_images_delete')}}/{{$pIAr['id']}}/{{$id}}">
                                                <button type="button" onclick="remove_image_more('{{$loop_count_prev}}');" class="btn btn-danger btn-lg form-control" >
                                                <i class="fa fa-minus"></i>&nbsp; Remove</button>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <h2 class="mb10">&nbsp;Product Attributes</h2>  
            <div class="col-lg-12" id="product_attr_box">
                @php
                    $loop_count_num=1;
                @endphp
                @foreach($productAttrArr as $key=>$val)
                @php
                    $loop_count_prev=$loop_count_num;
                    $pAAr=(array)$val;  ///convert object into array
                @endphp
                <input id="paid" name="paid[]" type="hidden" value="{{$pAAr['id']}}" >
                <div class="card" id="product_attr_{{$loop_count_num++}}">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="sku" class="control-label mb-1">SKU</label>
                                    <input id="sku"  name="sku[]" type="text" value="{{$pAAr['sku']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="mrp" class="control-label mb-1">MRP</label>
                                    <input id="mrp" name="mrp[]" type="text" value="{{$pAAr['mrp']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="price" class="control-label mb-1">Price</label>
                                    <input id="price" name="price[]" type="text" value="{{$pAAr['price']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="size_id" class="control-label mb-1">Size Id</label>
                                    <select id="size_id" name="size_id[]" class="form-control" aria-required="true" aria-invalid="false">
                                        <option value="">Select Sizes</option>
                                        @foreach($size as $list)
                                            @if($pAAr['size_id']==$list->id)
                                            <option value="{{$list->id}}" selected>{{$list->size}}</option>
                                            @else
                                            <option value="{{$list->id}}">{{$list->size}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="color_id" class="control-label mb-1">Color Id</label>
                                    <select id="color_id" name="color_id[]" class="form-control" aria-required="true" aria-invalid="false">
                                        <option value="">Select Color</option>
                                        @foreach($color as $list)
                                            @if($pAAr['color_id']==$list->id)
                                                <option value="{{$list->id}}" selected>{{$list->color}}</option>
                                            @else
                                                <option value="{{$list->id}}">{{$list->color}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="qty" class="control-label mb-1">Qty</label>
                                    <input id="qty" name="qty[]" type="text" value="{{$pAAr['qty']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                                    <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                    @if($pAAr['attr_image']!='')
                                    <a href="{{asset('storage/media/'.$pAAr['attr_image'])}}" target="_blank"><img src="{{asset('storage/media/'.$pAAr['attr_image'])}}" width="50px" alt=""></a>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="attr_image" class="control-label mb-1">&nbsp;</label>
                                    @if($loop_count_num==2)
                                        <button type="button" onclick="add_more();" class="btn btn-success btn-lg form-control" >
                                            <i class="fa fa-plus"></i>&nbsp; Add
                                        </button>
                                    @else
                                        <a href="{{url('admin/product/product_attr_delete')}}/{{$pAAr['id']}}/{{$id}}">
                                            <button type="button" onclick="remove_more('{{$loop_count_prev}}');" class="btn btn-danger btn-lg form-control" >
                                            <i class="fa fa-minus"></i>&nbsp; Remove
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-12">
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        Submit
                    </button>
                </div>
                <input type="hidden" name="id" value="{{$id}}">
            </div>
        </div> 
        </form>         
        </div>
    </div>  
    <script>
        var loop_count=1;
        function add_more()
        {
            loop_count++;
            var html='<input id="paid" name="paid[]" type="hidden"><div class="card" id="product_attr_'+loop_count+'"><div class="card-body">';

            html+='<div class="form-group"><div class="row"><div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku"  name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            html+='<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            var size_id_html=jQuery('#size_id').html();
            size_id_html=size_id_html.replace('selected','');

            html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1">Size Id</label><select id="size_id" name="size_id[]" class="form-control" aria-required="true" aria-invalid="false">'+size_id_html+'</select></div>';

            var color_id_html=jQuery('#color_id').html();
            color_id_html=color_id_html.replace('selected','');

            html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1">Color Id</label><select id="color_id" name="color_id[]" class="form-control" aria-required="true" aria-invalid="false">'+color_id_html+'</select></div></div></div>';

            html+='<div class="form-group"><div class="row">';

            html+='<div class="col-md-2"><label for="qty" class="control-label mb-1">Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

            html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1">Attribute Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';

            html+='<div class="col-md-3"><label for="attr_image" class="control-label mb-1">&nbsp;</label><button type="button" onclick=remove_more("'+loop_count+'") class="btn btn-danger btn-lg form-control" ><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';

            html+='</div></div>';

            html+='</div></div>';
            jQuery('#product_attr_box').append(html);
        }
        function remove_more(loop_count)
        {  
            jQuery('#product_attr_'+loop_count).remove();
        }
        var loop_image_count=1;
        function add_image_more()
        {
            loop_image_count++;
            var html='<input id="piid" name="piid[]" type="hidden"><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';

            html+='<div class="col-md-2  product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">&nbsp;</label><button type="button" onclick=remove_image_more("'+loop_image_count+'") class="btn btn-danger btn-lg form-control" ><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';
            jQuery('#product_images_box').append(html);
        }
        function remove_image_more(loop_image_count)
        {  
            jQuery('.product_images_'+loop_image_count).remove();
        }
        CKEDITOR.replace('short_desc');
        CKEDITOR.replace('desc');
        CKEDITOR.replace('technical_specification');
    </script>         
@endsection