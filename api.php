<?php

require_once ('login.php');

if (isset($_GET["api"]) and $_GET["api"] !== "") {
    
    // liga
    if ($_GET["api"] === "liga") {
		
        // $orderBy: campeonato, turno, mes, rodada, patrimonio
        $orderBy = "";
        if (isset($_GET["orderBy"]) && $_GET["orderBy"] != "") {
            $orderBy = "?orderBy=" . $_GET["orderBy"];
        }
        
        // $page: 1, 2, 3...
        $page = "";
        if (isset($_GET["page"]) && $_GET["page"] != "") {
            if (! array_key_exists("orderBy", $_GET)) {
                $page = "?page=" . $_GET["page"];
            } else {
                $page = "&page=" . $_GET["page"];
            }
        }
        
        $url = "https://api.cartolafc.globo.com/auth/liga/" . $_GET["liga_slug"] . $orderBy . $page;
    }     

    // estatisticas e scouts dos atletas
    else 
        if ($_GET["api"] === "atleta-pontuacao") {
            $url = "https://api.cartolafc.globo.com/auth/mercado/atleta/" . $_GET["atleta_id"] . "/pontuacao";
        }
    
    $c = curl_init();
    
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HTTPHEADER, array(
        'X-GLB-Token: ' . $_SESSION['glbId']
    ));
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($c, CURLOPT_VERBOSE, TRUE);
    
    $result = curl_exec($c);
    
    if ($result === FALSE) {
        die(curl_error($c));
    }
    
    curl_close($c);
    
    echo $result;
}

exit();
if (isset($_GET["api"]) and $_GET["api"] !== "") {
    
    if ($_GET["api"] === "busca-time") {
        $url = "https://api.cartolafc.globo.com/times?q=" . rawurlencode($_GET["team"]);
    } else 
        if ($_GET["api"] === "busca-atletas") {
            $url = "https://api.cartolafc.globo.com/time/" . $_GET["team_slug"];
        } else 
            if ($_GET["api"] === "parciais-atletas") {
                $url = "https://api.cartolafc.globo.com/atletas/pontuados";
            } else 
                if ($_GET["api"] === "mercado-status") {
                    $url = "https://api.cartolafc.globo.com/mercado/status";
                } else 
                    if ($_GET["api"] === "atletas-mercado") {
                        $url = "https://api.cartolafc.globo.com/atletas/mercado";
                    }
    
    $c = curl_init();
    
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($c, CURLOPT_URL, $url);
    
    $result = curl_exec($c);
    
    curl_close($c);
    
    echo $result;
}
