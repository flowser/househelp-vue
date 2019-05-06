<?php

namespace App\Http\Controllers\Backend\Webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Standard\Webservices\Service;
use App\Models\Standard\Webservices\ServiceModel;


class ServiceModelController extends Controller
{
    public function index()
    {
                $servicemodels = ServiceModel::with('user', 'service')
                ->get();
                return response()-> json([
                    'servicemodels' => $servicemodels,
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
    public function store(Request $request, $id)
    {

        $this->validate($request,[
            'title' => 'required|min:2',
            'details' => 'required|min:2',

        ]);
        // $me = Auth::user()->id;

        $service = Service::find($id);


            $servicemodel = new ServiceModel();
            $servicemodel->title = $request ->title;
            $servicemodel->details = $request ->details;

            $user = Auth::user();
            $servicemodel->service_id = $service->id;
            $servicemodel->user_id = $user ->id;

            $strpos = strpos($request->image, ';'); //positionof image name semicolon
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;

            $Path = public_path()."/assets/organisation/img/website/services/servicemodels";
                $img = Image::make($request->image);
            //            $img->crop(300, 150, 25, 25);
                $img ->save($Path.'/'.$name);
            $servicemodel->image = $name;
            //end processing photo and size

        $servicemodel->save();
    }

    public function show($id)
    {
        $singleservicemodel = ServiceModel::with('user', 'service')
                                ->find($id);
        return response()-> json([
            'singleservicemodel' => $singleservicemodel,
        ], 200);
    }

    public function ServiceModelsByServiceID($id)
    {
        $servicemodels = ServiceModel::with('user', 'service')->where('service_id', $id)
                                ->orderBy('id', 'desc')
                                ->get();
        return response()-> json([
            'servicemodels' => $servicemodels,
        ], 200);
    }
    public function search()
    {
        $search = \Request::get('s');
        if($search !=null) {
            $servicemodels = ServiceModel::with('user', 'service')
                ->where('title','LIKE',"%$search%")
                ->orWhere('details','LIKE',"%$search%")
                ->get();
                return response()->json([
                    'servicemodels' => $servicemodels,
                ], 200);
        }else{
            return $this->index();
        }
    }
    public function latestservicemodels()
     {
        $servicemodels = ServiceModel::with('user', 'service')->orderBy('id', 'desc')->get();
        return response()->json([
            'servicemodels' => $servicemodels,
        ], 200);
    }
    public function LatestServiceModelsByServiceID($id)
     {
        $servicemodels = ServiceModel::with('user', 'service')->where('service_id', $id)->orderBy('id', 'desc')->get();
        return response()->json([
            'servicemodels' => $servicemodels,
        ], 200);
    }
    public function LatestServiceModelsBySingleModelID($id)
     {
         $service = ServiceModel::find($id)->service()->first();

        $servicemodels = ServiceModel::with('user', 'service')->where('service_id', $service->id)->orderBy('id', 'desc')->get();
        return response()->json([
            'servicemodels' => $servicemodels,
        ], 200);
    }


    public function edit($id)
    {
        // $organisation = (Auth::user()-> organisationemployeeusers()->first()->organisation()->first());
        // $service = $organisation->services()->first();

        $servicemodel = ServiceModel::with('user', 'service')
                                ->find($id);
        // dd($organisation);
        return response()-> json([
            'servicemodel' => $servicemodel,
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
        $servicemodel = ServiceModel::findOrFail($id);


        $this->validate($request,[
            'title' => 'required|min:2',
            'details' => 'required|min:2',
        ]);

        $servicemodel->title = $request ->title;
        $servicemodel->details = $request ->details;
        //getting Organisation $user, about_id
        $user = Auth::user();
        $servicemodel->user_id = $user ->id;

        //getting previous image
        $currentImage = $servicemodel->image;

        //processing image nme and size
        if($request->image != $currentImage){
            $Path = public_path()."/assets/organisation/img/website/services/servicemodels/";

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
                 $servicemodel->image = $name;
        }else{
            $servicemodel->image = $request->image;
        }

       $servicemodel->save();
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $servicemodel = ServiceModel::findOrFail($id);
       //image inline with this organisation
       $Path = public_path()."/assets/organisation/img/website/services/servicemodels/";

       $Image = $Path. $servicemodel->image;

       if(file_exists($Image)){
           @unlink($Image);
       }
       $servicemodel->delete();
   }







}


