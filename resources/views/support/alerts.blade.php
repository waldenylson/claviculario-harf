@if(session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                Swal.fire({
                title: 'Success!',
                text: "{{ Session::get('message') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            }, 1000);
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                Swal.fire({
                title: 'Error!',
                text: "{{ Session::get('error') }}",
                icon: 'error',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            }, 1000);

        });
    </script>
@endif
