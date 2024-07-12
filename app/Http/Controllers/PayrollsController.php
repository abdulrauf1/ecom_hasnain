<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Payrolls;
use App\Models\SalaryUnits;
use App\Models\SocialBenefits;
use App\Models\SolidarityFunds;
use App\Models\WithholdingsTaxes;
use App\Models\Deductions;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class PayrollsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('payrolls.view', [
            // 'employees' => Employees::paginate(5),
            'payrolls' => Payrolls::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('payrolls.add',[
            'employees' => Employees::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $name = Employees::where('id',$request->emp_id)->first()->name;
        
        $payrol = Payrolls::create([

            'emp_id'                    => ($request->emp_id)?$request->emp_id:0,
            'pid'                       => ($request->emp_id)?substr(number_format(time() * rand(),0,'',''),0,6)."-".$name."-".$request->email:substr(number_format(time() * rand(),0,'',''),0,6)."-".$request->payeeName."-".$request->email,
            'month'                     => $request->salaryMonth,
            'salary'                    => $request->salary,
            'relocation'                => ($request->relocation)?$request->relocation:0,
            'bonus'                     => ($request->bonus)?$request->bonus:0,
            'transportationSubsidy'     => ($request->transportationSubsidy)?$request->transportationSubsidy:0,
            'nonSalaryBenefit'          => ($request->nonSalaryBenefit)?$request->nonSalaryBenefit:0,
            'prepaid'                   => ($request->prepaid)?$request->prepaid:0,
            'prepaidMedicine'           => ($request->prepaidMedicine)?$request->prepaidMedicine:0,
            'housingInterest'           => ($request->housingInterest)?$request->housingInterest:0,
            'voluntryPension'           => ($request->voluntryPension)?$request->voluntryPension:0,
            'afcAccounts'               => ($request->afcAccounts)?$request->afcAccounts:0,
            
        ]);
        return redirect('payrolls')->with('message', 'Payrol created Successfully!' );
    }


    public function calculator(Request $request)
    {
        //
    //     dd("dd");
    //    exit(0);
        $payeeName = $request->payeeName;
        $pid  = 'test';
        $month = $request->salaryMonth;
        $salary = $request->salary;
        $relocation = ($request->relocation)?$request->relocation:0;
        $bonus = ($request->bonus)?$request->bonus:0;
        $transportationSubsidy = ($request->transportationSubsidy)?$request->transportationSubsidy:0;
        $nonSalaryBenefit = ($request->nonSalaryBenefit)?$request->nonSalaryBenefit:0;
        $prepaid = ($request->prepaid)?$request->prepaid:0;
        $prepaidMedicine = ($request->prepaidMedicine)?$request->prepaidMedicine:0;
        $housingInterest = ($request->housingInterest)?$request->housingInterest:0;
        $voluntryPension = ($request->voluntryPension)?$request->voluntryPension:0;
        $afcAccounts = ($request->afcAccounts)?$request->afcAccounts:0;
        
        $smmlv = (double)SalaryUnits::where('unit', 'SMMLV')->first()->value;
        $uvt = (double)SalaryUnits::where('unit', 'UVT')->first()->value;
        $maxBase = (double)SocialBenefits::where('concept', 'Maximum Base')->first()->value;
        $health = (double)SocialBenefits::where('concept', 'Health')->first()->value;
        $pension = (double)SocialBenefits::where('concept', 'Pension')->first()->value;
        $sld = (double)SocialBenefits::where('concept', 'Solidarity Fund')->first()->value;
        $baseBenefit = (double)SocialBenefits::where('concept', 'Base Benifits')->first()->percentage;
        $dpm = (double)Deductions::where('concept', 'Prepaid medicine')->first()->value;
        $dhi = (double)Deductions::where('concept', 'Housing Interest')->first()->value;
        
        $nonSalaryIncome = findNonSalaryIncome($relocation,$bonus,$transportationSubsidy,$nonSalaryBenefit);
        $laboureIncome = findLaboreIncome($salary,$nonSalaryIncome);
        $healthContribution = findHealthContribution($maxBase,$health,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit);
        $pensionContribution = findPensionContribution($maxBase,$pension,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit);
        $solidarity = findSolidarity($maxBase,$sld,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit,$smmlv);
        $totalNonConsecutiveIncome = findTotalNonConsecutiveIncome($healthContribution,$pensionContribution,$solidarity);
        $subTotalRevenue1 = findSubTotalRevenue1($laboureIncome,$totalNonConsecutiveIncome);
        $mpm = findPrepaidMedicine($prepaidMedicine,$dpm);
        $mhi = findPrepaidMedicine($housingInterest,$dhi);
        $totalDeductions1 = findTotalDeduction($mpm,$mhi);
        $subTotalRevenue2 = findSubTotalRevenue2($subTotalRevenue1,$totalDeductions1);
        $totalExemptIncome = findTotalExemptIncome($voluntryPension,$afcAccounts,$uvt,$laboureIncome);
        $subTotalRevenue3 = findSubTotalRevenue3($subTotalRevenue2,$totalExemptIncome);        
        $exemptWorkIncome25 = findExemptWorkIncome25($subTotalRevenue3,0.25,240*$uvt);
        $subTotalRevenue4 = findSubTotalRevenue4($subTotalRevenue3,$exemptWorkIncome25);
        $totalDeduction2 = findTotalDeduction2($totalDeductions1,$totalExemptIncome,$exemptWorkIncome25,$subTotalRevenue1);
        
        $baseIncomeReteFuente = findBaseIncomeReteFuente($subTotalRevenue1,$totalDeduction2,$subTotalRevenue4);
        $uvtValue = findUVT($baseIncomeReteFuente,$uvt);
        $rateSourse = findRateSourse($uvtValue);
        $rateSourseRound = findRateSourseRound($rateSourse);
        $enteredConsigned = findEnteredConsigned($laboureIncome,$prepaid,$totalNonConsecutiveIncome,$totalExemptIncome,$voluntryPension,$afcAccounts,$rateSourseRound);


        $payrollData = [
            'date'                      => date('m/d/Y h:i:s a', time()),
            'pid'                       => $pid,
            'title'                     => $payeeName." for ".$month,
            'payeeName'                 => $payeeName,
            'email'                     => "abdul@gmail.com",
            'month'                     => $month,
            'salaryIncome'              => $salary,
            'otherNonSalaryIncome'      => $nonSalaryIncome,
            'relocation'                => $relocation,
            'bonus'                     => $bonus,
            'transportationSubsidy'     => $transportationSubsidy,
            'nonSalaryBenefit'          => $nonSalaryBenefit,
            'laboureIncome'             => $laboureIncome,
            'prepaid'                   => $prepaid,
            'healthContribution'        => $healthContribution,
            'pensionContribution'       => $pensionContribution,
            'solidarity'                => $solidarity,
            'totalNonConsecutiveIncome' => $totalNonConsecutiveIncome,
            'subTotalRevenue1'          => $subTotalRevenue1,
            'prepaidMedicine'           => $prepaidMedicine,
            'minPrepaidMedicine'        => $mpm,
            'housingInterest'           => $housingInterest,
            'minHousingInterest'        => $mhi,
            'totalDeduction'            => $totalDeductions1,
            'subTotalRevenue2'          => $subTotalRevenue2,
            'voluntryPension'           => $voluntryPension,
            'afcAccounts'               => $afcAccounts,
            'totalExemptIncome'         => $totalExemptIncome,
            'subTotalRevenue3'          => $subTotalRevenue3,
            'exemptWorkIncome25'        => $exemptWorkIncome25,
            'subTotalRevenue4'          => $subTotalRevenue4,
            'totalDeduction2'           => $totalDeduction2,
            'baseIncomeReteFuente'      => $baseIncomeReteFuente,
            'uvtValue'                  => $uvtValue,
            'rateSourse'                => $rateSourse,
            'rateSourseRound'           => $rateSourseRound,
            'enteredConsigned'          => $enteredConsigned,
        ];


        //
        // $pdf = Pdf::loadView('payrolls.payroll', $payrollData);
        return view('payrolls.calculatedPayroll',[
            'payrollData' => $payrollData,
        ]);
        // # Option 1) Show the PDF in the browser
        // return $pdf->stream();


    }
    /**
     * Display the specified resource.
     */
    public function show(Payrolls $payrolls,$id)
    {

        $p = Payrolls::where('id',$id)->first();
        $salary                 = (double)$p->salary;
        $relocation             = (double)$p->relocation;
        $bonus                  = (double)$p->bonus;
        $transportationSubsidy  = (double)$p->transportationSubsidy;
        $nonSalaryBenefit       = (double)$p->nonSalaryBenefit;
        $prepaid                = (double)$p->prepaid;
        $prepaidMedicine        = (double)$p->prepaidMedicine;
        $housingInterest        = (double)$p->housingInterest;
        $voluntryPension        = (double)$p->voluntryPension;
        $afcAccounts            = (double)$p->afcAccounts;

        $smmlv = (double)SalaryUnits::where('unit', 'SMMLV')->first()->value;
        $uvt = (double)SalaryUnits::where('unit', 'UVT')->first()->value;
        $maxBase = (double)SocialBenefits::where('concept', 'Maximum Base')->first()->value;
        $health = (double)SocialBenefits::where('concept', 'Health')->first()->value;
        $pension = (double)SocialBenefits::where('concept', 'Pension')->first()->value;
        $sld = (double)SocialBenefits::where('concept', 'Solidarity Fund')->first()->value;
        $baseBenefit = (double)SocialBenefits::where('concept', 'Base Benifits')->first()->percentage;
        $dpm = (double)Deductions::where('concept', 'Prepaid medicine')->first()->value;
        $dhi = (double)Deductions::where('concept', 'Housing Interest')->first()->value;
        
        $nonSalaryIncome = findNonSalaryIncome($relocation,$bonus,$transportationSubsidy,$nonSalaryBenefit);
        $laboureIncome = findLaboreIncome($salary,$nonSalaryIncome);
        $healthContribution = findHealthContribution($maxBase,$health,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit);
        $pensionContribution = findPensionContribution($maxBase,$pension,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit);
        $solidarity = findSolidarity($maxBase,$sld,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit,$smmlv);
        $totalNonConsecutiveIncome = findTotalNonConsecutiveIncome($healthContribution,$pensionContribution,$solidarity);
        $subTotalRevenue1 = findSubTotalRevenue1($laboureIncome,$totalNonConsecutiveIncome);
        $mpm = findPrepaidMedicine($prepaidMedicine,$dpm);
        $mhi = findPrepaidMedicine($housingInterest,$dhi);
        $totalDeductions1 = findTotalDeduction($mpm,$mhi);
        $subTotalRevenue2 = findSubTotalRevenue2($subTotalRevenue1,$totalDeductions1);
        $totalExemptIncome = findTotalExemptIncome($voluntryPension,$afcAccounts,$uvt,$laboureIncome);
        $subTotalRevenue3 = findSubTotalRevenue3($subTotalRevenue2,$totalExemptIncome);        
        $exemptWorkIncome25 = findExemptWorkIncome25($subTotalRevenue3,0.25,240*$uvt);
        $subTotalRevenue4 = findSubTotalRevenue4($subTotalRevenue3,$exemptWorkIncome25);
        $totalDeduction2 = findTotalDeduction2($totalDeductions1,$totalExemptIncome,$exemptWorkIncome25,$subTotalRevenue1);
        
        $baseIncomeReteFuente = findBaseIncomeReteFuente($subTotalRevenue1,$totalDeduction2,$subTotalRevenue4);
        $uvtValue = findUVT($baseIncomeReteFuente,$uvt);
        $rateSourse = findRateSourse($uvtValue);
        $rateSourseRound = findRateSourseRound($rateSourse);
        $enteredConsigned = findEnteredConsigned($laboureIncome,$prepaid,$totalNonConsecutiveIncome,$totalExemptIncome,$voluntryPension,$afcAccounts,$rateSourseRound);


        $payrollData = [
            'date'                      => date('m/d/Y h:i:s a', time()),
            'pid'                       => $p->pid,
            'title'                     => explode("-",$p->pid)[1]." for ".$p->month,
            'payeeName'                      => explode("-",$p->pid)[1],
            'email'                     => "abdul@gmail.com",
            'month'                     => $p->month,
            'salaryIncome'              => $salary,
            'otherNonSalaryIncome'      => $nonSalaryIncome,
            'relocation'                => $relocation,
            'bonus'                     => $bonus,
            'transportationSubsidy'     => $transportationSubsidy,
            'nonSalaryBenefit'          => $nonSalaryBenefit,
            'laboureIncome'             => $laboureIncome,
            'prepaid'                   => $prepaid,
            'healthContribution'        => $healthContribution,
            'pensionContribution'       => $pensionContribution,
            'solidarity'                => $solidarity,
            'totalNonConsecutiveIncome' => $totalNonConsecutiveIncome,
            'subTotalRevenue1'          => $subTotalRevenue1,
            'prepaidMedicine'           => $prepaidMedicine,
            'minPrepaidMedicine'        => $mpm,
            'housingInterest'           => $housingInterest,
            'minHousingInterest'        => $mhi,
            'totalDeduction'            => $totalDeductions1,
            'subTotalRevenue2'          => $subTotalRevenue2,
            'voluntryPension'           => $voluntryPension,
            'afcAccounts'               => $afcAccounts,
            'totalExemptIncome'         => $totalExemptIncome,
            'subTotalRevenue3'          => $subTotalRevenue3,
            'exemptWorkIncome25'        => $exemptWorkIncome25,
            'subTotalRevenue4'          => $subTotalRevenue4,
            'totalDeduction2'           => $totalDeduction2,
            'baseIncomeReteFuente'      => $baseIncomeReteFuente,
            'uvtValue'                  => $uvtValue,
            'rateSourse'                => $rateSourse,
            'rateSourseRound'           => $rateSourseRound,
            'enteredConsigned'          => $enteredConsigned,
        ];


        //
        $pdf = Pdf::loadView('payrolls.payroll', $payrollData);

        # Option 1) Show the PDF in the browser
        return $pdf->stream();

        # Option 2) Download the PDF
        // return $pdf->download('invoice.pdf');
    }

    public function download(Payrolls $payrolls,$id)
    {

        $p = Payrolls::where('id',$id)->first();
        $salary                 = (double)$p->salary;
        $relocation             = (double)$p->relocation;
        $bonus                  = (double)$p->bonus;
        $transportationSubsidy  = (double)$p->transportationSubsidy;
        $nonSalaryBenefit       = (double)$p->nonSalaryBenefit;
        $prepaid                = (double)$p->prepaid;
        $prepaidMedicine        = (double)$p->prepaidMedicine;
        $housingInterest        = (double)$p->housingInterest;
        $voluntryPension        = (double)$p->voluntryPension;
        $afcAccounts            = (double)$p->afcAccounts;

        $smmlv = (double)SalaryUnits::where('unit', 'SMMLV')->first()->value;
        $uvt = (double)SalaryUnits::where('unit', 'UVT')->first()->value;
        $maxBase = (double)SocialBenefits::where('concept', 'Maximum Base')->first()->value;
        $health = (double)SocialBenefits::where('concept', 'Health')->first()->value;
        $pension = (double)SocialBenefits::where('concept', 'Pension')->first()->value;
        $sld = (double)SocialBenefits::where('concept', 'Solidarity Fund')->first()->value;
        $baseBenefit = (double)SocialBenefits::where('concept', 'Base Benifits')->first()->percentage;
        $dpm = (double)Deductions::where('concept', 'Prepaid medicine')->first()->value;
        $dhi = (double)Deductions::where('concept', 'Housing Interest')->first()->value;
        
        $nonSalaryIncome = findNonSalaryIncome($relocation,$bonus,$transportationSubsidy,$nonSalaryBenefit);
        $laboureIncome = findLaboreIncome($salary,$nonSalaryIncome);
        $healthContribution = findHealthContribution($maxBase,$health,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit);
        $pensionContribution = findPensionContribution($maxBase,$pension,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit);
        $solidarity = findSolidarity($maxBase,$sld,$salary,$bonus,$nonSalaryIncome,$laboureIncome*0.4,$baseBenefit,$smmlv);
        $totalNonConsecutiveIncome = findTotalNonConsecutiveIncome($healthContribution,$pensionContribution,$solidarity);
        $subTotalRevenue1 = findSubTotalRevenue1($laboureIncome,$totalNonConsecutiveIncome);
        $mpm = findPrepaidMedicine($prepaidMedicine,$dpm);
        $mhi = findPrepaidMedicine($housingInterest,$dhi);
        $totalDeductions1 = findTotalDeduction($mpm,$mhi);
        $subTotalRevenue2 = findSubTotalRevenue2($subTotalRevenue1,$totalDeductions1);
        $totalExemptIncome = findTotalExemptIncome($voluntryPension,$afcAccounts,$uvt,$laboureIncome);
        $subTotalRevenue3 = findSubTotalRevenue3($subTotalRevenue2,$totalExemptIncome);        
        $exemptWorkIncome25 = findExemptWorkIncome25($subTotalRevenue3,0.25,240*$uvt);
        $subTotalRevenue4 = findSubTotalRevenue4($subTotalRevenue3,$exemptWorkIncome25);
        $totalDeduction2 = findTotalDeduction2($totalDeductions1,$totalExemptIncome,$exemptWorkIncome25,$subTotalRevenue1);
        
        $baseIncomeReteFuente = findBaseIncomeReteFuente($subTotalRevenue1,$totalDeduction2,$subTotalRevenue4);
        $uvtValue = findUVT($baseIncomeReteFuente,$uvt);
        $rateSourse = findRateSourse($uvtValue);
        $rateSourseRound = findRateSourseRound($rateSourse);
        $enteredConsigned = findEnteredConsigned($laboureIncome,$prepaid,$totalNonConsecutiveIncome,$totalExemptIncome,$voluntryPension,$afcAccounts,$rateSourseRound);


        $payrollData = [
            'date'                      => date('m/d/Y h:i:s a', time()),
            'pid'                       => $p->pid,
            'title'                     => explode("-",$p->pid)[1]." for ".$p->month,
            'payeeName'                      => explode("-",$p->pid)[1],
            'email'                     => "abdul@gmail.com",
            'month'                     => $p->month,
            'salaryIncome'              => $salary,
            'otherNonSalaryIncome'      => $nonSalaryIncome,
            'relocation'                => $relocation,
            'bonus'                     => $bonus,
            'transportationSubsidy'     => $transportationSubsidy,
            'nonSalaryBenefit'          => $nonSalaryBenefit,
            'laboureIncome'             => $laboureIncome,
            'prepaid'                   => $prepaid,
            'healthContribution'        => $healthContribution,
            'pensionContribution'       => $pensionContribution,
            'solidarity'                => $solidarity,
            'totalNonConsecutiveIncome' => $totalNonConsecutiveIncome,
            'subTotalRevenue1'          => $subTotalRevenue1,
            'prepaidMedicine'           => $prepaidMedicine,
            'minPrepaidMedicine'        => $mpm,
            'housingInterest'           => $housingInterest,
            'minHousingInterest'        => $mhi,
            'totalDeduction'            => $totalDeductions1,
            'subTotalRevenue2'          => $subTotalRevenue2,
            'voluntryPension'           => $voluntryPension,
            'afcAccounts'               => $afcAccounts,
            'totalExemptIncome'         => $totalExemptIncome,
            'subTotalRevenue3'          => $subTotalRevenue3,
            'exemptWorkIncome25'        => $exemptWorkIncome25,
            'subTotalRevenue4'          => $subTotalRevenue4,
            'totalDeduction2'           => $totalDeduction2,
            'baseIncomeReteFuente'      => $baseIncomeReteFuente,
            'uvtValue'                  => $uvtValue,
            'rateSourse'                => $rateSourse,
            'rateSourseRound'           => $rateSourseRound,
            'enteredConsigned'          => $enteredConsigned,
        ];


        //
        $pdf = Pdf::loadView('payrolls.payroll', $payrollData);

        // # Option 1) Show the PDF in the browser
        // return $pdf->stream();

        # Option 2) Download the PDF
        return $pdf->download($p->pid.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payrolls $payrolls)
    {
        //
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
