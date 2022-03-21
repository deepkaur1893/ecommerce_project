@extends('admin/layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')
    <h1 class="mb10">Manage Category</h1>  
    <!---<a href="category">-->
    <a href="{{url('admin/category')}}">   <!-- we used this to resolved error of pages /category/category in url-->
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="category_name" class="control-label mb-1">Category Name</label>
                                        <input id="category_name" value="{{$category_name}}" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('category_name')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                        <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('category_slug')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="parent_category_id" class="control-label mb-1">Parent Category Id</label>
                                        <select id="parent_category_id" name="parent_category_id" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="0">Select Categories</option>
                                            @foreach($category as $list)
                                                @if($parent_category_id==$list->id)
                                                    <option value="{{$list->id}}" selected >{{$list->category_name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('$parent_category_id')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-4"><br>
                                        <label for="is_home" class="control-label mb-1">Show in Home Page</label>
                                        <input id="is_home" value="{{$is_home}}" name="is_home" type="checkbox" {{$is_home_selected}} />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="category_image" class="control-label mb-1">Image</label>
                                        <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                    </div>  
                                    <div class="col-md-4">
                                        @if($category_image!='')
                                        <a href="{{asset('storage/media/category/'.$category_image)}}" target="_blank"><img src="{{asset('storage/media/category/'.$category_image)}}" width="100px" alt=""></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    Submit
                                </button>
                            </div>
                            <input type="hidden" name="id" value="{{$id}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
                      
        </div>
    </div>           
@endsection