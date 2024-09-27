<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2">
                <span>Ticket Number</br>#{{ $response->ticket_number }}</span>
            </div>
            <div class="col-md-10">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <p class="p-2" style="border: 1px solid #ccc">{{ $response->subject }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Issue Description</label>
                        <p class="p-2" style="border: 1px solid #ccc">{{ $response->message }}</p>
                    </div>
                   
               
                    <div>
                        @if (session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                               
                                <strong class="text-success"> {{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
        
                    </div>

                <form action="{{ route('ticket.response.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $response->id }}">
                    <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="ticket_number" value="{{ $response->ticket_number }}">
                   

                    <div class="mb-3">
                        <label for="response_msg" class="form-label">Ticket Issue Response</label>
                        <textarea name="response_msg" class="form-control" cols="30" rows="5" placeholder="Write Your Response"></textarea>
                        @error('response_msg')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-right">
                        <button type="submit" class="btn btn-primary">Submit Ticket Response</button>
                    </div>
                </form>
               
               
            </div>
            
        </div>
    </div>

</x-app-layout>
