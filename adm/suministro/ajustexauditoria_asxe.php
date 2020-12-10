<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ajuste por Auditoría</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <script src="../../global_assets/js/main/jquery.min.js"></script>
    <script src="../../global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="../../global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="../../global_assets/js/plugins/ui/ripple.min.js"></script>
    <script src="js/engineAjuste.js"></script>
    <!-- /theme JS files -->
</head>
    <body>
        <table cellspacing="15" border="0">
            <tr>
                <td colspan="3" style="text-align: center"><h3>Ajuste por Auditoría</h3></td>
            </tr>
            <tr>
                <td style="text-align: right">Codigo:</td>
                <td><input type="text" id="cod_articulo" name="cod_articulo" required minlength="7" maxlength="8" style="width:100%;"></td>
                <td><button type="button" id="buscar" onclick="buscar_empleado()">Buscar</button></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><b id="descripcion">-</b></td>
            </tr>
            <tr>
              <td style="text-align: right">Cantidad:</td>
              <td><input type="number" id="cantidad" name="cantidad" required  style="width:100%;"></td>
              <td></td>
            </tr>
            <tr>
              <td style="text-align: right">Comentario / Justificación</td>
              <td colspan="2"><textarea name="comentario" id="comentario" rows="10" cols="50"></textarea></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td style="text-align: right"><button type="button" id="limpiar" onclick="limpia()">Limpiar</button> &nbsp; &nbsp;<button type="button" id="aceptar" onclick="ajustaAlmacen()">Aceptar</button></td>
            </tr>
        </table>
    </body>
</html>