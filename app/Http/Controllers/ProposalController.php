<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proposals = Proposal::all();
        return view('proposals.index')->with(compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('proposals.create');
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
        $request->validate([
            'company'=>'required',
            'owner'=>'required',
            'object'=>'required',
            'positions'=>'required',
            'names'=>'required',
            'name'=>'required',
            'webdev'=>'required',
            'timeline'=>'required',
            'milestones'=>'required',
            'lenght'=>'required',
            'date'=>'required'
        ]);
        
        $team = [];
        foreach($request->positions as $key => $position){
            $team[$key] =[
                'position'=>$position,
                'name'=>$request->names[$key]
            ];
        }
        // dd($team);
        Proposal::create([
            'company'=>$request->company,
            'owner'=>$request->owner,
            'object'=>$request->object,
            'team'=>serialize($team),
            'name'=>$request->name,
            'webdev'=>$request->webdev,
            'timeline'=>$request->timeline,
            'milestones'=>serialize($request->milestones),
            'lenght'=>$request->lenght,
            'date'=>$request->date
        ]);
        return redirect()->route('proposal.index');        
    }

    public function export(Proposal $proposal){
        $view =  \View::make('pdf.proposal', compact('proposal'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('Contract.pdf');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}
