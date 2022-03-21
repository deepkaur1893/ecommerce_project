<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=Color::all();
        return view('admin/color',$result);
    }

    public function manage_color(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=Color::where(['id'=>$id])->get();
            //echo '<pre>';
            //print_r($result['data'][0]->category_name);
            //die();
            $result['color']=$arr[0]->color;
            $result['status']=$arr[0]->status;
            $result['id']=$arr[0]->id;
        }
        else 
        {
            $result['color']='';
            $result['status']='';
            $result['id']='';
        }
        return view('admin/manage_color',$result);
    }

    public function manage_color_process(Request $request)
    {
        //return $request->post();
       

        
        if($request->post('id')>0)
        {
            $model=Color::find($request->post('id'));
            $msg="Color Updated";
        }
        else 
        {
            $model= new color();
            $msg="Color Inserted";
            $request->validate([                        // do validation
                'color'=>'required|unique:colors,color,'.$request->post('id')
            ]);
        }
        $model->color=$request->post('color');
        $model->status=1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('admin/color');
    }

    public function delete(Request $request,$id)
    {
        $model=Color::find($id);
        $model->delete();
        $request->session()->flash('message','Color deleted');
        return redirect('admin/color');
    }
    
    public function status(Request $request,$status,$id)
    {
        //echo $status;
       // echo $id;
        $model=Color::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Color status Updated');
        return redirect('admin/color');
    }
}
