<?php
require_once 'views/parte_superior.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
    <div class="container-fluid" style="height: 85vh;">
        <div class="row">
            <div class="col-lg-12 p-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><h3 class="h3">Vicis</h3></div>
                        <div class="contenedor-vicis">
                            <div class="grid-container">
                                <?php
                                    $servidores = array("5", "6", "8", "9", "11", "14", "15", "22", "24", "27", "28","29", "30", "34", "35", "36","37", "38","39","40", "41", "42", "43", "44", "45", "46", "47", "48","57","60","201");
                                    foreach ($servidores as $vici) {
                                    ?>
                                        <button type="button" class="btn btn-light px-5" id="vici_<?php echo $vici;?>">
                                            <a href="http://10.9.2.<?php echo $vici;?>/vicidial/realtime_report.php" target="_blank"
                                                rel="noopener noreferrer" class='testbutton'><?php echo $vici;?></a>
                                            
                                        </button>
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 p-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><h3 class="h3">Varios</h3></div>
                        <div class="contenedor-vicis">
                            <div class="grid-container p-4">
                            
                                <button type="button" class="btn btn-light px-5">
                                    <a href="http://10.9.2.147/telefonia/" title="Telefonia Finanzas" target="_blank">
                                        <svg class="icon icon-tabler icon-tabler-phone-call" width="40" height="40" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                            <path d="M15 7a2 2 0 0 1 2 2" />
                                            <path d="M15 3a6 6 0 0 1 6 6" />
                                        </svg>
                                    </a>
                                </button>
                            
                                <button type="button" class="btn btn-light px-5">
                                    <a href="http://10.9.2.147/definitivo/reporte_tel" title="Nuevo Reporte Telefonía" target="_blank">
                                        <svg class="icon icon-tabler icon-tabler-report" width="40" height="40" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                            <path d="M18 14v4h4" />
                                            <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                                            <rect x="8" y="3" width="6" height="4" rx="2" />
                                            <circle cx="18" cy="18" r="4" />
                                            <path d="M8 11h4" />
                                            <path d="M8 15h3" />
                                        </svg>
                                    </a>
                                </button>
                            
                                <button type="button" class="btn btn-light px-5">
                                    <a href="http://10.9.2.21" title="Panel .21" target="_blank">
                                        <svg class="icon icon-tabler icon-tabler-alien" width="40" height="40" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M11 17a2.5 2.5 0 0 0 2 0" />
                                            <path
                                                d="M12 3c-4.664 0 -7.396 2.331 -7.862 5.595a11.816 11.816 0 0 0 2 8.592a10.777 10.777 0 0 0 3.199 3.064c1.666 1 3.664 1 5.33 0a10.777 10.777 0 0 0 3.199 -3.064a11.89 11.89 0 0 0 2 -8.592c-.466 -3.265 -3.198 -5.595 -7.862 -5.595z" />
                                            <line x1="8" y1="11" x2="10" y2="13" />
                                            <line x1="16" y1="11" x2="14" y2="13" />
                                        </svg>
                                        </svg>
                                    </a>
                                </button>
                            
                                <button type="button" class="btn btn-light px-5">
                                    <a href="http://127.0.0.1/phpmyadmin" title="Php My Admin" target="_blank">
                                        <svg class="icon icon-tabler icon-tabler-server" width="44" height="44" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="3" y="4" width="18" height="8" rx="3" />
                                            <rect x="3" y="12" width="18" height="8" rx="3" />
                                            <line x1="7" y1="8" x2="7" y2="8.01" />
                                            <line x1="7" y1="16" x2="7" y2="16.01" />
                                        </svg>
                                    </a>
                                </button>
                            
                                <button type="button" class="btn btn-light px-5">
                                    <a href="http://127.0.0.1/definitivo/pruebas/" title="Pruebas" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-a-b" width="44" height="44"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 16v-5.5a2.5 2.5 0 0 1 5 0v5.5m0 -4h-5" />
                                            <line x1="12" y1="6" x2="12" y2="18" />
                                            <path d="M16 16v-8h3a2 2 0 0 1 0 4h-3m3 0a2 2 0 0 1 0 4h-3" />
                                        </svg>
                                    </a>
                                </button>

                                <button type="button" class="btn btn-light px-5">
                                    <a href="http://127.0.0.1/monitor/index.php" title="Panel Telefonia" target="_blank">
                                        <svg class="icon icon-tabler icon-tabler-device-desktop-analytics" width="44" height="44"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="3" y="4" width="18" height="12" rx="1" />
                                            <path d="M7 20h10" />
                                            <path d="M9 16v4" />
                                            <path d="M15 16v4" />
                                            <path d="M9 12v-4" />
                                            <path d="M12 12v-1" />
                                            <path d="M15 12v-2" />
                                            <path d="M12 12v-1" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End container-fluid-->
</div>
<!--End content-wrapper-->

<?php
require_once  'views/parte_inferior.php';
?>