<?php

namespace App\Http\Controllers\Backend\Client\standard;


use Cart;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;


class CartController extends Controller
{

    public function index()
    {
        // Cart::clear();
        $cartItems = Cart::getContent();
        $Count     = $cartItems->count();
        $subTotal = Cart::getSubTotal();


        $Total = Cart::getTotal();
            return response()-> json([
            'cartItems' => $cartItems,
            'subTotal' =>$subTotal,
            'Total' =>$Total,
            'Count' =>$Count,
        ], 200);
    }

    public function store(Request $request)
    {

        $id = $request->id;
        if($request->regular_fee){
            $fee = $request->regular_fee;
        }else{
            $fee = $request->parttime_fee;
        }

        $course = Course::with(
            'coursesyllabus',
            // 'reviews',
            'accessibility',
            'skill',
            'school',
            'duration',
            'availability',
            'subject',
            'type',
            'feature',
            'language'
            )->find($id);

        $findCartbyID = Cart::get($id);

        if($findCartbyID){
            return response()-> json([
                'code'      =>  401,
                'message'   => 'Already have the Course in your Cart'
            ], 400);

        }else{
            $cart = Cart::add(array(
                'id' => $id,
                'name' => $course->name,
                'price' => $fee,
                'quantity' => 1,
                'attributes' => array(
                    'image' => $course->image,
                    'courseType' => $request->courseType,
                    'skill' => $course->skill->name,
                    )
            ));

            if($cart){
                $cartItems = Cart::getContent();
                return response()-> json([
                'cartItems' => $cartItems,
                'code'      =>  200,
                'message'   => 'Course Added Successffully'
            ], 200);
            }
        }

    }

    public function remove($id)
    {
        Cart::remove($id);
    }
    public function clear($id)
    {
        Cart::clear();
    }

}
