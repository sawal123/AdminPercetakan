@props(['type'])
<div>
    @script
        <script>
            window.addEventListener('showToast', event => {
                toastr.success(event.detail.message, '{{$type}}', {
                    positionClass: 'toast-top-right',
                    closeButton: true,
                    progressBar: true,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                });
            });
        </script>
    @endscript
</div>