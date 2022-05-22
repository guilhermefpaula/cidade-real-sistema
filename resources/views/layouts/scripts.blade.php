<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/js/core/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script>

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.2')}}"></script>