<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  //for encrypt or decrypt password
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $result['home_categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['is_home'=>1])
        ->get();

        foreach($result['home_categories'] as $list)
        {
            $result['home_categories_product'][$list->id]=DB::table('products')
            ->where(['status'=>1])
            ->where(['category_id'=>$list->id])
            ->get();

            foreach($result['home_categories_product'][$list->id] as $list1)
            {
                $result['home_product_attr'][$list1->id]=DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where(['product_attr.products_id'=>$list1->id])
                ->get();
            }
        }

        $result['home_brands']=DB::table('brands')
        ->where(['status'=>1])
        ->where(['is_home'=>1])
        ->get();
        
        $result['home_featured_product'][$list->id]=DB::table('products')
        ->where(['status'=>1])
        ->where(['is_featured'=>1])
        ->get();

        foreach($result['home_featured_product'][$list->id] as $list1)
        {
            $result['home_featured_product_attr'][$list1->id]=DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colors','colors.id','=','product_attr.color_id')
            ->where(['product_attr.products_id'=>$list1->id])
            ->get();
        }

        $result['home_tranding_product'][$list->id]=DB::table('products')
        ->where(['status'=>1])
        ->where(['is_tranding'=>1])
        ->get();

        foreach($result['home_tranding_product'][$list->id] as $list1)
        {
            $result['home_tranding_product_attr'][$list1->id]=DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colors','colors.id','=','product_attr.color_id')
            ->where(['product_attr.products_id'=>$list1->id])
            ->get();
        }

        $result['home_discounted_product'][$list->id]=DB::table('products')
        ->where(['status'=>1])
        ->where(['is_discounted'=>1])
        ->get();

        foreach($result['home_discounted_product'][$list->id] as $list1)
        {
            $result['home_discounted_product_attr'][$list1->id]=DB::table('product_attr')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colors','colors.id','=','product_attr.color_id')
            ->where(['product_attr.products_id'=>$list1->id])
            ->get();
        }

        //echo "<pre>";
        //print_r($result);
        //die();
        return view('front.index',$result);
    }
}
