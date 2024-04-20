</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
    <div class="copyright text-center my-auto">
    <span>Copyright &copy; {{ config('app.name') }} <?= date("Y"); ?></span>
    </div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Logout?</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">Pilih "Logout" di bawah jika Anda siap mengakhiri sesi Anda saat ini.</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
    <form action="{{ url('/logout') }}" method="post">
    @csrf
    <button class="btn btn-primary" type="submit">Logout</button>
</form>
</div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/sbadmin2/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/sbadmin2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/sbadmin2/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('/sbadmin2/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('/sbadmin2/vendor/datatables/1.13.6/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/sbadmin2/vendor/datatables/1.13.6/js/dataTables.bootstrap4.min.js')}}"></script>

{{-- <script src="{{ asset('/sbadmin2/vendor/datatables/1.13.6/js/jquery.dataTables.min.js')}}"></script> --}}

  {{-- //cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js --}}

<script>
    let table = new DataTable('.dataTable');
</script>

<!-- Page level custom scripts -->
<script src="{{ asset('/sbadmin2/js/demo/chart-area-demo.js')}}"></script>
<script src="{{ asset('/sbadmin2/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{ asset('/sbadmin2/js/demo/datatables-demo.js')}}"></script>
<script src="{{ asset('/js/app.js')}}"></script>


</body>

</html>