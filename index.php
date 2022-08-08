<?php
require_once('entidades/operacion.php');
require_once('entidades/smovimientos.php');
require_once('entidades/conexiones.php');

if (isset($_POST['ingreso'])) {
    
        $servicioMovimeinto = new ServicioMovimiento();
        $listaSaldo = $servicioMovimeinto->saldo();
        if (empty($listaSaldo)) {$listaSaldo = 0;}
        $saldo = ($listaSaldo) + ($_POST['cantidad']);
        
        //$saldo = $_POST['saldo'];
        
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
         
        $concepto = $_POST['concepto'];
        $movimientos = new Operacion($id,$tipo,$fecha,$cantidad,$saldo,$concepto);
        $servicioBanco = new ServicioMovimiento();
        $servicioBanco->ingresar($movimientos);
        
        }
 if (isset($_POST['retirar'])) {
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $servicioMovimeinto = new ServicioMovimiento();
        $listaSaldo = $servicioMovimeinto->saldo();
        if (empty($listaSaldo)) {$listaSaldo = 0;}
        $saldo = ($listaSaldo) + (-$_POST['cantidad']);
        $concepto = $_POST['concepto'];
        $movimientos = new Operacion($id,$tipo,$fecha,-$cantidad,$saldo,$concepto);
        $servicioBanco = new ServicioMovimiento();
        $servicioBanco->retirar($movimientos);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prueba Optiva</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <h1><strong></strong></h1>
          </div>
        <div class="col-sm-12">
			
          <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <h1><span class="info-box-text">Saldo</span></h1>
                 <h2><span class="info-box-number"><?php 
                  $servicioMovimeinto = new ServicioMovimiento();
                  echo "Saldo: ";
                  $listaSaldo = $servicioMovimeinto->saldo();
                  if (empty($listaSaldo)) {$listaSaldo = 0;}
                  echo $listaSaldo;
                  ?>
                  €</span></h2>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <!-- /.col -->
          <!-- /.col -->
        </div>  
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ingresar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="optiva.php" method="post" enctype="multipart/form-data">   
                <div class="card-body">
                  <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <p><input type="text" class="form-control" name= "cantidad" id="cantidad" placeholder="Cantidad a Ingresar" required></p>
                    <input type="text" class="form-control" name= "concepto" id="concepto" placeholder="Concepto" required>
                    <input  type="hidden" value="Ingreso" class="form-control" name= "tipo" id="tipo" placeholder="Tipo">
                    <input type="hidden" value="<?php  $servicioMovimeinto = new ServicioMovimiento();
                                                  $listaSaldo = $servicioMovimeinto->saldo();
                                                  echo $listaSaldo;?>" class="form-control" name= "saldo" id="saldo" placeholder="Saldo">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="ingreso" value="ingreso" class="btn btn-primary">Ingresar</button>
                  
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- general form elements --><!-- /.card -->

            <!-- Input addon --><!-- /.card -->
            <!-- Horizontal Form --><!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                Retirar
              </div>
              <form action="optiva.php" method="post" enctype="multipart/form-data">   
                <div class="card-body">
                  <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <p><input type="text" class="form-control" name= "cantidad" id="cantidad" placeholder="Cantidad a Retirar" required></p>
                    <input type="text" class="form-control" name= "concepto" id="concepto" placeholder="Concepto" required>
                    <input  type="hidden" value="Retirada" class="form-control" name= "tipo" id="tipo" placeholder="Tipo">
                    <input type="hidden" value="<?php  $servicioMovimeinto = new ServicioMovimiento();
                                                  $listaSaldo = $servicioMovimeinto->saldo();
                                                  echo $listaSaldo;?>" class="form-control" name= "saldo" id="saldo" placeholder="Saldo">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                  <button type="submit" name="retirar" value="retirar" class="btn btn-success">Retirar</button>
                </div>
               
              </form> 
              <!-- /.card-body -->
            </div>
            <!-- /.card --><!-- /.card -->

            <!-- general form elements disabled --><!-- /.card -->
            <!-- general form elements disabled --><!-- /.card -->
          </div>
		<div class="col-12"><!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Movimientos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Tipo de movimiento</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Saldo en cuenta</th>
                    <th>Concepto</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $servicioMovimeinto = new ServicioMovimiento();
                  $listaMovimiento = $servicioMovimeinto->listarmovimientos(); 
                  echo $servicioMovimeinto->imprimirmovimmientos($listaMovimiento);
                  
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>Tipo de movimiento</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Saldo en cuenta</th>
                    <th>Concepto</th>
                   
                  </tr>
                  </tfoot>
                </table>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <footer class="main-footer">
  
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      order: [[1, 'desc']],
      "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print", "colvis"],
		"language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }
	
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
  });
</script>



</body>
</html>