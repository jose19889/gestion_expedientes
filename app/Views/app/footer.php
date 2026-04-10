  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Addemy groups</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="margin:0px auto;">
      <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
<br>
    
  <div class="info" style="margin:0px auto;">
    <?php
    // Access session data
    $session = session();
    $username = $session->get('username');
    $roleId = $session->get('role_id');
    $roleName = $session->get('role_name'); // Get the role name
    $userId = $session->get('id'); // Assuming the user ID is stored in session

    // Load the UserModel to fetch the user's profile image
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($userId); // Retrieve user by ID

    // If user is found and has a profile image
    if ($user && isset($user['profile_image']) && !empty($user['profile_image'])) {
        $imageUrl = base_url('uploads/profiles/' . $user['profile_image']);
    } else {
        // Default image if no profile image is set
        $imageUrl = base_url('uploads/img/avatar5.png');
    }
    ?>

      <div class="image">
     
    <!-- Display profile image -->
    <img style="height: auto;width: 3.1rem;" src="<?= esc($imageUrl); ?>" class="img-circle elevation-2" alt="avatar" width="150">

        <br>
        <a class="text-danger" style="margin:17px 17px;" href="<?= site_url('users-uploadphoto') ?>"><i class="fa fa-edit"></i></a>

        </div>

    <!-- Display the username and role -->
    <p><?= esc($username); ?>!</p>
    <span><?= esc($roleName); ?></span>

    <!-- Change Password and Logout Links -->
    <a href="users-changePass" class="text-muted d-block">Cambiar Contraseña</a>
    <a  class="btn btn-primary" href="login" class="text-danger d-block">Salir</a>
</div>

<
<!-- ./wrapper -->

<!-- jQuery -->

<script src="<?php echo base_url();?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url();?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url();?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url();?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url();?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/adminlte.js"></script>
<!-- DATATABLES JQUEIRS -->

<script src="<?php echo base_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>Plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
 /* $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });*/
     $(function () {
        // Initialize the DataTable
        var table = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                "copy", "csv", "excel", 
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    exportOptions: {
                        // Only export visible columns
                        columns: ':visible'
                    }
                },
                "print", "colvis"  // Column visibility button
            ]
        });

        // Add the DataTable buttons to the container
        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

 // ADD RESET PASSWORD LOGIC ON CLICK
   function resetPassword(userId) {
        // Display a confirmation prompt before proceeding
        if (confirm('¿Está seguro que desea restablecer la contraseña para este usuario?')) {
            // Show loading indicator or button disable state
            const button = document.querySelector(`button[onclick="resetPassword(${userId})"]`);
            button.innerHTML = 'Cargando...';
            button.disabled = true;

            // Call the backend API to reset the password
            fetch('<?= base_url("user-reset-password") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId }) // Send the user ID to reset the password
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Contraseña restablecida exitosamente!');
                    // Optionally, display the new password if returned (useful for debugging)
                    console.log('New Password:', data.new_password);
                } else {
                    alert('No se pudo restablecer la contraseña: ' + data.message);
                }
            })
            .catch(error => {
                alert('Ocurrió un error al intentar restablecer la contraseña.');
                console.error(error);
            })
            .finally(() => {
                // Restore button state after operation
                button.innerHTML = 'Restablecer Contraseña';
                button.disabled = false;
            });
        }
    }
</script>



</body>
</html>
