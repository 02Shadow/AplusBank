<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="grid grid-flow-row-dense grid-cols-2 grid-rows-3 ">
    <div class="py-6 ">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Balance : 
                    ${{ $acc->account->balance }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-6 ">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  @if (!$acc->account->cc)
                    <div class="flex justify-between ">
                        <form method="post" action="{{ route('apply.credit') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            Apply for credit card 
                  
                            <x-primary-button>{{ __('Apply') }}</x-primary-button>
                        </form>
                       
                    </div>
            
                        
           
                  @else
                  <div class="mx-auto rounded-lg overflow-hidden">
                    
                    <div class="px-1 py-1 sm:p-1">
                        <div class="flex flex-col items-start justify-between mb-6">
                            <span class="text-sm font-medium">Account Number</span>
                            <span class="text-lg font-medium">{{$acc->account->account_number}}</span>
                        </div>
                        <div class="flex flex-col items-start justify-between mb-6">
                            <span class="text-sm font-medium">Cardholder Name</span>
                            <span class="text-lg font-medium">{{$acc->name}}</span>
                        </div>
                        <div class="flex flex-col items-start justify-between mb-6">
                            <span class="text-sm font-medium">Card Number</span>
                            <span class="text-lg font-medium">{{$acc->account->cc_number}}</span>
                        </div>
                        <div class="flex flex-row items-center justify-between mb-6">
                            <div class="flex flex-col items-start">
                                <span class="text-sm font-medium">Expiration Date</span>
                                <span class="text-lg font-medium">{{$acc->account->cc_end}}</span>
                            </div>
                            <div class="flex flex-col items-start">
                                <span class="text-sm font-medium">CVV</span>
                                <span class="text-lg font-medium ">{{$acc->account->cc_cvv}}</span>
                            </div>
                        </div>
                       
                    </div>
                </div>
                  @endif
                  
                </div>
            </div>
        </div>
    </div>
   </div>
</x-app-layout>
