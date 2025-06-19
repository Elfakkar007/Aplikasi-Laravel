<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    @if (Session::has('success'))
        toastr.options = {
            "positionClass": "toast-top-right"
        };
        toastr.success("{{ Session::get('success') }}");
    @endif
</script>
