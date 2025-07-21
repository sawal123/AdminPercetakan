<div>
    @script
        <script>
            $wire.on('showToast', () => {
                toastr.success('{{ session('message') }}', 'Success', {
                    positionClass: 'toast-top-right',
                    closeButton: true,
                    progressBar: true,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    positionClass: "toast-top-right",
                })
            })
        </script>
    @endscript
</div>
