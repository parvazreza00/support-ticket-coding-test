<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                       
                        <strong class="text-success"> {{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            </div>

        </div>
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('open.ticket') }}" class="btn btn-primary">Open Ticket</a>
            </div>
            <div class="col-md-10">
                <form action="{{ route('create.ticket') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter Ticke Subject">
                        @error('subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Ticket Issue</label>
                        <textarea name="message" class="form-control" cols="30" rows="5" placeholder="Write Your Issues"></textarea>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-right">
                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                    </div>
                </form>
                <h4 class="text-center">All Tickets</h4>
                <table class="table table-secondary">
                    <thead>
                      <tr>
                        <th>Ti.No.</th>
                        <th>Subject</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th class="text-center">Admin Response</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <th >#{{ $ticket->ticket_number }}</th>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->message }}</td>
                            <td>
                                @if($ticket->status == 'open')
                                <span class="badge rounded-pill text-bg-success">{{ $ticket->status }}</span>
                                @else
                                <span class="badge rounded-pill text-bg-danger">{{ $ticket->status }}</span>
                                @endif
                            </td>
                            <td style="width: 12%">
                                <a href="{{ route('ticket.admin.response',$ticket->id) }}" class="btn btn-info btn-sm">Resonse</a>
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
