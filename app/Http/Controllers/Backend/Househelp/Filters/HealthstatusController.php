<?php

namespace App\Http\Controllers\Backend\Househelp\Filters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Househelp\Standard\Healthstatus;

class HealthstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value1 = 'Healthy';
        $value2 = 'HASMINOR';
        $value3 = 'HASCHRONIC';

        $healthstatuses1 = Healthstatus::with('househelp')
            ->where('status', '=', $value1)
            ->get();

        $healthstatuses2 = Healthstatus::with('househelp')
            ->where('status', '=', $value2)
            ->get();
        $healthstatuses3 = Healthstatus::with('househelp')
            ->where('status', '=', $value3)
            ->get();

                //customising virtualtable fromsametableas if fromdifferent with elouent relationship
                $id = 'id';
                $name = 'name';
                $count = 'househelps';

                $output1 = [
                    $id => '1',
                    $name => 'Healthy',
                    $count => $healthstatuses1->count()];

                $output2 = [
                    $id => '2',
                    $name => 'HASMINOR',
                    $count => $healthstatuses2->count()];

                $output3 = [
                    $id => '3',
                    $name => 'HASCHRONIC',
                    $count => $healthstatuses3->count()];

                $healthstatuses = [
                    $output1,
                    $output2,
                    $output3,
                ];

                   return response()-> json([
                        'healthstatuses' => $healthstatuses,
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
        //
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
