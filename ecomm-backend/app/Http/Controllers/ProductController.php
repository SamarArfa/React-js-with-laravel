<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function addProduct(Request $req){

        $products =new product;
        $products->name=$req->input('name');
        $products->price=$req->input('price');
        $products->file_path= $req->file('file_path')->store('products');
        $products->description=$req->input('description');
        $products->save();
        return $products;
    }
    function list(){


        return product::all();
    }

    function delete($id){

        $result=product::where('id',$id)->delete();
        if($result){

            return ["result"=>"product has been delete"];

        }else{
            return ["result"=>"operation failed"];

        }
    }

    function getProduct($id){

        return product::find($id);

    }
    function updateProduct($id,Request $req){
        $products =product::find($id);
        $products->name=$req->input('name');
        $products->price=$req->input('price');
        $products->description=$req->input('description');
        if( $req->file('file_path')){
            $products->file_path= $req->file('file_path')->store('products');
        }
        $products->save();
        return $products;
//        return  $req->input();


    }
    function search($key){

        return product::where('name','like',"%$key%")->get();

    }
}
