<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
        <div>
            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   
                    <strong class="text-success"> {{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">All Tickets</h4>
        <table class="table table-secondary">
            <thead>
                <tr>
                    <th>Ti.No.</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Issue</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <th>#{{ $ticket->ticket_number }}</th>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>
                            @if($ticket->status == 'open')
                            <span class="badge rounded-pill text-bg-success">{{ $ticket->status }}</span>
                            @else
                            <span class="badge rounded-pill text-bg-danger">{{ $ticket->status }}</span>
                            @endif
                        </td>
                       
                        <td style="width:22%">
                            @if($ticket->status == 'open')
                            <a href="{{ route('ticket.response',$ticket->id) }}" class="btn btn-info btn-sm">Resonse</a>
                            <a href="{{ route('ticket.all.response',$ticket->id) }}" class="btn btn-info btn-sm">All Resonse</a>
                            <a href="{{ route('ticket.close',$ticket->id) }}" class="btn btn-danger btn-sm" id="delete">Close</a>
                            @else
                            <a href="{{ route('ticket.all.response',$ticket->id) }}" class="btn btn-info btn-sm">All Resonse</a>
                            @endif
                        </td>	
                    </tr>
                @endforeach


            </tbody>
        </table>
        {{ $tickets->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
