@extends('master')

@section('title')
   Ticket Details
@endsection

@section('content')
    <!-- Page content area start -->
    <div class="page-body" style="background: #000;padding:50px">
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 border-light shadow-sm bg-light">

                        <div class="card-body">

                            <!-- Ticket Details Start -->
                            <section class="ticket-details-page section-t-space">
                                <div class="bg-white rounded p-4 shadow-sm">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="ticket-replies mb-4">
                                                <h5 class="mb-3 text-dark">{{ __('Ticket Replies') }}</h5>

                                                @forelse($ticketMessages as $ticketMessage)
                                                <div class="mb-3 p-3 {{ $ticketMessage->reply_admin_user_id ? 'bg-light border-left border-primary' : 'bg-white' }} rounded">
                                                    <h6 class="font-weight-bold mb-2 text-dark">
                                                        @if ($ticketMessage->sender_user_id && $ticketMessage->sendUser)
                                                            {{ $ticketMessage->sendUser->name }}
                                                        @elseif ($ticketMessage->reply_admin_user_id && $ticketMessage->replyUser)
                                                            {{ $ticketMessage->replyUser->name  }}
                                                        @else
                                                            {{ __('Unknown User') }}
                                                        @endif
                                                    </h6>
                                                    <p class="text-dark">{{ $ticketMessage->message }}</p>
                                                    @if ($ticketMessage->file)
                                                        <a href="{{ getImageFile($ticketMessage->file) }}" target="_blank">
                                                            <img src="{{ getImageFile($ticketMessage->file) }}" class="img-thumbnail" alt="attachment">
                                                        </a>
                                                    @endif
                                                </div>
                                            @empty
                                                <p class="text-dark">{{ __('No Reply Found') }}</p>
                                            @endforelse

                                            </div>

                                            <!-- Reply Form -->
                                            <div class="reply-form bg-light p-4 rounded shadow-sm">
                                                <h5 class="mb-3 text-dark">{{ __('Write a reply') }}</h5>
                                                <form action="{{ route('support-ticket.messageStore') }}" method="post"
                                                    enctype="multipart/form-data" id="ticketReplyForm">
                                                    @csrf
                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                                    <div class="form-group mb-3">
                                                        <textarea class="form-control text-dark" name="message" rows="5" placeholder="{{ __('Write your message') }}"
                                                            required></textarea>
                                                        @error('message')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label
                                                            class="font-weight-bold text-dark">{{ __('Upload Your File') }}</label>
                                                        <input type="file" name="file" class="form-control-file">
                                                        <small class="form-text text-muted">
                                                            {{ __('Valid File Type') }}: jpg, jpeg, gif, png |
                                                            {{ __('Max size') }}: 10 MB
                                                        </small>
                                                        @error('file')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('Submit') }}</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Ticket Info Sidebar -->
                                        <div class="col-lg-4">
                                            <div class="ticket-info bg-light p-4 rounded shadow-sm">
                                                <h5 class="mb-3 text-dark">{{ __('Ticket Info') }}</h5>
                                                <p class="text-dark"><strong >{{ __('Status') }}:</strong>
                                                    <span class="badge badge-pill {{ $ticket->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $ticket->status == 1 ? __('Open') : __('Closed') }}
                                                    </span>

                                                </p>
                                                <p class="text-dark"><strong >{{ __('Subject') }}:</strong>
                                                    #{{ $ticket->ticket_number }} - {{ $ticket->subject }}</p>
                                                @if ($ticket->department)
                                                    <p class="text-dark"><strong >{{ __('Department') }}:</strong>
                                                        {{ $ticket->department->name }}</p>
                                                @endif
                                                @if ($ticket->priority)
                                                    <p class="text-dark"><strong >{{ __('Priority') }}:</strong>
                                                        {{ $ticket->priority->name }}</p>
                                                @endif
                                                @if ($ticket->service)
                                                    <p class="text-dark"><strong >{{ __('Related Service') }}:</strong>
                                                        {{ $ticket->service->name }}</p>
                                                @endif
                                                <p class="text-dark"><strong >{{ __('Opened') }}:</strong>
                                                    {{ $ticket->created_at->format('d M, Y h:i A') }}</p>
                                                <p class="text-dark"><strong >{{ __('Last Response') }}:</strong>
                                                    {{ $last_message ? $last_message->created_at->format('d M, Y h:i A') : 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Ticket Details End -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert on form submit
        document.getElementById('ticketReplyForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: "{{ __('Are you sure you want to submit your reply?') }}",
                text: "{{ __('You won\'t be able to revert this!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes, submit!') }}",
                cancelButtonText: "{{ __('No, cancel!') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                    Swal.fire({
                        title: "{{ __('Reply Submitted Successfully!') }}",
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
    </script>
@endsection
