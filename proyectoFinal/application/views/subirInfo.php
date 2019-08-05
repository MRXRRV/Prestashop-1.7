<!DOCTYPE html>
<html lang="es">
<head>
  <title>Importar Usuarios desde un archivo CSV a una base de datos con php</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline; color: blue;}
    .col-centrada{float: none; margin: 0 auto;}
  </style>
</head>
<body>
<br>
<div class="row">
    <div class="col-lg-6 col-centrada">
      <h2>Importar Usuarios desde un archivo CSV a una base de datos con php</h2>
      <?php if(!empty($status)){
        echo '<div class="alert alert-danger">'.$status.'</div>';
      } ?>
    	<div class="panel-heading">
            Usuarios en la lista
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Importar Usuarios</a>
      </div>
      <div class="panel panel-body">
        <ul>
            <li>
            Instrucciones: Subir el archivo adjunto con extención CSV el programa inserta y actualiza si existe un registro igual. 
            </li>
            <li>
              Se utilizo el framework Codeigniter y estilos de bootstrap.
            </li>
        </ul>
      </div>
        <div class="panel-body">
            <form action="<?php echo site_url("welcome/subirArchivo");?>" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file"/>
                <input type="submit" class="btn btn-success" name="importSubmit" value="Importar">
            </form>
            <table class="table table-sm table-hover">
                <thead>
                    <tr class="table-active">
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Contraseña</th>
                      <th>Status</th>
                      <th>fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $this->db->query("SELECT * FROM tbl_promotor ORDER BY fecha DESC")->result();
                    if(count($query)>0){
                    foreach($query as $row){ ?>
                    <tr>
                      <td><?php echo $row->nombre_promotor; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->password; ?></td>
                      <td><?php echo $row->status; ?></td>
                      <td><?php echo $row->fecha; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No Existen Registros</td></tr>
                    <?php } ?>
                </tbody>
            </table>            
        </div>
    </div>
</div>

</body>
</html>