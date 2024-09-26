<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer') }}
        </h2>
    </x-slot>

    <div class="py-6 ">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('transfer.money') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        @if(Session::has('error'))
                        <div role="alert">
                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                              Error
                            </div>
                            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                              <p>{{Session::get('error')}}</p>
                            </div>
                          </div>
                        @endif
                        
                        <div>
                            <x-input-label for="account_num" :value="__('Account Number')" />
                            <x-text-input id="account_num" name="account_num" type="text" class="mt-1 block w-full"  required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('account_num')" />
                        </div>

                        <div>
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full"  required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                            
                     
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Transfer') }}</x-primary-button>
                
                            @if (session('status') === 'transfer')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                   
                                    class="text-sm text-green-600 dark:text-green-400"
                                >{{ __('Transfered Successfully.') }}</p>
                            @endif
                        </div>
                    </form>
                  
                </div>
            </div>
        </div>
        
    </div>
    <div class="py-6">


   

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Transfer From
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Transfer To
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trans as $tran)
                        
                   
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                         
                            {{$tran->sender_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{$tran->recipient_name}}
                        </td>
                        <td class="px-6 py-4">
                    @if($tran->sender_id == Auth::user()->id)
                    <p class="text-red-600"> -${{$tran->amount}}</p>
                    @else
                    <p class="text-green-600"> +${{$tran->amount}}</p>
                    @endif
                       
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        

    </div>
  
</x-app-layout>
