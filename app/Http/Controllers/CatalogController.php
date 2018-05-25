<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Country;
use App\City;
use App\ContactStatus;
use App\ContactType;

class CatalogController extends Controller
{
    //

    public function index(){
        $cities = City::all();
        $countries = Country::all();
        $status = ContactStatus::all();
        $types = ContactType::all();
        return view ('catalogs.index')->with(compact('cities','countries','status','types'));
    }
}
