<?php
    require_once './suministro.php'; 
    
    $folio = $_POST['folio'];
    $suministro = new suministro();
    $pedidos = $suministro->get_pedidos($folio);
    $p = "";
    foreach ($pedidos as $valor) {
            $cantidad = $valor['cantidad'];
            $unidad = $valor['unidad'];
            $id_pedido = $valor['id_pedido'];
            $articulo = $valor['articulo'];
            $autorizado = t_icon_x($valor['autorizado']);
            $status = t_icon_x($valor['status_pedido']);
            
            if($valor['status_pedido'] == 1){
                $p = "<a href='#' onclick='abrirPedido($id_pedido)'>
                            <div class='mail_list'>
                                  <div class='left'>
                                    <p></p>
                                  </div>
                                    <div class='right' style='margin: 2px'>
                                    $status
                                    <h3> $articulo <small>$cantidad $unidad</small></h3>
                                  </div>
                            </div>
                          </a>".$p;
            }elseif($valor['status_pedido'] == 0){
                $p = "<a href='#' onclick='abrirPedido($id_pedido)'>
                            <div class='mail_list'>
                                  <div class='left'>
                                    <p style='text-align: right'><span class='required' style='font-size: 7px;color: #1AB6F0'><i class='fa fa-circle'></i></span></p>
                                  </div>
                                    <div class='right' style='margin: 2px'>
                                    $status
                                    <h3> $articulo <small>$cantidad $unidad</small></h3>
                                  </div>
                            </div>
                          </a>".$p;
            }elseif ($valor['status_pedido'] == 2) {
                $p = "<a href='#' onclick='abrirPedido($id_pedido)'>
                            <div class='mail_list'>
                                  <div class='left'>
                                    $status
                                  </div>
                                    <div class='right' style='margin: 2px'>
                                      <h3 style='color: lightgrey'><del> $articulo <small>$cantidad $unidad</small></del></h3>
                                  </div>
                            </div>
                         </a>".$p;
            }elseif ($valor['status_pedido'] == 3){
                $p = "<a href='#' onclick='abrirPedido($id_pedido)'>
                            <div class='mail_list'>
                                <div class='left'>
                                  $status
                                </div>
                                  <div class='right' style='margin: 2px'>
                                  <h3>  $articulo <small>$cantidad $unidad</small></h3>
                                </div>
                            </div>
                         </a>".$p;
            }elseif ($valor['status_pedido'] == 6) {
                $p = "<a href='#' onclick='abrirPedido($id_pedido)'>
                            <div class='mail_list'>
                                  <div class='left'>
                                    $status
                                  </div>
                                    <div class='right' style='margin: 2px'>
                                    <h3 style='color: lightsteelblue'> $articulo <small>$cantidad $unidad</small></h3>
                                  </div>
                            </div>
                         </a>".$p;
            }else {
                $p = "<a href='#' onclick='abrirPedido($id_pedido)'>
                        <div class='mail_list'>
                            <div class='left'>
                              $status
                            </div>
                            <div class='right' style='margin: 2px'>
                              <h3> $articulo </span> <small>$cantidad $unidad</small></h3>
                            </div>
                        </div>
                     </a>".$p;
            }
            
        }
    
    function t_icon_x($st){
       $status = array(
            "<p></p>",//NO revisado
            "<span class='badge d-block badge-success>Aprobado</span>",
            "<span class='badge d-block badge-danger>Cancelado</span>",
            "<span class='badge d-block badge-warning>Revisión</span>",
            "<span class='badge d-block bg-purple>Enviado a compra</span>",
            "<span class='badge d-block badge-info>Listo para entrega</span>",
            "<span class='badge d-block badge-warning>Entregado</span>",
            "<p></p>",//Comentario
            "<p></p>"
        );
        return $status[$st];
    }

    echo $p;
    
    