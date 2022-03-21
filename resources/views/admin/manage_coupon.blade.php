@extends('admin/layout')
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('container')
    <h1 class="mb10">Manage Coupon</h1>  
    <!---<a href="coupon">-->
    <a href="{{url('admin/coupon')}}">   <!-- we used this to resolved error of pages /coupon/coupon in url-->
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title" class="control-label mb-1">Coupon Tiltle</label>
                                        <input id="title" value="{{$title}}" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('$title')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="code" class="control-label mb-1">Coupon Code</label>
                                        <input id="code" value="{{$code}}" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('$code')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="value" class="control-label mb-1">Coupon Value</label>
                                        <input id="value" value="{{$value}}" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('$value')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="type" class="control-label mb-1">Type</label>
                                        <select id="type" name="type" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select Promo</option>
                                                @if($type=='Value')
                                                    <option value="Value" selected >Value</option>
                                                    <option value="Per" >Per</option>
                                                @elseif($type=='Per')
                                                    <option value="Value" >Value</option>
                                                    <option value="Per" selected>Per</option>
                                                @else
                                                    <option value="Value" >Value</option>
                                                    <option value="Per" >Per</option>
                                                @endif
                                        </select>
                                        @error('$type')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="min_order_amt" class="control-label mb-1">Min Order Amount</label>
                                        <input id="min_order_amt" value="{{$min_order_amt}}" name="min_order_amt" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                        @error('$min_order_amt')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                        <select id="is_one_time" name="is_one_time" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select One Time</option>
                                                @if($is_one_time=='1')
                                                    <option value="1" selected >Yes</option>
                                                    <option value="0" >No</option>
                                                @else
                                                    <option value="1" >Yes</option>
                                                    <option value="0" selected>No</option>
                                                @endif
                                        </select>
                                        @error('$is_one_time')
                                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                                        @enderror
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