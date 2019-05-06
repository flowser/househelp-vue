<?php

namespace App\Http\Controllers\Backend\Webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;
use App\Models\Standard\Webservices\Service;

class ServiceController extends Controller
{
    public function index()
    {

        $services = Service::with('user', 'organisation', 'servicemodels')
                    // ->where('services.organisation_id', $organisation->id)
                    ->get();
        // dd($service);
        return response()-> json([
        'services' => $services,
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
        // return $request;
        $this->validate($request,[
            'title' => 'required|min:2',
            'service_title' => 'required|min:2',
            'service_details' => 'required',
            // 'organisation_id' => 'required',
            // 'bureau_id' => 'required',
        ]);

        $service = new Service();
        $service->title = $request ->title;
        $service->service_title = $request ->service_title;
        $service->service_details = $request ->service_details;

        //getting Organisation $user
        $organisation= Organisation::first();
                //then
                $user = Auth::user();
                $service->organisation_id = $organisation ->id;
                $service->user_id = $user ->id;

        $strpos = strpos($request->service_image, ';'); //positionof image name semicolon
        $sub = substr($request->service_image, 0, $strpos);
        $ex = explode('/', $sub)[1];
        $name = time().".".$ex;

        $Path = public_path()."/assets/organisation/img/website/services";
            $img = Image::make($request->service_image);
//            $img->crop(300, 150, 25, 25);
            $img ->save($Path.'/'.$name);
        $service->service_image = $name;
        //end processing photo and size
        $service->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $singleservice = Service::find($id);
        // dd($organisation);
        return response()-> json([
            'singleservice' => $singleservice,
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
        // $organisation= (Auth::user()-> organisationemployeeusers()->first()->organisation()->first());
        $service = Service::find($id);
        // dd($organisation);
        return response()-> json([
            'service' => $service,
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
        // return $request;
        $service = Service::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|min:2',
            'service_title' => 'required|min:2',
            'service_details' => 'required',
        ]);


        $service->title = $request ->title;
        $service->service_title = $request ->service_title;
        $service->service_details = $request ->service_details;

        //getting Organisation $user, service_id
        $organisation= Organisation::first();
                //then
                $user = Auth::user();
                $service->organisation_id = $organisation ->id;
                $service->user_id = $user ->id;

        //getting previous service_image
        $currentImage = $service->service_image;

        //processing service_image nme and size
        if($request->service_image != $currentImage){
            $Path = public_path()."/assets/organisation/img/website/services/";

            // return $request->service_image;
            $S_currentImage = $Path. $currentImage;
            //deleting if exists
                if(file_exists($S_currentImage)){
                    @unlink($S_currentImage);

                }
                $strpos = strpos($request->service_image, ';'); //positionof image name semicolon
                $sub = substr($request->service_image, 0, $strpos);
                $ex = explode('/', $sub)[1];
                $name = time().".".$ex;

                 $img = Image::make($request->service_image);
                 $img ->save($Path.'/'.$name);
             //end processing
                 $service->service_image = $name;
        }else{
            $service->service_image = $request->service_image;
        }
        $service->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        //image inline with this organisation
        $Path = public_path()."/assets/organisation/img/website/services";

        $Service_image = $Path. $service->service_image;

        if(file_exists($Service_image)){
            @unlink($Service_image);
        }
        $service->delete();
    }


}
