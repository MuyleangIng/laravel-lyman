<script src="{{ asset('dist-front/js/custom.js') }}"></script>

@if($errors->any())
    @foreach($errors->all() as $error)
    <script>
        iziToast.error({
            message: '{{ $error }}',
            position: 'topRight'
        });
    </script>
    @endforeach
@endif
@if(Session::has('error'))
    <script>
        iziToast.error({
            message: '{{ Session::get("error") }}',
            position: 'topRight'
        });
    </script>
@endif
@if(Session::has('success'))
    <script>
        iziToast.success({
            message: '{{ Session::get("success") }}',
            position: 'topRight'
        });
    </script>
@endif