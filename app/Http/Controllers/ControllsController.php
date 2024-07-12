<?php

namespace App\Http\Controllers;

use App\Models\Payrolls;
use App\Models\SalaryUnits;
use App\Models\SocialBenefits;
use App\Models\SolidarityFunds;
use App\Models\WithholdingsTaxes;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ControllsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('controls.view', [
            'salaryUnits' => SalaryUnits::all(),
            'socialBenefits' => SocialBenefits::all(),
            'solidarityFunds' => SolidarityFunds::all(),
            'withHoldingsTaxes' => WithholdingsTaxes::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payrolls $payrolls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //
        if($request->SMMLV)
        {
            SalaryUnits::whereId($id)->update([
                'value' => $request->SMMLV
            ]);
        }

        if($request->UVT)
        {
            SalaryUnits::whereId($id)->update([
                'value' => $request->UVT
            ]);
           
        }

        return redirect('controls')->with('message', 'Salary Unit Updated Successfully!' );
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payrolls $payrolls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payrolls $payrolls)
    {
        //
    }
}
