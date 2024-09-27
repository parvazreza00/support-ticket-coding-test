<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('open.ticket') }}" class="btn btn-primary">Open Ticket</a>
            </div>
            <div class="col-md-8">
                <h5  class="text-center text-success fw-bolder">If you face any issues freely ask and get correct solution BY</h5>
                <h3 class="text-center text-success fw-bolder text-decoration-underline">Open a Ticket</h3>
                <div>
                    <img src="https://www.proprofsdesk.com/blog/wp-content/uploads/2021/01/What_is_a_Support_Ticket_and_Why_We_Dont_Use_That_Term-.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
  
</x-app-layout>





