<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deposit') }}
        </h2>
    </x-slot>

    <div class="py-6 ">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('deposit.add') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                
                        <div>
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full"  required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                            
                     
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Depsoit ') }}</x-primary-button>
                
                            @if (session('status') === 'deposit')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                   
                                    class="text-sm text-green-600 dark:text-green-400"
                                >{{ __('Depsoit Successfully.') }}</p>
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
                            Balance
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Total
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $w)
                        
                   
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                         {{$w->balance}}
                        </th>
                        <td class="px-6 py-4">
                            <p class="text-green-600"> +${{$w->amount}}</p>
                        </td>
                        <td class="px-6 py-4">
                            
                            <p class="text-green-600"> ${{$w->balance + $w->amount}}</p>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
  
</x-app-layout>
