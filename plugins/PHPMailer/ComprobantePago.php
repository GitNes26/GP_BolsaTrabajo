<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Compra</title>

    <style>
        body {
            width: 800px;
            border: 1px solid lightgrey;
            padding: 5px;
        }

        .encabezado {
            display: block;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        table.tablaArticulos {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid gray;
            padding: 10px;
        }

        th {
            background-color: lightgrey;
        }

        .tPrecios td {
            border: 0px;
            padding: 3px 10px;
        }

        .container {
        }

        .tablaDatos {
            width: 100%;
            border-collapse: collapse;
        }
        .tablaDatos td{
            border:0px;
            padding:3px;
        }

    </style>

</head>

<body>
    <?php 
    $numpedido = "sulkmmuidk";
    require_once("./backend/Pedido.php");
    $Pedido = new Pedido();
    $pedido = $Pedido->GetPedido($numpedido);
    $cliente = $Pedido->GetClientePedido($numpedido);
    ?>
    <div class="container">
        <table class="tablaDatos">
            <tbody>
                <tr><img src="http://pinkfashionstore.com/Imagenes/logo.png" height="80px" /></tr>
                <tr><td><span style="font-size: 22px; font-weight: bold;">Pink Fashion Store</span></td></tr>
                <tr>
                    <td><span style="font-size: 18px; font-weight: bold;">Sucursal Hidalgo</span></td>
                    <td><span style="font-size: 18px; font-weight: bold;">Sucursal México</span></td>
                </tr>
                <tr>
                    <td>Calle 74 San Francisco, Panama City</td>
                    <td>Santa Cruz Cacalco 25 Int 301, Pensil Norte, México, DF. 11470 </td>
                </tr>
                <tr>
                    <td>+ 507 6204-3932 </td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>panama@acanthanails.com</td>
                    <td>sales@acanthanails.com </td>
                </tr>
            </tbody>
        </table>
        <hr />
        <br>
        <table class="tablaDatos">
            <tbody>
                <tr>
                    <td><span style="font-size: 18px; font-weight: bold;">Nombre del cliente: <?php echo $cliente[0]["nombre"]." ".$cliente[0]["apellidos"]; ?></span></td>
                </tr>
                <tr>
                    <td>Correo electrónico: <?php echo $cliente[0]["email"]; ?></td>
                </tr>
                <tr>
                    <td>Teléfono: <?php echo $cliente[0]["telefono"]; ?></td>
                </tr>
                <tr>
                    <td>Direccion de envío: <?php echo $cliente[0]["calle"].", ".$cliente[0]["colonia"].", ".$cliente[0]["cp"].", ".$cliente[0]["no_ext"].", ".$cliente[0]["no_int"].", ".$cliente[0]["ciudad"].", ".$cliente[0]["estado"].", ".$cliente[0]["pais"]; ?></td>
                </tr>
            </tbody>
        </table>

        <br>
        <span style="font-size: 18px; font-weight:bold;">#Pedido: <?php echo $numpedido; ?></span>
        <br>
        <br>
        <span style="font-size: 18px;">Compraste los Articulos:</span>
        <br>
        <br>
        <table class="tablaArticulos" id="grd">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subtotal = 0;
                $total = 0;
                $descuentoTotal = 0;

                for($i = 0; $i < sizeof($pedido); $i++)
                {
                    $producto = $pedido[$i]["producto"];
                    $cantidad = $pedido[$i]["cantidad"];
                    $descuento = $pedido[$i]["descuento"];
                    $importe = $pedido[$i]["importe"];

                    $subtotal += number_format((float)$importe - $descuento, 2, '.', '');
                    $total += number_format((float)$importe, 2, '.', '');
                    $descuentoTotal += number_format((float)$descuento, 2, '.', '');

                    echo
                    "
                    <tr>
                        <td style='text-align:center;'>$producto</td>
                        <td style='text-align:center;'>$cantidad</td>
                        <td style='text-align:center;'>$ $descuento MXN</td>
                        <td style='text-align:center;'>$ $importe MXN</td>
                    </tr>
                    ";
                }
                ?>
                <tr class="tPrecios">
                    <td></td>
                    <td style="text-align:right; font-weight: bold;"><br>Subtotal:</td>
                    <td style="text-align:right;"><br><?php echo "$".$subtotal." MXN"; ?></td>
                </tr>
                <tr class="tPrecios">
                    <td></td>
                    <td style="text-align:right; font-weight: bold;">Descuento:</td>
                    <td style="text-align:right;"><?php echo "$".$descuentoTotal." MXN"; ?></td>
                </tr>
                <tr class="tPrecios">
                    <td></td>
                    <td style="text-align:right; font-weight: bold;">Total:</td>
                    <td style="text-align:right;"><?php echo "$".$total." MXN"; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <div style="text-align:center;">
            <span style="font-size:20px;">Muchas gracias por tu compra</span>
            <br/><br />
        </div>
    </div>
</body>

</html> 