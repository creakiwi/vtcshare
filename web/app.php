<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../db.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();
$app['debug'] = true;
$app
    ->register(new TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views/',
    ))
;

$repo = new \ShareUber\Entity\CodeRepository($dsn, $user, $passwd);

$app
    ->get('/', function(Request $request) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app['twig']->render('error.html.twig');
        }
        return $app['twig']->render('index.html.twig');
    })
;

$app
    ->get('/get/{type}', function(Request $request, $type) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app['twig']->render('error.html.twig');
        }
        try {
            $code = $repo->findRandomCode($type);
 
            return $app['twig']->render('get.html.twig', array(
                'type' => $type,
                'code' => $code,
            ));
        } catch (\PDOException $e) {
            return $app['twig']->render('error.html.twig');
        }
    })
;

$app
    ->get('/share/{type}', function(Request $request, $type) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app['twig']->render('error.html.twig');
        }
        return $app['twig']->render('share.html.twig', array(
            'type' => $type,
        ));
    })
;

$app
    ->post('/share/{type}', function (Request $request, $type) use ($app, $repo) {
        $code = $request->get('code');
        if ($repo->connectionEstablished() === false) {
            return $app['twig']->render('error.html.twig');
        }

        try {
            $repo->insertCode($type, $code);
        } catch (\Exception $e) {
            return $app['twig']->render('error.html.twig');
        }

        return $app->redirect('/');
    })
;

$app
    ->get('/fuckedup/{type}/{code}', function(Request $request, $code) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app->json('error', 200);
        }

        try {
            $repo->fuckedUp($code);

            return $app->redirect('/');
        } catch (\Exception $e) {
            return $app['twig']->render('error.html.twig');
        }
    })
;

$app
    ->get('/api/share/{type}/{code}', function(Request $request, $type, $code) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app->json(array('code' => 'error'), 200);
        }

        try {
            $repo->insertCode($type, $code);

            return $app->json(array('code' => true), 200);
        } catch (\Exception $e) {
            return $app->json(array('code' => 'error'), 200);
        }
    })
;

$app
    ->get('/api/get/{type}', function(Request $request, $type) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app->json(array('code' => 'error'), 200);
        }

        try {
            $code = $repo->findRandomCode($type);

            return $app->json(array('code' => $code), 200);
        } catch (\Exception $e) {
            return $app->json(array('code' => 'error'), 200);
        }
    })
;

$app
    ->get('/api/fuckedup/{type}/{code}', function(Request $request, $type, $code) use($app, $repo) {
        if ($repo->connectionEstablished() === false) {
            return $app->json(array('code' => 'error'), 200);
        }

        try {
            $repo->fuckedUp($type, $code);

            return $app->json(array('code' => true), 200);
        } catch (\Exception $e) {
            return $app->json(array('code' => 'error'), 200);
        }
    })
;

$app->run();