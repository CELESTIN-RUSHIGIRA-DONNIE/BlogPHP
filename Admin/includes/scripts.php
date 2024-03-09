    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- <script src="js/custom.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script> -->
    
    <script src="js/sweetalert.min.js"></script>

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
      <script>
        swal({
          title: "<?php echo $_SESSION['status']; ?>",
          //text:"You clicked the button!",
          icon: "<?php echo $_SESSION['status_code']; ?>",
          button: "ok!",
        });
      </script>

    <?php
      unset($_SESSION['status']);
    }
    ?>

    <script src="js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#myTable').DataTable();
      });
    </script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>