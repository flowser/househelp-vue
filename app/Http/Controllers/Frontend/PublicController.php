<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Standard\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Organisation\Organisation;
use App\Models\Standard\Webservices\Advert;
use App\Models\Standard\Webservices\ServiceModel;

class PublicController extends Controller
{

    public function index(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->hasAnyRole(['Director', 'Superadmin','Admin'])) {
                    return redirect('/dashboard');
            }elseif (auth()->user()->hasAnyRole(['Client', 'Affiliate'])) {
                $logged_user =Auth::user();
                $organisation = Organisation::with('about','services', 'servicemodels', 'adverts',
                              'organisationdirectors', 'organisationadmins', 'organisationemployees')
                              ->first();
                return view('layouts.frontend', compact("organisation", "logged_user"));
            }
        }
        else{
            $organisation = Organisation::with('about','services', 'servicemodels', 'adverts')
                          ->first();
                return view('layouts.frontend', compact("organisation"));
        }
        // return view('layouts.backend');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
