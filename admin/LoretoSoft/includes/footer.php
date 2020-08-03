
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    Desarrrollado por 
    <strong><a href="<?=$webdesarrollador?>" target="_blank"><?=$desarrollador?></a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Modals -->

<!-- Cargar modales -->
<div class="modal fade" id="ModalSystem" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                 <h4 class="modal-title"><?=$rsocial?></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="<?=$rutaadmintheme?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$rutaadmintheme?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$rutaadmintheme?>dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<!-- <script src="<?=$rutaadmintheme?>plugins/summernote/summernote.min.js"></script> -->

<!-- InputMask -->
<script src="<?=$rutaadmintheme?>plugins/moment/moment.min.js"></script>
<!-- <script src="<?=$rutaadmintheme?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script> -->

<!-- datatables -->
<script src="<?=$rutaadmintheme?>dist/js/datatables/datatables.min.js"></script>
<!-- sweetalert -->
<script src="<?=$rutaadmintheme?>dist/js/sweetalert2.all.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=$rutaadmintheme?>plugins/select2/js/select2.full.min.js"></script>
<script src="<?=$rutaadmintheme?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <script src="https://cdn.tiny.cloud/1/kbu19ruqjxwngy3jazdxxcygh3sr96pfpx9278f56swdcw3i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?=$rutaadmintheme?>plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
<script  src="<?=$rutaadmintheme?>plugins/jquery-menueditor/jquery-menu-editor.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script>


</script>
<script>
    var url_web = "<?=$rutaadmin?>"
    cargar("<?=$pagina?>");
</script>

</body>
</html>