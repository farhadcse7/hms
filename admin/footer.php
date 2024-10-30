</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="assets/js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.responsive.js"></script>

<!-- jquery date picker  -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- select2  -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="assets/js/sb-admin-2.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });

        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $(".our-tag").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    });
</script>

</body>

</html>