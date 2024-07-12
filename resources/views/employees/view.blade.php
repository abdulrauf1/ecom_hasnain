<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span>     {{ session()->get('message') }}.
                </div>
                
            @endif
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                Employees
            </span>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-3 md:grid-cols-4 gap-5">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div>
                        <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                           <a href="{{route('employees.create')}}">Add Employee</a> 
                        </button>
                    </div>
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Employee name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date of Joining
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Salary
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    In-service
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        @if ($employees->count() > 0)
                            @foreach ($employees as $emp)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$emp->name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$emp->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$emp->dateOfJoining}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$emp->salary}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($emp->inService)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Yes</span>
                                        @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">No</span>
                                        @endif
                                        
                                    </td>
                                    <td class="px-6 py-4 flex flex-wrap">
                                        <form id="change-status" action="{{ route('employees.edit',$emp->id) }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="status" value="{{$emp->inService}}">
                                            <button class="no-style" type="submit" data-tooltip-target="status-tooltip" data-tooltip-placement="bottom" >
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                            <div id="status-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                Change Status
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>

                                        </form>
                                        <form id="delete" action="{{ route('employee.destroy',$emp->id) }}" method="POST" >
                                            @csrf
                                            <button class="no-style" type="submit" data-tooltip-target="delete-tooltip" data-tooltip-placement="bottom" >
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                </svg>
                                            </button>
                                            <div id="delete-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                Delete Employee
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>

                                        </form>
                                    </td>
                                </tr>
                            
                            @endforeach
                        
                        @endif

                            
                        </tbody>
                    </table>
                </div>

                


                <nav aria-label="Page navigation example" class="mt-5 ms-auto">
                    <ul class="inline-flex -space-x-px text-sm ms-auto">
                        <p class="text-right">{{ $employees->links() }} </p>
                    </ul>
                </nav>
            </div>


        </div>
    </div>
</x-app-layout>
