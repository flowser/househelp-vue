<?php

namespace App\Http\Controllers\Backend\Webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;
use App\Models\Standard\Webservices\Feature;



class FeatureController extends Controller
{
    public function index()
    {

                $features = Feature::with('user', 'organisation')
                ->get();
                return response()-> json([
                    'features' => $features,
                ], 200);
    }
    public function organisations()//all features linked to organisation
    {
        $features = Feature::with('user', 'organisation')
                    // ->where('features.organisation_id', $organisation->id)
                    ->get();
        // dd($feature);
        return response()-> json([
        'features' => $features,
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
            'details' => 'required|min:2',

        ]);
        // $me = Auth::user()->id;



            $feature = new Feature();
            $feature->title = $request ->title;
            $feature->details = $request ->details;

            $organisation= Organisation::first();

                //then
                $user = Auth::user();
                $feature->organisation_id = $organisation ->id;
                $feature->user_id = $user ->id;

            $strpos = strpos($request->image, ';'); //positionof image name semicolon
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;

            $Path = public_path()."/assets/organisation/img/website/features";
                $img = Image::make($request->image);
            //            $img->crop(300, 150, 25, 25);
                $img ->save($Path.'/'.$name);
            $feature->image = $name;
            //end processing photo and size

        $feature->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singlefeature = Feature::with('user', 'organisation')
                                ->find($id);
        return response()-> json([
            'singlefeature' => $singlefeature,
        ], 200);
    }

    public function FeatureByOrganisationID($id)
    {
        $featuresbyid = Feature::with('user', 'organisation')->where('organisation_id', $id)
                                ->orderBy('id', 'desc')
                                ->get();
        return response()-> json([
            'featuresbyid' => $featuresbyid,
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

        $feature = Feature::with('user', 'organisation')
                                ->find($id);
        // dd($organisation);
        return response()-> json([
            'feature' => $feature,
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
        $feature = Feature::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|min:2',
            'details' => 'required|min:2',
        ]);

        $feature->title = $request ->title;
        $feature->details = $request ->details;
        //getting Organisation $user, about_id
                $organisation= Organisation::first();

        //getting Organisation $user, feature_id
        $organisation= Organisation::first();
                //then
                $user = Auth::user();
                $feature->organisation_id = $organisation ->id;
                $feature->user_id = $user ->id;

        //getting previous image
        $currentImage = $feature->image;

        //processing image nme and size
        if($request->image != $currentImage){
            $Path = public_path()."/assets/organisation/img/website/features/";

            // return $request->image;
            $S_currentImage = $Path. $currentImage;
            //deleting if exists
                if(file_exists($S_currentImage)){
                    @unlink($S_currentImage);

                }
                $strpos = strpos($request->image, ';'); //positionof image name semicolon
                $sub = substr($request->image, 0, $strpos);
                $ex = explode('/', $sub)[1];
                $name = time().".".$ex;

                 $img = Image::make($request->image);
                 $img ->save($Path.'/'.$name);
             //end processing
                 $feature->image = $name;
        }else{
            $feature->image = $request->image;
        }

       $feature->save();
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $feature = Feature::findOrFail($id);
       //image inline with this organisation
       $Path = public_path()."/assets/organisation/img/website/features/";

       $Image = $Path. $feature->image;

       if(file_exists($Image)){
           @unlink($Image);
       }
       $feature->delete();
   }


}


