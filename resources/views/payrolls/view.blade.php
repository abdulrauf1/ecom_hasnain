<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span>     {{ session()->get('message') }}.
                </div>
                
            @endif
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                Payrolls
            </span>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-3 md:grid-cols-4 gap-5">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div>
                        <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                           <a href="{{route('payrolls.create')}}">Add Payroll</a> 
                        </button>
                    </div>
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Payroll ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Payee Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Month
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Payee Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($payrolls->count() > 0)
                                @foreach ($payrolls as $p)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$p->pid}}
                                        </th>
                                        
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{explode("-",$p->pid)[1]}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$p->month}}
                                        </td>
                                        <td class="px-6 py-4 ">
                                            @if($p->emp_id)
                                                <div class="flex items-center">
                                                    <div class="inline-flex items-center justify-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> <span>Employee</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-center">
                                                    <div class="inline-flex items-center justify-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> <span>Non-Employee</span>
                                                    </div>
                                                </div>                                                
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 ">
                                            <div class="flex items-center">

                                                <a href="{{route('payrolls.show',$p->id)}}" target="_blank" class="inline-flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                    </svg>
                                                </a>
                                                <a href="{{route('payroll.download',$p->id)}}" class="inline-flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
                                                    </svg>

                                                </a>
                                            </div>
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
</x-app-layout>
