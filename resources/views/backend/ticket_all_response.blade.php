<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
        @if ($all_responses->isNotEmpty())
            <div class="row">
                <div class="col-md-2">
                    <span>Ticket Number<br>#{{ $all_responses[0]->ticket->ticket_number }} <br> Responsed to
                        {{ $all_responses[0]->ticket->user->name }}</span>
                </div>
                <div class="col-md-10">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject : {{ $all_responses[0]->ticket->subject }}
                        </label>
                    </div>
                    @foreach ($all_responses as $key => $item)
                        <div class="mb-3 p-2" style="border: 1px solid #ccc">
                            <span><b>Response #{{ $key + 1 }}.</b> {{ $item->response_msg }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">No response to this ticket yet.</h3>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
