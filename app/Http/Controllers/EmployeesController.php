<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Http\Requests\StoreEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('employees.view', [
            'employees' => Employees::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('employees.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'salary' => ['required'],
            'joiningDate' => ['required']
        ]);

        
        $employee = Employees::create([
            'name' => $request->firstName." ".$request->lastName,
            'email' => $request->email,
            'salary' => $request->salary,
            'dateOfJoining' => $request->joiningDate,
        ]);
     
        return redirect('employees')->with('message', 'Employee Record Added Successfully!' );

    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //
        
        if($request->status == "1")
        {
            Employees::whereId($id)->update([
                'inService' => 0
            ]);
    
        }
        else
        {
            Employees::whereId($id)->update([
                'inService' => 1
            ]);
        }
        
        return redirect('employees')->with('message', 'Employee Service Status Updated Successfully!' );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeesRequest $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Employees::where('id',$id)->delete();
        return redirect('/employees')->with('message', 'Employees Deleted Successfully!' );
        
    }
}
