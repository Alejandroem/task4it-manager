<?php

namespace App\Http\Controllers;

use App\RequirementName;
use App\Project;
use App\Budget;
use Illuminate\Http\Request;
use Debugbar;
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $budgets = Budget::all();
        return view('budgets.index')->with(compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $names = RequirementName::where('parent_id',null)->get();
        $projects = Project::pluck('name','id');
        $budget = null;
        return view('budgets.create')->with(compact('names','projects','budget'));
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
            'name'=>'required'
        ]);
        
        $all = RequirementName::whereNotNull('parent_id')->get();
        foreach( $all as $requirement){
            Debugbar::info($all);
            Debugbar::info($request->input());
            Debugbar::info(str_replace(" ", "_",$requirement->name).'-amount');
            $requirement->base_rate = $request->get(str_replace(" ", "_",$requirement->name).'-amount');
            $requirement->save();
        }
        
        $values = $request->input();
        $selectedReq = 
        array_filter($values, function($element){
            return isset($element) && $element== "on";
        });
        
        $budget = Budget::create([
            'name'=>$request->name,
            'project_id'=> $request->project? $request->project : null,
        ]);
        
        foreach($selectedReq as $key => $requirement){
            $rate = $request->get(str_replace(" ", "_",$key).'-amount');
            $rate = $rate? $rate : 0;
            $reqObj =  RequirementName::where('name',$key)->first();
            $budget->requirements()->save($reqObj,['rate'=>$rate]);
        }
        return redirect()->route('budgets.index');
        
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
        $names = RequirementName::where('parent_id',null)->get();
        $projects = Project::pluck('name','id');
        $budget = Budget::find($id);
        return view('budgets.edit')->with(compact('names','projects','budget'));
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
        $this->validate($request,[
            'name'=>'required'
        ]);
        $all = RequirementName::whereNotNull('parent_id')->get();
        foreach( $all as $requirement){
            Debugbar::info($all);
            Debugbar::info($request->input());
            Debugbar::info(str_replace(" ", "_",$requirement->name).'-amount');
            $requirement->base_rate = $request->get(str_replace(" ", "_",$requirement->name).'-amount');
            $requirement->save();
        }
        
        $values = $request->input();
        $selectedReq = 
        array_filter($values, function($element){
            return isset($element) && $element== "on";
        });
        $budget = Budget::find($id);
        $budget->name = $request->name;
        $budget->project_id = $request->project? $request->project : null;
        $budget->requirements()->detach($budget->requirements()->pluck('id'));
        foreach($selectedReq as $key => $requirement){
            $rate = $request->get($key.'-amount');
            $rate = $rate? $rate : 0;
            $reqObj =  RequirementName::where('name',$key)->first();
            $budget->requirements()->save($reqObj,['rate'=>$rate]);
        }
        $budget->save();
        return redirect()->route('budgets.index');
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
        $budget = Budget::find($id);
        $budget->requirements()->detach($budget->requirements()->pluck('id'));
        $budget->delete();
        return back();
    }


    public function export($id){
        $budget = Budget::find($id);
        
        $total = 0;
        foreach($budget->requirements as $requirement){
            $total+= floatval($requirement->pivot->rate);
        }
        Debugbar::info($budget->requirements->groupBy('parent_id'));
        $requirements = $budget->requirements->groupBy('parent_id');
        $view =  \View::make('pdf.requirements', compact('requirements', 'total'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($budget->name.($budget->project? "-".$budget->project."-":"").'-invoice.pdf');
    }
}
