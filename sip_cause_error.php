<?php
require_once 'views/parte_superior.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sip Error</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Error SIP 100 -->
                                    <tr>
                                        <td colspan="3">1xx = Respuestas Informativas SIP</td>
                                    </tr>
                                    <tr>
                                        <td>100</td>
                                        <td>Tratando</td>
                                        <td>Búsqueda extendida en proceso, un proxy de bifurcación debe enviar una respuesta “100 Tratando”.</td>
                                    </tr>
                                    <tr>
                                        <td>180</td>
                                        <td>Teléfono sonando</td>
                                        <td>El Agente de Usuario de Destino ha recibido el mensaje INVITE y está alertando al usuario de la llamada.</td>
                                    </tr>
                                    <tr>
                                        <td>181</td>
                                        <td>Llamada está siendo redireccionada</td>
                                        <td>Opcional, enviado por el servidor para indicar que una llamada esta siendo redireccionada.</td>
                                    </tr>
                                    <tr>
                                        <td>182</td>
                                        <td>Encolada</td>
                                        <td>El destino no estaba disponible, el servidor ha encolado la llamada hasta que el destino este disponible.</td>
                                    </tr>
                                    <tr>
                                        <td>183</td>
                                        <td>Progreso de Sesión</td>
                                        <td>Esta respuesta puede ser utilizada para enviar información adicional para una llamada que todavía se está estableciendo.</td>
                                    </tr>
                                    <tr>
                                        <td>199</td>
                                        <td>Diálogo Previo Terminado</td>
                                        <td>Enviado por el Agente de Usuario del Servidor para indicar que un diálogo previo ha terminado.</td>
                                    </tr>
                                    <!-- Error SIP 100 -->
                                    <!-- Error SIP 200 -->
                                    <tr>
                                        <td colspan="3">2xx = Respuestas de Éxito</td>
                                    </tr>
                                    <tr>
                                        <td>200</td>
                                        <td>OK</td>
                                        <td>Muestra que la solicitud fue exitosa</td>
                                    </tr>
                                    <tr>
                                        <td>202</td>
                                        <td>Aceptada</td>
                                        <td>Indica que la solicitud ha sido aceptada para procesar, se utiliza principalmente para referencia.</td>
                                    </tr>
                                    <tr>
                                        <td>204</td>
                                        <td>Sin Notificación</td>
                                        <td>Indica que la solicitud fue exitosa pero no se recibirá respuesta</td>
                                    </tr>
                                    <!-- Error SIP 200 -->
                                    <!-- Error SIP 300 -->
                                    <tr>
                                        <td colspan="3">3xx = Respuestas de Redirección</td>
                                    </tr>
                                    <tr>
                                        <td>300</td>
                                        <td>Múltiples Opciones</td>
                                        <td>La dirección resuelta a una de las diferentes opciones para que el usuario o cliente elija.</td>
                                    </tr>
                                    <tr>
                                        <td>301</td>
                                        <td>Movido Permanentemente</td>
                                        <td>La solicitud original URI ya no es válida, la nueva dirección se da en la cabecera de Contacto.</td>
                                    </tr>
                                    <tr>
                                        <td>302</td>
                                        <td>Movido Temporalmente</td>
                                        <td>El cliente debería tratar a la dirección en el campo Contacto.</td>
                                    </tr>
                                    <tr>
                                        <td>305</td>
                                        <td>Utiliza Proxy</td>
                                        <td>El campo del Contacto detalla un proxy que se debe utilizar para acceder al destino solicitado.</td>
                                    </tr>
                                    <tr>
                                        <td>380</td>
                                        <td>Servicio Alternativo</td>
                                        <td>La llamada falló, pero las alternativas son detalladas en el cuerpo del mensaje.</td>
                                    </tr>
                                    <!-- Error SIP 300 -->
                                    <!-- Error SIP 400 -->
                                    <tr>
                                        <td colspan="3">4xx = Errores de Solicitud</td>
                                    </tr>
                                    <tr>
                                        <td>400</td>
                                        <td>Solicitud Errónea</td>
                                        <td>La solicitud no pudo ser entendida debido a sintaxis incorrecta.</td>
                                    </tr>
                                    <tr>
                                        <td>401</td>
                                        <td>No Autorizado</td>
                                        <td>La solicitud requiere autenticación de usuario. Esta respuesta es emitida por los UASs y los registradores.</td>
                                    </tr>
                                    <tr>
                                        <td>402</td>
                                        <td>Pago Requerido</td>
                                        <td>(Reservado para uso futuro).</td>
                                    </tr>
                                    <tr>
                                        <td>403</td>
                                        <td>Prohibido</td>
                                        <td>El servidor entendió la solicitud, pero se rechaza el cumplimiento.</td>
                                    </tr>
                                    <tr>
                                        <td>404</td>
                                        <td>No Encontrado</td>
                                        <td>El servidor tiene información definitiva de que el usuario no existe (Usuario no encontrado).</td>
                                    </tr>
                                    <tr>
                                        <td>405</td>
                                        <td>Método No Permitido</td>
                                        <td>El método especificado en la Linea de Solicitud se entendió, pero no se permitió.</td>
                                    </tr>
                                    <tr>
                                        <td>406</td>
                                        <td>No aceptable</td>
                                        <td>El recurso sólo es capaz de generar respuestas con contenido inaceptable.</td>
                                    </tr>
                                    <tr>
                                        <td>407</td>
                                        <td>Autenticación de Proxy Requerida</td>
                                        <td>La solicitud requiere autenticación de usuario.</td>
                                    </tr>
                                    <tr>
                                        <td>408</td>
                                        <td>Expiración de Solicitud</td>
                                        <td>No se pudo encontrar el usuario a tiempo.</td>
                                    </tr>
                                    <tr>
                                        <td>409</td>
                                        <td>Conflicto</td>
                                        <td>Usuario ya registrado (en desuso)</td>
                                    </tr>
                                    <tr>
                                        <td>410</td>
                                        <td>Ido</td>
                                        <td>El usuario existió una vez, pero no está más disponible acá.</td>
                                    </tr>
                                    <tr>
                                        <td>411</td>
                                        <td>Longitud Requerida</td>
                                        <td>El servidor no aceptará la solicitud sin una longitud de contenido válida (obsoleto).</td>
                                    </tr>
                                    <tr>
                                        <td>412</td>
                                        <td>Petición Condicional Fallida</td>
                                        <td>La condición preestablecida no se ha cumplido.</td>
                                    </tr>
                                    <tr>
                                        <td>413</td>
                                        <td>Entidad de Solicitud Demasiado Larga</td>
                                        <td>Cuerpo de la solicitud demasiado grande.</td>
                                    </tr>
                                    <tr>
                                        <td>414</td>
                                        <td>Solicitud URI Demasiado Larga</td>
                                        <td>El servidor rechaza atender la solicitud, la Solicitud-URI es más larga de lo que el servidor puede interpretar.</td>
                                    </tr>
                                    <tr>
                                        <td>415</td>
                                        <td>Tipo de Medio No Soportado</td>
                                        <td>Solicitud del cuerpo está en un formato no soportado.</td>
                                    </tr>
                                    <tr>
                                        <td>416</td>
                                        <td>Esquema URI No Soportado</td>
                                        <td>Solicitud-URI es desconocida para el servidor.</td>
                                    </tr>
                                    <tr>
                                        <td>417</td>
                                        <td>Prioridad del Recurso Desconocida</td>
                                        <td>Hubo una etiqueta de opción de recursos con prioridad, pero no hay cabecera de Recursos con Prioridad.</td>
                                    </tr>
                                    <tr>
                                        <td>420</td>
                                        <td>Extensión Inválida</td>
                                        <td>Extensión utilizada de Protocolo SIP Inválida , no es entendida por el servidor.</td>
                                    </tr>
                                    <tr>
                                        <td>421</td>
                                        <td>Extensión Requerida</td>
                                        <td>El servidor necesita una extensión específica no listada en la cabecera Soportada.</td>
                                    </tr>
                                    <tr>
                                        <td>422</td>
                                        <td>Intervalo de Sesión Demasiado Pequeña</td>
                                        <td>La solicitud contiene un campo de cabecera de Expiración de Sesión con una duración por debajo del mínimo.</td>
                                    </tr>
                                    <tr>
                                        <td>423</td>
                                        <td>Intervalo Muy Corto</td>
                                        <td>Tiempo de expiración del recurso es demasiado corta.</td>
                                    </tr>
                                    <tr>
                                        <td>424</td>
                                        <td>Información de Ubicación Invalida</td>
                                        <td>El contenido de la ubicación de la solicitud fue mal formado o insatisfactorio.</td>
                                    </tr>
                                    <tr>
                                        <td>428</td>
                                        <td>Usar Encabezado de Identidad</td>
                                        <td>La política del servidor requiere una identidad de cabecera, y no sido proporcionado.</td>
                                    </tr>
                                    <tr>
                                        <td>429</td>
                                        <td>Proporcionar Identidad Referente</td>
                                        <td>El servidor no recibió un clave referida válida en la solicitud.</td>
                                    </tr>
                                    <tr>
                                        <td>430</td>
                                        <td>Falla en Flujo</td>
                                        <td>Un flujo específico a un agente de usuario ha fallado, aunque otros flujos pueden ser exitosos.</td>
                                    </tr>
                                    <tr>
                                        <td>433</td>
                                        <td>Anonimato No Permitido</td>
                                        <td>La solicitud ha sido rechazada porque era anónima.</td>
                                    </tr>
                                    <tr>
                                        <td>436</td>
                                        <td>Info de Identidad Invalida La solicitud tiene un encabezado de Identidad</td>
                                        <td>Info y el esquema URI contenido no puede ser de-referenciado.</td>
                                    </tr>
                                    <tr>
                                        <td>437</td>
                                        <td>Certificado No Compatible</td>
                                        <td>El servidor no ha podido validar un certificado para el dominio que firmó la solicitud .</td>
                                    </tr>
                                    <tr>
                                        <td>438</td>
                                        <td>Cabecera de Identidad Inválida</td>
                                        <td>El servidor obtuvo un certificado válido utilizado para firmar una solicitud, pero no se pudo comprobar la firma.</td>
                                    </tr>
                                    <tr>
                                        <td>439</td>
                                        <td>Primer Salto Carece de Soporte de Salida</td>
                                        <td>El primer proxy de salida no admite la función de “salida”.</td>
                                    </tr>
                                    <tr>
                                        <td>440</td>
                                        <td>Amplitud Máxima Superada</td>
                                        <td>Si un SIP proxy determina un contexto de respuesta que no cuenta con suficiente amplitud máxima para llevar a cabo el fork paralelo deseado y el proxy no puede compensar el fork en serie o envía una redirección, ese proxy DEBE regresar una respuesta 440. Un cliente que recibe una respuesta 440 puede que su petición no alcanzó todos los destinos posibles.</td>
                                    </tr>
                                    <tr>
                                        <td>469</td>
                                        <td>Paquete de Información Incorrecto</td>
                                        <td>Si un UA SIP recibe una solicitud INFO asociada con la Información del Paquete que el UA no indicó desea recibir, el UA DEBE enviar una respuesta 469, la cual contiene un campo de cabecera Recv-Info con la Información del Paquete por la cual el UA espera recibir las peticiones INFO.</td>
                                    </tr>
                                    <tr>
                                        <td>470</td>
                                        <td>Consentimiento Necesario</td>
                                        <td>La fuente de la solicitud no tenía permiso del destinatario para realizar dicha solicitud.</td>
                                    </tr>
                                    <tr>
                                        <td>480</td>
                                        <td>Temporalmente No Disponible</td>
                                        <td>Destinatario no disponible en este momento.</td>
                                    </tr>
                                    <tr>
                                        <td>481</td>
                                        <td>Llamada/Transacción No Existe</td>
                                        <td>El servidor recibe una solicitud que no coincide con ningún diálogo o transacción.</td>
                                    </tr>
                                    <tr>
                                        <td>482</td>
                                        <td>Bucle Detectado</td>
                                        <td>El servidor ha detectado un bucle.</td>
                                    </tr>
                                    <tr>
                                        <td>483</td>
                                        <td>Demasiados Saltos</td>
                                        <td>El encabezado de Reenvios-Máximos (Max-Forwards) ha alcanzado el valor “0”.</td>
                                    </tr>
                                    <tr>
                                        <td>484</td>
                                        <td>Dirección Incompleta</td>
                                        <td>Solicitud-URI incompleta.</td>
                                    </tr>
                                    <tr>
                                        <td>485</td>
                                        <td>Ambiguo</td>
                                        <td>Solicitud-URI ambigua</td>
                                    </tr>
                                    <tr>
                                        <td>486</td>
                                        <td>Ocupado acá</td>
                                        <td>Destinatario está ocupado</td>
                                    </tr>
                                    <tr>
                                        <td>487</td>
                                        <td>Solicitud Terminada</td>
                                        <td>Solicitud ha terminado por bye o cancelar</td>
                                    </tr>
                                    <tr>
                                        <td>488</td>
                                        <td>No Aceptable Aquí</td>
                                        <td>Algunos aspectos de la descripción de la sesión de la Solicitud URI no son aceptables.</td>
                                    </tr>
                                    <tr>
                                        <td>489</td>
                                        <td>Evento Inválido</td>
                                        <td>El servidor no ha comprendido un paquete de evento especificado en un campo de cabecera “Evento”.</td>
                                    </tr>
                                    <tr>
                                        <td>491</td>
                                        <td>Solicitud Pendiente</td>
                                        <td>El servidor tiene alguna solicitud pendiente desde el mismo diálogo.</td>
                                    </tr>
                                    <tr>
                                        <td>493</td>
                                        <td>Indescifrable</td>
                                        <td>Solicitud Indescifrable contiene un cuerpo MIME cifrado, que el destinatario no puede descifrar.</td>
                                    </tr>
                                    <tr>
                                        <td>494</td>
                                        <td>Acuerdo de Seguridad Requerido</td>
                                        <td>El servidor ha recibido una solicitud que requiere un mecanismo de seguridad negociado.</td>
                                    </tr>
                                    <!-- Error SIP 400 -->
                                    <!-- Error SIP 500 -->
                                    <tr>
                                        <td colspan="3">5xx = Errores de Servidor</td>
                                    </tr>
                                    <tr>
                                        <td>500</td>
                                        <td>Error Interno del Servidor</td>
                                        <td>El servidor no ha podido cumplir con la solicitud debido a alguna condición inesperada</td>
                                    </tr>
                                    <tr>
                                        <td>501</td>
                                        <td>No Implementado</td>
                                        <td>El método de solicitud SIP no se ha implementado acá.</td>
                                    </tr>
                                    <tr>
                                        <td>502</td>
                                        <td>Gateway Inválido</td>
                                        <td>​El servidor, recibió una respuesta inválida de un servidor aguas abajo al intentar cumplir con una solicitud.</td>
                                    </tr>
                                    <tr>
                                        <td>503</td>
                                        <td>Servicio No Disponible</td>
                                        <td>El servidor está en mantenimiento o está sobrecargado temporalmente y no puede procesar la solicitud.</td>
                                    </tr>
                                    <tr>
                                        <td>504</td>
                                        <td>Expiración de Servidor</td>
                                        <td>El servidor trató de acceder a otro servidor mientras intentaba procesar una solicitud, no hay respuesta a tiempo.</td>
                                    </tr>
                                    <tr>
                                        <td>505</td>
                                        <td>Versión No Soportada</td>
                                        <td>La versión del protocolo SIP en la solicitud no es soportada por el servidor.</td>
                                    </tr>
                                    <tr>
                                        <td>513</td>
                                        <td>Mensaje Demasiado Largo</td>
                                        <td>La longitud del mensaje de solicitud es más largo que lo que el servidor puede procesar.</td>
                                    </tr>
                                    <tr>
                                        <td>555</td>
                                        <td>Servicio de Notificación Push No Soportado</td>
                                        <td>El servidor no soporta el servicio de notificación push recibido especificado en el parámetro de pn-provider SIP URI.</td>
                                    </tr>
                                    <tr>
                                        <td>580</td>
                                        <td>Falla de Pre condición</td>
                                        <td>El servidor no puede o no quiere cumplir algunas restricciones especificadas en la oferta.</td>
                                    </tr>
                                    <!-- Error SIP 500 -->
                                    <!-- Error SIP 600 -->
                                    <tr>
                                        <td colspan="3">6xx = Errores Globales</td>
                                    </tr>
                                    <tr>
                                        <td>600</td>
                                        <td>Ocupado en Todas Partes</td>
                                        <td>Todos los posibles destinos están ocupados.</td>
                                    </tr>
                                    <tr>
                                        <td>603</td>
                                        <td>Declinación</td>
                                        <td>El destinatario no puede / no quiere participar de la llamada, no hay destinos alternativos.</td>
                                    </tr>
                                    <tr>
                                        <td>604</td>
                                        <td>No Existe en Ninguna Parte</td>
                                        <td>El servidor tiene información fidedigna de que el usuario solicitado no existe en ninguna parte.</td>
                                    </tr>
                                    <tr>
                                        <td>606</td>
                                        <td>No Aceptable</td>
                                        <td>El agente del usuario fue contactado con éxito pero algunos aspectos de la descripción de la sesión no eran aceptables.</td>
                                    </tr>
                                    <tr>
                                        <td>607</td>
                                        <td>No Deseado</td>
                                        <td>La parte a la cual ha llamado no desea recibir la llamada desde la parte que llama. Es muy probable que los intentos futuros desde la parte que llamada sean rechazados de forma similar.</td>
                                    </tr>
                                    <tr>
                                        <td>610</td>
                                        <td>Bloqueo por intentos</td>
                                        <td>El erro aparece cuando la llamada sale por IPCOM.</td>
                                    </tr>
                                    <!-- Error SIP 600 -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- INCONPLETOS -->
            <div class="col-lg-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cause Error</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre Error</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Error SIP 100 -->
                                    <tr>
                                        <td colspan="2">Causas Error</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 1</td>
                                        <td>Número no asignado (no asignado): esta causa indica que no se puede localizar a la parte llamada porque, aunque el número de la parte llamada está en un formato válido, no está actualmente asignado (asignado).</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 2</td>
                                        <td>Sin ruta a la red de tránsito especificada: esta causa indica que el equipo que envía esta causa ha recibido una solicitud para enrutar la llamada a través de una red de tránsito en particular que no reconoce. El equipo que envía esta causa no reconoce la red de tránsito ya sea porque la red de tránsito no existe o porque esa red de tránsito en particular, mientras existe, no atiende al equipo que envía esta causa. Esta causa depende de la red.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 3</td>
                                        <td>Sin ruta al destino: esta causa indica que no se puede llegar a la parte llamada porque la red a través de la cual se enruta la llamada no sirve al destino deseado. Esta causa depende de la red.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 4</td>
                                        <td>Enviar tono de información especial: esta causa indica que la parte llamada no puede ser localizada por razones que son de naturaleza a largo plazo y que el tono de información especial debe devolverse a la parte llamante.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 5</td>
                                        <td>Prefijo de troncal mal marcado: no se han especificado procedimientos para las redes de EE. UU.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 8</td>
                                        <td>Preemption - This cause indicates that the call is being preempted.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 9</td>
                                        <td>Preferencia: circuito reservado para reutilización. Esta causa indica que la llamada se está apropiando y el circuito está reservado para ser reutilizado por la central de apropiación.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 16</td>
                                        <td>Liberación de llamada normal: esta causa indica que la llamada se libera porque uno de los usuarios involucrados en la llamada ha solicitado que se libere la llamada. En situaciones normales, la fuente de esta causa no es la red.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 17</td>
                                        <td>Usuario ocupado: esta causa se utiliza para indicar que la parte llamada no puede aceptar otra llamada porque se ha encontrado la condición de usuario ocupado. Este valor de causa puede ser generado por el usuario llamado o por la red. En el caso de usuario ocupado determinado por el usuario, se observa que el equipo de usuario es compatible con la llamada.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 18</td>
                                        <td>Ningún usuario responde: esta causa se utiliza cuando una parte llamada no responde a un mensaje de establecimiento de llamada con una alerta o una indicación de conexión dentro del período de tiempo prescrito asignado.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 19</td>
                                        <td>Sin respuesta del usuario (usuario alertado): este valor se utiliza cuando se ha alertado a la parte llamada pero no responde con una indicación de conexión dentro de un período de tiempo prescrito. Nota - Esta causa no la generan necesariamente los procedimientos Q.93l, pero puede ser generada por los temporizadores de la red interna.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 20</td>
                                        <td>Abonado ausente: este valor de causa se utiliza cuando una estación móvil se ha desconectado, no se obtiene contacto por radio con una estación móvil o si un usuario de telecomunicaciones personal no es accesible temporalmente en ninguna interfaz usuario-red.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 21</td>
                                        <td>Llamada rechazada - Esta causa indica que el equipo que envía esta causa no desea aceptar esta llamada, aunque podría haber aceptado la llamada porque el equipo que envía esta causa no está ocupado ni es incompatible. La red también puede generar esta causa, indicando que la llamada fue liberada debido a una restricción del servicio suplementario. El campo de diagnóstico puede contener información adicional sobre el servicio suplementario y el motivo del rechazo.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 22</td>
                                        <td>Número cambiado: esta causa se devuelve a la parte que llama cuando el número de la parte llamada indicado por la parte que llama ya no está asignado. El nuevo número de la parte llamada puede incluirse opcionalmente en el campo de diagnóstico. Si una red no admite este valor de causa, se utilizará la causa número 1, número no asignado (no asignado).</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 27</td>
                                        <td>Destino fuera de servicio: esta causa indica que no se puede llegar al destino indicado por el usuario porque la interfaz al destino no está funcionando correctamente. El término "no funciona correctamente" indica que no se pudo entregar un mensaje de señalización a la parte remota; por ejemplo, una falla de la capa física o de la capa de enlace de datos en la parte remota, o el equipo del usuario fuera de línea.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 28</td>
                                        <td>Formato de número no válido (dirección incompleta): esta causa indica que no se puede localizar a la parte llamada porque el número de la parte llamada no tiene un formato válido o no está completo.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 29</td>
                                        <td>Facilidad rechazada: esta causa se devuelve cuando la red no puede proporcionar un servicio suplementario solicitado por el usuario.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 30</td>
                                        <td>Normal, sin especificar: esta causa se utiliza para informar un evento normal solo cuando no se aplica ninguna otra causa de la clase normal.</td>
                                    </tr>
                                    <!-- Error SIP 300 -->
                                    <tr>
                                        <td colspan="2">Clase de recurso no disponible</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 34</td>
                                        <td>No hay circuito / canal disponible: esta causa indica que no hay un circuito / canal apropiado disponible actualmente para manejar la llamada.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 38</td>
                                        <td>Red fuera de servicio: esta causa indica que la red no está funcionando correctamente y que es probable que la condición dure un período de tiempo relativamente largo, por ejemplo, no es probable que reintentar inmediatamente la llamada tenga éxito.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 41</td>
                                        <td>Fallo temporal: esta causa indica que la red no está funcionando correctamente y que es poco probable que la condición dure mucho tiempo, por ejemplo, el usuario puede querer intentar otro intento de llamada casi de inmediato.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 42</td>
                                        <td>Congestión del equipo de conmutación: esta causa indica que el equipo de conmutación que genera esta causa está experimentando un período de alto tráfico.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 43</td>
                                        <td>Información de acceso descartada: esta causa indica que la red no pudo entregar la información de acceso al usuario remoto según lo solicitado, es decir, información de usuario a usuario, compatibilidad de capa baja, compatibilidad de capa alta o subdirección, como se indica en el diagnóstico. Se observa que el tipo particular de información de acceso descartada se incluye opcionalmente en el diagnóstico.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 44</td>
                                        <td>Circuito / canal solicitado no disponible: esta causa se devuelve cuando el circuito o canal indicado por la entidad solicitante no puede ser proporcionado por el otro lado de la interfaz.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 46</td>
                                        <td>Llamada de precedencia bloqueada: esta causa indica que no hay circuitos sustituibles o que el usuario llamado está ocupado con una llamada de nivel preferente igual o superior.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 47</td>
                                        <td>Recurso no disponible, no especificado: esta causa se utiliza para informar un evento de recurso no disponible solo cuando no se aplica ninguna otra causa en la clase de recurso no disponible.</td>
                                    </tr>

                                    <!-- Error SIP 400 -->
                                    <tr>
                                        <td colspan="2">SERVICIO U OPCIÓN CLASE NO DISPONIBLE</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 50</td>
                                        <td>Facilidad solicitada no suscrita - Esta causa indica que el usuario ha solicitado un servicio suplementario que es implementado por el equipo que generó esta causa, pero el usuario no está autorizado para usar.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 53</td>
                                        <td>Llamadas salientes prohibidas dentro de CUG: no se ha especificado ningún procedimiento para las redes estadounidenses.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 55</td>
                                        <td>Llamadas entrantes bloqueadas dentro de CUG - No se especifica ningún procedimiento para las redes de EE. UU.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 57</td>
                                        <td>Capacidad portadora no autorizada - Esta causa indica que el usuario ha solicitado una capacidad portadora que es implementada por el equipo que generó esta causa, pero el usuario no está autorizado a usar.</td>
                                    </tr>

                                    <tr>
                                        <td>Cause 58</td>
                                        <td>Capacidad portadora no disponible actualmente - Esta causa indica que el usuario ha solicitado una capacidad portadora implementada por el equipo que generó esta causa pero que no está disponible en este momento.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 62</td>
                                        <td>Inconsistency in designated outgoing access information and subscriber class - Esta causa indica que hay una incoherencia en la información de acceso saliente designada y la clase de abonado.</td>
                                    </tr>
                                    <tr>
                                        <td>Cause 63</td>
                                        <td>Servicio u opción no disponible, sin especificar: esta causa se utiliza para informar un evento de servicio u opción no disponible solo cuando no se aplica ninguna otra causa en la clase de servicio u opción no disponible.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">SERVICIO / OPCIÓN NO IMPLEMENTADA CLASE</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

    </div>
</div>
<!--End content-wrapper-->

<?php
require_once  'views/parte_inferior.php';
?>