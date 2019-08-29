<?php
require_once("Autoload.php");

function nome($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);

    $nome1 = explode('<a href="/judge/en/profile/'.$id.'">',$dadosSite);
    $nome2 = explode("</a>",$nome1[1]);
    return $nome2[0];
}

function place ($id){
        set_time_limit(0);
        // URL DO SITE
        $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
        // PEGANDO TODO CONTEUDO
        $dadosSite = file_get_contents($url);
        $place1 = explode('<span>Place:</span>',$dadosSite);
        $place2 = explode("&ordm;",$place1[1]);
        $posicao= $place2[0];

        $pontuacao = array(",");
        $posicao = str_replace($pontuacao, "", $posicao);

        return $posicao;
}

function insti($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);
    $inst1 = explode('<a href="/judge/en/users/university/',$dadosSite);
    $inst2 = explode('" target="_blank">',$inst1[1]);

    return $inst2[0];
}

function since($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);
    $since1 = explode('<span>Since:</span>',$dadosSite);
    $since2 = explode("</li>",$since1[1]);

    return $since2[0];
}

function pontos ($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);
    $pontos1 = explode('<span>Points:</span>',$dadosSite);
    $pontos2 = explode("</li>",$pontos1[1]);
    $pontos= $pontos2[0];

    $pontuacao = array(",");
    $pontos = str_replace($pontuacao, "",$pontos);

    return $pontos;
}

function resolv($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);
    $resolv1 = explode('<span>Solved:</span>',$dadosSite);
    $resolv2 = explode("</li>",$resolv1[1]);
    $resolvidos= $resolv2[0];

    $pontuacao = array(",");
    $resolvidos = str_replace($pontuacao, "",$resolvidos);
    return $resolvidos;
}

function tent ($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);
    $tent1 = explode('<span>Tried:</span>',$dadosSite);
    $tent2 = explode("</li>",$tent1[1]);
    $tentativas= $tent2[0];

    $pontuacao = array(",");
    $tentativas = str_replace($pontuacao, "",$tentativas);
    return $tentativas;
}
function env ($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);
    $env1 = explode('<span>Submissions:</span>',$dadosSite);
    $env2 = explode("</li>",$env1[1]);
    $enviados= $env2[0];

    $pontuacao = array(",");
    $enviados = str_replace($pontuacao, "",$enviados);
    return $enviados;
}
function foto($id){
    set_time_limit(0);
    // URL DO SITE
    $url = 'https://www.urionlinejudge.com.br/judge/en/profile/'.$id;
    // PEGANDO TODO CONTEUDO
    $dadosSite = file_get_contents($url);

    $foto = explode('<img src="',$dadosSite);
    $foto2 = explode('" alt',$foto[1]);
    return $foto2[0];
}
?>