<?php

namespace App\Http\Controllers\Backend\Househelp\Filters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Househelp\Standard\Idstatus;

class IDstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value1 = 'yes';
        $value2 = 'no';

        $idstatuses1 = Idstatus::with('househelp')
            ->where('status', '=', $value1)
            ->get();

        $idstatuses2 = Idstatus::with('househelp')
            ->where('status', '=', $value2)
            ->get();


                //customising virtualtable fromsametableas if fromdifferent with elouent relationship
                $id = 'id';
                $name = 'name';
                $count = 'househelps';

                $output1 = [
                    $id => '1',
                    $name => 'yes',
                    $count => $idstatuses1->count()];
                $output2 = [
                    $id => '2',
                    $name => 'no',
                    $count => $idstatuses2->count()];

                $idstatuses = [
                    $output1,
                    $output2,
                ];

                   return response()-> json([
                        'idstatuses' => $idstatuses,
                    ], 200);
    }

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
