<?php

namespace App\Http\Controllers\Backend\Househelp;

use Illuminate\Http\Request;
use App\Models\Standard\User;
use App\Models\Househelp\Review;
use App\Http\Controllers\Controller;


class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
public function index()
{
    if (auth('api')->check()) {
        if (auth('api')->user()->hasAnyRole(['Superadmin','Admin','Director'])) {
            $reviews = Review::
                    with('bureauhousehelp', 'organisationclient', 'bureau')
                    ->paginate(7);
        }
    }
    return response()-> json([
        'reviews'=>$reviews,
    ], 200);
}

    public function bureau()
    {
        if (auth('api')->check()) {
            if (auth('api')->user()->hasAnyRole(['Bureau Director','Bureau Admin'])) {
                if (auth('api')->user()->hasAnyRole(['Bureau Director'])) {
                    $bureaudirector = auth('api')->user()->bureaudirectors()->first();
                    $users = User::whereHas('bureauhousehelps', function($query) use($bureaudirector)
                                {
                                  $query ->where('bureau_id', $bureaudirector->bureau_id);
                                }
                            )
                            ->with('roles','permissions','bureauhousehelps')
                            ->paginate(7);
                }
                else if (auth('api')->user()->hasAnyRole(['Bureau Admin'])) {
                    $bureauadmin = auth('api')->user()->bureauadmins()->first();

                    $users = User::whereHas('bureauhousehelps', function($query) use( $bureauadmin)
                                {
                                  $query ->where('bureau_id',  $bureauadmin->bureau_id);
                                }
                            )
                            ->with('roles','permissions','bureauhousehelps')
                            ->paginate(7);
                }
                return response()-> json([
                    'users'=>$users,
                ], 200);
            }
        }
    }
    public function approved ($id)
    {

    }
    public function pending ($id)
    {

    }
// view by organisation reviews by bureau id
    public function bureau_id_approved ($id)
    {

    }
    public function bureau_id_pending ($id)
    {

    }

    public function store(Request $request)
    {


    }
        public function show($id)
    {
        $review = User::with('roles','permissions','organisationreviews')
                            ->find($id);
        return response()-> json([
            'review'=>$review,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::with('roles','permissions','organisationreviews')
                        ->find($id);
        return response()-> json([
            'user'=>$user,
        ], 200);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}




