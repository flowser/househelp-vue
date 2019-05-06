<?php

namespace App\Http\Controllers\Backend\Webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;
use App\Models\Standard\Webservices\Advert;

class AdvertController extends Controller
{
    public function index()
    {

                $adverts = Advert::with('user', 'organisation')
                ->get();
                return response()-> json([
                    'adverts' => $adverts,
                ], 200);
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

        $this->validate($request,[
            'title' => 'required|min:2',
            'subtitle' => 'required|min:2',
            'details' => 'required|min:2',

        ]);
        // $me = Auth::user()->id;


            $advert = new Advert();
            $advert->title = $request ->title;
            $advert->subtitle = $request ->subtitle;
            $advert->details = $request ->details;

            $organisation= Organisation::first();

                //then
                $user = Auth::user();
                $advert->organisation_id = $organisation ->id;
                $advert->user_id = $user ->id;

            $strpos = strpos($request->advert_image, ';'); //positionof advert_image name semicolon
            $sub = substr($request->advert_image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;

            $Path = public_path()."/assets/organisation/img/website/adverts";
                $img = Image::make($request->advert_image);
            //            $img->crop(300, 150, 25, 25);
                $img ->save($Path.'/'.$name);
            $advert->advert_image = $name;
            //end processing photo and size

        $advert->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singleadvert = Advert::with('user', 'organisation')
                                ->find($id);
        return response()-> json([
            'singleadvert' => $singleadvert,
        ], 200);
    }

    public function AdvertByOrganisationID($id)
    {
        $advertsbyid = Advert::with('user', 'organisation')->where('organisation_id', $id)
                                ->orderBy('id', 'desc')
                                ->get();
        return response()-> json([
            'advertsbyid' => $advertsbyid,
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
        // $organisation = (Auth::user()-> organisationemployeeusers()->first()->organisation()->first());
        // $organisation = $organisation->organisations()->first();

        $advert = Advert::with('user', 'organisation')
                                ->find($id);
        // dd($organisation);
        return response()-> json([
            'advert' => $advert,
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
        $advert = Advert::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|min:2',
            'subtitle' => 'required|min:2',
            'details' => 'required|min:2',

        ]);
            $advert->title = $request ->title;
            $advert->subtitle = $request ->subtitle;
            $advert->details = $request ->details;
        //getting Organisation $user, about_id
        $organisation= Organisation::first();

        //getting Organisation $user, advert_id
        $organisation= Organisation::first();
                //then
                $user = Auth::user();
                $advert->organisation_id = $organisation ->id;
                $advert->user_id = $user ->id;

        //getting previous image
        $currentImage = $advert->advert_image;

        //processing image nme and size
        if($request->advert_image != $currentImage){
            $Path = public_path()."/assets/organisation/img/website/adverts/";

            // return $request->advert_image;
            $S_currentImage = $Path. $currentImage;
            //deleting if exists
                if(file_exists($S_currentImage)){
                    @unlink($S_currentImage);

                }
                $strpos = strpos($request->advert_image, ';'); //positionof image name semicolon
                $sub = substr($request->advert_image, 0, $strpos);
                $ex = explode('/', $sub)[1];
                $name = time().".".$ex;

                 $img = Image::make($request->advert_image);
                 $img ->save($Path.'/'.$name);
             //end processing
                 $advert->advert_image = $name;
        }else{
            $advert->advert_image = $request->advert_image;
        }

       $advert->save();
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $advert = Advert::findOrFail($id);
       $Path = public_path()."/assets/organisation/img/website/adverts/";

       $Advert_image = $Path. $advert->advert_image;

       if(file_exists($Advert_image)){
           @unlink($Advert_image);
       }
       $advert->delete();
   }
}
