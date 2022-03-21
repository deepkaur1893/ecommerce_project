<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data']=Coupon::all();
        return view('admin/coupon',$result);
    }

    public function manage_coupon(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Coupon::where(['id'=>$id])->get();
            //echo '<pre>';
            //print_r($result['data'][0]->title);
            //die();
            $result['title']=$arr[0]->title;
            $result['code']=$arr[0]->code;
            $result['value']=$arr[0]->value;
            $result['type']=$arr[0]->type;
            $result['min_order_amt']=$arr[0]->min_order_amt;
            $result['is_one_time']=$arr[0]->is_one_time;
            $result['status']=$arr[0]->status;
            $result['id']=$arr[0]->id;
        }
        else 
        {
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['type']='';
            $result['min_order_amt']='';
            $result['is_one_time']='';
            $result['status']='';
            $result['id']='';
        }
        return view('admin/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request)
    {
        //return $request->post();
        if($request->post('id')>0)
        {
            $model=Coupon::find($request->post('id'));
            $msg="Coupon Updated";
        }
        else 
        {
            $model= new coupon();
            $msg="Coupon Inserted";
            $request->validate([                        // do validation
                'title'=>'required',
                'value'=>'required',
                'code'=>'required|unique:coupons,code,'.$request->post('id')
            ]);
        }
        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->type=$request->post('type');
        $model->min_order_amt=$request->post('min_order_amt');
        $model->is_one_time=$request->post('is_one_time');
        $model->status=1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('admin/coupon');
    }

    public function delete(Request $request,$id)
    {
        $model=Coupon::find($id);
        $model->delete();
        $request->session()->flash('message','Coupon deleted');
        return redirect('admin/coupon');
    }
    public function status(Request $request,$status,$id)
    {
        //echo $status;
       // echo $id;
        $model=Coupon::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Coupon status Updated');
        return redirect('admin/coupon');
    }
}
