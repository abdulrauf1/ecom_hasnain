<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span>     {{ session()->get('message') }}.
                </div>
                
            @endif
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                Controls
            </span>
           
           

            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Salary Units</h5>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Units
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Value
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($salaryUnits->count() > 0)
                                    @foreach ($salaryUnits as $su)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{$su->unit}}
                                            </td>
                                            <form id="change-status" action="{{ route('controls.edit',$su->id) }}" method="POST">
                                            @csrf
                                                <td class="px-6 py-6">
                                                    <input type="number" name="{{$su->unit}}" value="{{$su->value}}" id="{{$su->unit}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
                                                </td>
                                                <td class="px-6 py-6">
                                                    <button class="no-style" type="submit" data-tooltip-target="status-tooltip" data-tooltip-placement="bottom" >
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>
                                                    <div id="status-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                        Edit Value
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Social Benefits</h5>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Concept
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Percentage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Value
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($socialBenefits->count() > 0)
                                    @foreach ($socialBenefits as $sb)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{$sb->concept}}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($sb->percentage) 
                                                    {{$sb->percentage * 100}}%
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($sb->concept == 'Non-SS Base Limit' || $sb->concept == 'Value Extra')
                                                    Value Calculated on input Parameters
                                                @else
                                                    @if($sb->value) 
                                                        {{$sb->value}}
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Solidarity Fund Table</h5>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        From (SMMLV)
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Up to (SMMLV)
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Rate
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($solidarityFunds->count() > 0)
                                    @foreach ($solidarityFunds as $sf)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{$sf->from}}
                                            </td>
                                            <td class="px-6 py-6">
                                                @if($sf->to > 20)
                                                    Onwards
                                                @else
                                                    < {{$sf->to}}
                                                @endif
                                            </td>
                                            <td class="px-6 py-6">
                                                
                                                @if($sf->rate) 
                                                    {{$sf->rate * 100}}%
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Withholding table for taxed labor income</h5>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="col-span-2 px-6 py-2">
                                        UVT ranges
                                    </th>
                                    <th></th>
                                    <th scope="col" class="col-span-1 px-6 py-1">
                                        Marginal rate
                                    </th>
                                    <th scope="col" class="col-span-3 space-y-3 px-6 py-4">
                                        ValueTax or withholding tax
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="col-span-1 px-6 py-1">
                                        From
                                    </th>
                                    <th scope="col" class="col-span-1 px-6 py-1">
                                        To
                                    </th>
                                    <th scope="col" class="col-span-1 px-6 py-1">

                                    </th>
                                    <th scope="col" class="col-span-1 px-6 py-1">
                                        Any less
                                    </th>
                                    <th scope="col" class="col-span-1 px-6 py-1">
                                        By
                                    </th>
                                    <th scope="col" class="col-span-1 px-6 py-1">
                                        Further
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($withHoldingsTaxes->count() > 0)
                                    @foreach ($withHoldingsTaxes as $wt)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{$wt->UVTRangeFrom}}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($wt->UVTRangeTo >= 2300)
                                                    Onwards
                                                @else
                                                    {{$wt->UVTRangeTo}}
                                                @endif
                                            </td>
                                            
                                            <td class="px-6 py-4">
                                                @if($wt->marginalRate) 
                                                    {{$wt->marginalRate * 100}}%
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="px-6 py-4">
                                                @if($wt->anyLess) 
                                                    {{$wt->anyLess}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($wt->by) 
                                                    {{$wt->by * 100}}%
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="px-6 py-4">
                                                @if($wt->further) 
                                                    {{$wt->further}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
