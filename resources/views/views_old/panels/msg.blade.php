@if (Session::has('success'))
@php
  $configData = \App\Helpers\CustomerHelper::configData('admin_config');
  $toastrMsgPosition = \App\Helpers\CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
@endphp
<script type="text/javascript">
    $(document).ready(function() {
        toastr.success("{{ Session::get('success') }}", 'Congrats!', { positionClass: '{{ $toastrMsgPosition }}', "closeButton": true});
    });
</script>
@endif

@if (Session::has('error'))
<script type="text/javascript">
    $(document).ready(function() {
        toastr.success("{{ Session::get('error') }}", 'Error!', { positionClass: 'toast-top-full-width', "closeButton": true});
    });
</script>
@endif

@if (Session::has('warning'))
<script type="text/javascript">
    $(document).ready(function() {
        toastr.warning("{{ Session::get('warning') }}", 'Warning!', { positionClass: 'toast-top-full-width', "closeButton": true});
    });
</script>
@endif