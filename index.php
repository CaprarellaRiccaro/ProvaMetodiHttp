<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once ('Classe.php');
$app = AppFactory::create();

// curl http://localhost8080/alunni
$app->get('/alunni', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Tutti gli alunni");
    return $response;
});

// curl http://localhost8080/alunni/2
$app->get('/alunni/{id}', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Alunno: " . $args["id"]);
    return $response;
});

// curl -X POST  http://localhost:8080/alunni -d '{"nome": "Claudio", "cognome": "Benve"}' -H "Content-Type: application/json"
$app->post('/alunni', function (Request $request, Response $response, $args) {
    $dati = json_decode($request->getBody()->getContents(), true);
    $classe = new Classe();
    $alunno = new Alunno ($dati["id"],$dati["nome"], $dati["cognome"], $dati["età"]);
    $classe->aggiungiAlunno($alunno);
    $response->getBody()->write(json_encode($classe)); 
    return $response->withHeader('Content-Type', 'application/json');
});
    
// curl -X PUT http://localhost:8080/alunni/2 -d '{"id": "4", "nome": "Claudio", "cognome": "Benve", "eta": "10"}' -H "Content-Type: application/json"
$app->put ('/alunni', function (Request $request, Response $response, $args) {
    $dati = json_decode($request->getBody()->getContents(), true);
    $classe = new classe;
    $alunno = $classe->getAlunno($args["nome"]);
    if($alunno!=null) {
        $alunno->set_id($dati["id"]);
        $alunno->set_nome($dati["nome"]);
        $alunno->set_cognome($dati["cognome"]);
        $alunno->set_eta($dati["età"]);
    }
    else 
        $response->getBody()->write("Alunno non trovato");
    $response->getBody()->write("Modifica alunno: " . $args["id"] . $dati["nome"] . $dati["cognome"]);
    return $response->withHeader('Content-Type', 'application/json');
});

// curl -X DELETE http://localhost:8080/alunni/2
$app->put ('/alunni/{id}', function (Request $request, Response $response, $args) {
    $classe = new classe;
    if($classe->eliminaAlunno($args["nome"]))
        $response->getBody()->write("Alunno cancellato");
    else  
        $response->getBody()->write("Alunno non trovato");
    return $response->withHeader('Content-Type', 'application/json');
});
$app->run();
