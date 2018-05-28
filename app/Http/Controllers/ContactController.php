<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Country;
use App\City;
use App\ContactStatus;
use App\ContactType;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if (Auth::user()->hasAnyRole('admin')) {
            $contacts = Contact::all();
        } else {
            $contacts = Contact::where('user_id',Auth::id())->get();
        }

        return view('contacts.index')->with(compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();
        $countries = Country::all()->pluck('name','id');
        $types = ContactType::all()->pluck('name','id');

        $status = ContactStatus::all();
        return view('contacts.create')->with(compact('cities','countries','status','types'));
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
        
        $this->validate($request,[
            "country" => "required",
            "city" => "required",
            "website" => "required",
            "company_name" => "required",
            "contact_type" => "required",
            "email" => "required",
            "status" => "required"
        ]); 
        Contact::create([
            //"country_id" => $request->country,
            "city_id" => $request->city,
            "website" => $request->website,
            "company_name" => $request->company_name,
            "contact_type_id" => $request->contact_type,
            "email" => $request->email,
            "phone" => $request->phone,
            "open_position" => $request->open_position,
            "contact_status_id" => $request->status,
            "observations" =>$request->observations,
            "user_id"=>Auth::id()
        ]);
        return redirect()->route('contacts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        $cities = City::all();
        $countries = Country::all()->pluck('name','id');
        $types = ContactType::all()->pluck('name','id');
        $status = ContactStatus::all();
        return view('contacts.edit')->with(compact('cities','countries','status','types','contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $this->validate($request,[
            "country" => "required",
            "city" => "required",
            "website" => "required",
            "company_name" => "required",
            "contact_type" => "required",
            "email" => "required",
            "status" => "required"
        ]); 
        
        
        $contact->city_id = $request->city;
        $contact->website = $request->website;
        $contact->company_name = $request->company_name;
        $contact->contact_type_id = $request->contact_type;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->open_position = $request->open_position;
        $contact->contact_status_id = $request->status;
        $contact->observations =$request->observations;
        $contact->user_id = Auth::id();
        $contact->save();
        
        return redirect()->route('contacts.index');
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();
        return redirect()->route('contacts.index');
    }
}
