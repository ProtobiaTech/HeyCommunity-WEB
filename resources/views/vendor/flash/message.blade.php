<div id="section-flash">
    @foreach (session('flash_notification', collect())->toArray() as $message)
        @if ($message['overlay'])
            @include('flash::modal', [
                'modalClass' => 'flash-modal',
                'title'      => $message['title'],
                'body'       => $message['message']
            ])
        @else
            <div class="alert
                        alert-{{ $message['level'] }}
                        {{ $message['important'] ? 'alert-important' : '' }}"
                        role="alert"
            >
                @if ($message['important'])
                    <button type="button"
                            class="close text-muted"
                            data-dismiss="alert"
                            aria-hidden="true"
                    >&times;</button>
                @endif

                {!! $message['message'] !!}
            </div>
        @endif
    @endforeach

    {{ session()->forget('flash_notification') }}
</div>


<style rel="stylesheet" type="text/css">
    #section-flash {
        z-index: 100;
        position: absolute;
        top: 80px;
        right: 20px;
        min-width: 120px;
    }

    #flash-overlay-modal {
        top: 100px;
    }

    .modal-backdrop {
        z-index: 99;
    }
</style>

<script>
    $(function() {
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $('#flash-overlay-modal').modal('show');
    });
</script>