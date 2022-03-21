@extends('admin/layout')
@section('page_title','Manage Brand')
@section('brand_select','active')
@section('container')

    <h1 class="mb10">Manage Brand</h1>  
    @error('image.*')
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>  
    @enderror
    <!---<a href="brand">-->
    <a href="{{url('admin/brand')}}">   <!-- we used this to resolved error of pages /brand/brand in url-->
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('brand.manage_brand_process')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="brand" class="control-label mb-1"> Brand</label>
                                <input id="brand" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Image</label>
                                <input id="image" value="{{$image}}" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                @error('image')
                                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                                @enderror
                                @if($image!='')
                                    <img src="{{asset('storage/media/brand/'.$image)}}" width="50px" alt="">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="is_home" class="control-label mb-1">Show in Home Page</label>
                                <input id="is_home" value="{{$is_home}}" name="is_home" type="checkbox" {{$is_home_selected}} />
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