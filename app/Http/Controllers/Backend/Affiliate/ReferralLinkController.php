<?php

namespace App\Http\Controllers\Backend\Affiliate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course\Referral\ReferralLink;
use App\Models\Course\Referral\ReferralCourse;

class ReferralLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('Affiliate')) {

                $referralLinks = Auth::user()->getReferrals();

                $referralCourses = ReferralCourse::with('refferallinks', 'course')//only where loged in user is related with
                        ->get();

               return response()-> json([
                    'referralLinks'   =>$referralLinks,
                    'referralCourses' =>$referralCourses,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 'user_id',
        // 'referral_course_id',
        // 'organisation_affiliate_id',
        // 'code'
            ReferralLink::create([
            'first_name'        => $request->first_name,
            'user_id'           => Auth::user()->id,
            'referral_course_id' => $request->referralCourse_id,
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
