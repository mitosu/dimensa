<?php
/* 
    Created on : 24-mar-2014, 20:59:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */
echo '<div class="row">
                    <div class="col-md-1"></div>
                    <div id="menu_bottom" class="col-md-10">
                        <ul class="nav nav-tabs">
                            <li><a href="info.php">Contactenos</a></li>
                            <li><a href="legal.php" data-toggle="modal" data-target="#aviso_legal">Aviso Legal</a></li>
                            <li><a href="condiciones.php" data-toggle="modal" data-target="#condiciones">Condiciones</a></li>
                            <li><a href="lortad.php" data-toggle="modal" data-target="#proteccion_datos">Protección de Datos</a></li>
                            <li><a href="info.php">Más información</a></li>
                            <li><a href="#">Mapa del Sitio</a></li>
                        </ul>
                    </div>
                    <div class="col-md-1"></div>
                </div>';

/*Condiciones de Servicio*/
echo'<div class="modal fade" id="condiciones" tabindex="-1" role="dialog" aria-labelledby="condicionesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="condicionesLabel">Condiciones de Servicio</h4>
      </div>
      <div class="modal-body">
        '._EMP_EMPRESA.' , podrá modificar o suprimir cualquier servicio si entendiera su justificación. Esta se hará por escrito.<br/>
        En los precios ofertados no está incluido el IVA, ni cualquier otro impuesto que pudiera recaer al destinatario o remitente.<br/>
        El sistema de cubicaje será el siguiente: Nacional/ Internacional Terrestre: Largo x alto x Ancho; dividido entre 3.000 Nacional / Internacional Aéreo: el establecido por las líneas aéreas.<br/>
        SEGUROS: DemoTrans, S.L. ignora el contenido y valor de la mercancía. Nuestra responsabilidad por los daños, pérdidas o averías que sufran las mercancías está limitada a lo establecido en la L.O.T.T. (Ley de Ordenación de los Transportes Terrestres). Seguro sin coste adicional para documentos. Para Paquetería, se aplicará un 10 % sobre portes en concepto de incremento de la cobertura legal de responsabilidad, que quedará limitada a 24,04 € / Kg. con un máximo de 1.803 € Seguro a todo riesgo: la prima del seguro es un 1,5% del valor declarado de la mercancía. Para asegurar dicha mercancía “a todo riesgo” por su valor, deberá reunir, los siguientes requisitos: declaración expresa de su contenido y valor; y pago y aceptación de dicha prima. El cargo mínimo es de 4,81 €.<br/>
        Las direcciones erróneas y como tramitación de incidencias, tienen un suplemento adicional de 3,91 € en servicios locales; para servicios nacionales / internacionales el suplemento es de 6,91 €. Se cargará además, el importe de la nueva dirección de entrega, así como cualquier cargo por esperas en la tramitación y confirmación.<br/>
        Los POD ( comprobantes de entrega) tienen un suplemento adicional de 3,91 € en Madrid y 6,91 € para servicios nacionales / internacionales.<br/>
        Quedan excluidos para el transporte de paquetes y objetos cuyo contenido sea contrario a la ley o cuyo contenido esté sujeto a requerimientos o disposiciones adicionales, asumiendo unicamente el remitente las responsabilidades que pudieran derivarse.<br/>
        Quedan expresamente excluidos: animales vivos y pieles de animales salvajes; metales, piedras preciosas, objetos de arte y antigüedades; documentos financieros negociables y dinero en efectivo. material radioactivo, explosivo y armas; mercancías peligrosas; plantas y mercancías perecederas.<br/>
        '._EMP_EMPRESA.', no se responsabiliza de roturas o derrames de la mercancía transportada por insuficiencias de embalaje.<br/>
        Revisión anual de precios: si no hubiera notificación por parte de nuestra empresa de nuevos precios y servicios o condiciones nuevas para el siguiente año, aplicaremos a la tarifa establecida el incremento del IPC ( índice de precios al consumo) anual.<br/>
        La relación contractual derivada del servicio de transporte queda sujeta a todo lo establecido en la L.O.T.T. ( Ley de Ordenación de los Transportes Terrestres), su Reglamento y demás disposiciones legales de desarrollo.<br/> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>';

/*Proteccion de Datos*/
echo'<div class="modal fade" id="proteccion_datos" tabindex="-1" role="dialog" aria-labelledby="proteccionDatosLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="proteccionDatosLabel">Protección de Datos</h4>
      </div>
      <div class="modal-body">
        En cumplimiento de la LOPD 15/99, le informamos de que la cumplimentación del presente formulario implica el consentimiento expreso a que los datos personales facilitados del interesado sean incorporados y tratados en ficheros automatizados, cuyo responsable es '._EMP_EMPRESA.' con la finalidad de gestionar la relación comercial con sus clientes. Los derechos de acceso, rectificación, cancelación y oposición de sus datos de carácter personal podrán ser ejercidos poniéndose en contacto con nosotros en la dirección electrónica '._EMP_MAIL.' o en '._EMP_CALLE.' '._EMP_DP_CIUDAD.' Teléfono: '._EMP_TEL.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>';

/*Aviso Legal*/
echo'<div class="modal fade" id="aviso_legal" tabindex="-1" role="dialog" aria-labelledby="avisoLegalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="avisoLegalLabel">Aviso Legal</h4>
      </div>
      <div class="modal-body">
        En cumplimiento del artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico, a continuación se exponen los datos identificativos de la empresa.<br/>
        <br/>
        Denominación Social:  '._EMP_EMPRESA.'<br/>
        Nif / Cif:                      '._EMP_CIF.'<br/>
        Domicilio Social:           '._EMP_CALLE.'<br/>
        Teléfono:                    '._EMP_TEL.' <br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>';

