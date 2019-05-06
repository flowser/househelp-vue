<?php

namespace App\Http\Controllers\Backend\Client\standard;

use Cart;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Order\CourseOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Client\Standard\Result;
use App\Models\Course\Referral\ReferralCommission;
use App\Models\Course\Referral\ReferralCourse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('Organisation Director')) {

                $orders = Order::with('client', 'courses')
                       ->get();
                    return response()-> json([
                    'orders' =>$orders,
                ], 200);
            }elseif (auth()->user()->hasRole('Client')) {

                $user =Auth::user();
                $client = $user->clients()->first();

                $results = Result::with('client','course', 'courseorder','manualcollections','parcelcollections')
                    ->where('client_id', $client->id)
                    ->get();

                $orders = Order::with('client', 'courses', 'results')
                    ->where('client_id', $client->id)
                    ->get();
                    return response()-> json([
                    'orders' =>$orders,
                    'results' =>$results,
                ], 200);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'transaction_code'  =>'required',
            'image'  =>'required',

          ]);
                $image = $request->image;
                     //processing passport name
                     $strpos = strpos($image, ';'); //positionof image name semicolon
                     $sub = substr($image, 0, $strpos);
                     $ex = explode('/', $sub)[1];
                     $name = time().".".$ex;

                     $Path = public_path()."/assets/organisation/img/clients/transactions";
                         $img = Image::make($image);
                         $img ->save($Path.'/'.$name);
                     //end processing
                $transaction_image= $name;

                $user =Auth::user();
                $client = $user->clients()->first();
                $Total = Cart::getTotal();


                $order = new Order();
                $order->client_id          = $client->id;
                $order->total              = (float) str_replace(',', '', $Total);
                $order->payment_method     = 'Mpesa';
                $order->transaction_code   = $request->transaction_code;
                $order->transaction_image  = $transaction_image;
                $order->save();

                if($order){
                    $cartItems = Cart::getContent();
                    if($cartItems){
                        foreach ($cartItems as $cartItem){
                            $order->courses()->attach($cartItem->id,[
                                    'payment_confirmation'=>false,
                                    'name'        => $cartItem->name,
                                    'courseType'  => $cartItem->attributes->courseType,
                                    'skill'       => $cartItem->attributes->skill,
                                    'image'       => $cartItem->attributes->image,
                                    'qty'         => $cartItem->quantity,
                                    'fee'         => $cartItem->price
                             ]);
                        }
                         Cart::clear();
                    }

                    $course_orders = CourseOrder::where('order_id', $order->id)
                                    ->get();
                    foreach($course_orders as $course_order){
                        Result::create([
                            'course_order_id'    => $course_order->id,
                            'course_id'          => $course_order->course_id,
                            'client_id'          => $client->id,
                            'course_status'      => 'Registered',
                            'certificate_status'  => null,
                            'collection_date'    => null,
                            'collection_method'  => null,
                        ]);
                    }
                        $referralCommission = ReferralCommission::with('refferal_link')->where('user_id', $user->id)->first();
                        if($referralCommission){
                            $user =Auth::user();
                            $client = $user->clients()->first();
                            $referral_course_id =  $referralCommission->refferal_link->course_id;
                            $course_order = CourseOrder::where('order_id', $order->id)
                                                       ->where('course_id', $referral_course_id)
                                    ->first();

                                if($course_order){
                                    $rate = '0.05'; //5% commision
                                        ReferralCommission::
                                            where('id', $referralCommission->id)
                                            ->update([
                                            'fee'                   =>$course_order->fee,
                                            'commission'            =>$rate * $course_order->fee,
                                            'courseType'            =>$course_order->courseType,
                                            'skill'                 =>$course_order->skill,
                                            'course_id'             =>$course_order->course_id,
                                            'paid_at'               =>$course_order->created_at,
                                            'image'                 =>$course_order->image,
                                            'name'                  =>$course_order->name,
                                            'payment_confirmation'  =>$course_order->payment_confirmation,
                                        ]);
                                }

                        }
                }
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
