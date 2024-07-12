
<!doctype html>
<html lang='en'>

<head>
    <title>{{$payrollData["title"]}}</title>
    <meta charset='utf-8'>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    
    
</head>

<body>

    <a href="{{route('calculator.calculator')}}">
    <button type="button" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
        </svg>
        Go Back
    </button>
    </a>
    <button id="download" type="button" class="mt-4 ml-2 rtl:ml-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
        <svg class="w-4 h-4 me-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
        </svg>
        Download PDF
    </button>
    <section id="pdfArea" class="bg-white dark:bg-gray-900">        
        <div class="py-2 px-1 mx-auto max-w-screen-xl lg:py-4">
            <div class="bg-gray-400 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-2 md:p-3 mb-2">
                <div class="w-full flex justify-between">
                    <a href="#" class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-1">
                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11.613a2 2 0 0 0 1.346-.52l4.4-4a2 2 0 0 0 0-2.96l-4.4-4A2 2 0 0 0 15.613 6H4Z"/>
                        </svg>    
                        ID: {{$payrollData["pid"]}}
                    </a>

                    <a href="#" class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-1">
                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                        </svg>
                        {{$payrollData["date"]}}
                    </a>
                </div>

                <h1 class="text-center text-gray-900 dark:text-white text-xl md:text-2xl font-bold mb-2">{{$payrollData["payeeName"]}}</h1>
                
                    <div class="grid w-full gap-6 md:grid-cols-2 p-3 leading-normal">
                        
                        <p class="text-lg bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2 py-2 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
                            <svg class="w-6 h-6 me-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                            </svg>                              
                            Email: {{$payrollData["email"]}}
                        </p>
                        <p class="text-lg bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2 py-2 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
                            <svg class="w-6 h-6 me-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                            </svg>                              
                            Payrol for : {{$payrollData["month"]}}
                        </p>
                        
                    </div>
            
            </div>

            

            <div class="w-full p-2 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-2 dark:bg-gray-800 dark:border-gray-700">
                <h3 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Payment Details</h3>
                
                
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Salary Income
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["salaryIncome"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Relocation
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["relocation"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Bonus
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["bonus"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Transportation Subsidy
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["transportationSubsidy"]}}                                            
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Non-salary Benefit
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["nonSalaryBenefit"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Other non-salary income</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["otherNonSalaryIncome"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Labore Income</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["laboureIncome"]}}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Health Contribution
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["healthContribution"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Pension Contribution
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["pensionContribution"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Solidarity
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["solidarity"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Total non-constitutive income</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["totalNonConsecutiveIncome"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Subtotal Revenue</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["subTotalRevenue1"]}}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-2 font-bold">Prepaid</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["prepaid"]}}
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="relative overflow-x-auto">                        
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Prepaid medicine
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["prepaidMedicine"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Housing Interest
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["housingInterest"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Total Deductions</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["totalDeduction"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Subtotal Revenue</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["subTotalRevenue2"]}}
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Voluntary Pension
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["voluntryPension"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        AFC Accounts
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["afcAccounts"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Total Exempt Income</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["totalExemptIncome"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Subtotal Revenue</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["subTotalRevenue3"]}}
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Exempt Work Income (25%)
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["exemptWorkIncome25"]}}
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Subtotal Revenue</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["subTotalRevenue4"]}}
                                    </td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                        <br><br>
                        <br>
                        

                        <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
                            <tbody>
                                <tr class=" border border-black-400">
                                    <th scope="row" class="bg-green-500 px-3 py-2 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                        Entered / Consigned
                                    </th>
                                    <td class="px-3 py-2 bg-orange-500">
                                        {{$payrollData["enteredConsigned"]}}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">Total Deduction</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["totalDeduction2"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Base Income for ReteFuente
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["baseIncomeReteFuente"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        UVTs
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["uvtValue"]}}
                                    </td>
                                </tr>
                                <tr class="">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        ReteSource
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["rateSourse"]}}
                                    </td>
                                </tr>                        
                                <tr class="bg-white border-b border-t dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="mb-1 font-bold">ReteFuente Rounded up</p>
                                    </th>
                                    <td class="px-3 py-2">
                                        {{$payrollData["rateSourseRound"]}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js">
    </script>
    <script>
        const download_button =
            document.getElementById('download');
        const content =
            document.getElementById('pdfArea');

        download_button.addEventListener
            ('click', async function () {
                const filename = 'payroll.pdf';

                try {
                    const opt = {
                        margin: 0.2,
                        filename: filename,
                        image: { type: 'jpeg', quality: 1 },
                        html2canvas: { scale: 4 },
                        jsPDF: {
                            unit: 'in', format: 'letter',
                            orientation: 'portrait'
                        }
                    };
                    await html2pdf().set(opt).
                        from(content).save();
                } catch (error) {
                    console.error('Error:', error.message);
                }
            });
    </script>
    
</body>

</html>