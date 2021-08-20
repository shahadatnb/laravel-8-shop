
@if (session()->has('success'))
<script>
    new Noty({
    theme: 'relax',
    type: 'success',
    layout:'topRight',
    text: "{{ session('success') }}",
    timeout:2000,
    killer: true
    }).show();
</script>
@endif

@if(Session::has('warning'))
<script>
    new Noty({
    theme: 'relax',
    type: 'warning',
    layout:'topRight',
    text: "{{ session('warning') }}",
    timeout:2000,
    killer: true
    }).show();
</script>
@endif

@if(Session::has('info'))
<script>
    new Noty({
    theme: 'relax',
    type: 'info',
    layout:'topRight',
    text: "{{ session('info') }}",
    timeout:2000,
    killer: true
    }).show();
</script>
@endif