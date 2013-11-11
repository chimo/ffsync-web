<?php

if ((include_once('../private/config.php')) === false) {
    // TODO: Better message
    die("Couldn't find file <b>/private/config.php</b>. Make sure to rename <b>config.php.dist</b> after you've configured it.");
}

require_once('../private/lib/firefox-sync-client-php/sync.php');
require_once('../private/ffobjects.php');
require_once('../private/lib/silex/vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

if ($config['debug'] === true) {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    $app['debug'] = true;
}

$sync = new Firefox_Sync($config['username'], $config['password'], $config['sync_key'], $config['url_base']);

// Twig templates
$theme = __DIR__ . '/../private/themes/';

if (isset($config['theme']) && file_exists($theme . $config['theme'])) {
    $theme .= $config['theme'];
} else {
    $theme .= 'default';
}

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $theme // Note: This can accept an array of paths (fallbacks)
));

// Sessions
$app->register(new Silex\Provider\SessionServiceProvider());

// List bookmarks
$app->get('/', function () use ($app, $sync) {
    $records = $sync->collection_full('bookmarks'); // TODO: Error handling
    $bookmarks = new Bookmarks($records);

    // TODO: Support filtering by multiple tags
    //       I guess we should support AND and OR logic(?)
    if ($app['request']->get('tag')) {
        $bookmarks = $bookmarks->filterByTags(array($app['request']->get('tag')));
    }

    return $app['twig']->render('bookmarks.tpl', array(
        'bookmarks'  => $bookmarks
    ));

});

// Handle login attempt
$app->post('/login', function (Request $request) use ($app, $config) {
    if ($app['session']->get('username')) {
        return $app->redirect('/');
    }

    $username = $request->get('username');
    $password = $request->get('password');

    if ($username === $config['username'] && $password === $config['password']) {
        $app['session']->set('username', $username);
    } else {
        $app['session'] ->getFlashBag()->add('message', 'Incorrect username or password.');
        return $app['twig']->render('login.tpl');
    }

    return $app->redirect('/');
});

// Login
$app->get('/login', function () use ($app) {
    if ($app['session']->get('username')) {
        return $app->redirect('/');
    }

    return $app['twig']->render('login.tpl');
});

// Logout
$app->get('/logout', function () use ($app) {
    $app['session']->clear();
    $app['session']->getFlashBag()->add('message', 'You are now logged out.');
    
    return $app->redirect('/');
});

// Show the 'add a bookmark' form
$app->get('add', function () use ($app) {
    if (!$app['session']->get('username')) {
        return $app->redirect('/login');
    }

    return $app['twig']->render('add.tpl');
});

// Add bookmark
$app->post('add', function (Request $request) use ($app, $sync) {
    if (!$app['session']->get('username')) {
        return $app->redirect('/login');
    }

    $foo = $app['request']->request->all();

    $r = $sync->add_bookmark($foo);

    if ($r) {
        $app['session'] ->getFlashBag()->add('message', 'Bookmark successfully added');
        return $app->redirect('/');
    } else {
        $app['session'] ->getFlashBag()->add('message', 'Something went wrong. Try again.'); // TODO: Better err msg.
        return $app['twig']->render('add.tpl'); // TODO: Ensure fields are populated with previous data
    }
});

// Delete bookmark
$app->get('/delete/{id}', function (Silex\Application $app, $id) use ($sync) {
    if (!$app['session']->get('username')) {
        return $app->redirect('/login');
    }

    $r = $sync->delete_bookmark($id);

    if ($r) {
        $app['session'] ->getFlashBag()->add('message', 'Bookmark successfully deleted');
    } else {
        $app['session'] ->getFlashBag()->add('message', 'Something went wrong. Try again.'); // TODO: Better err msg
    }

    return $app->redirect('/');
});

// Edit bookmark
$app->get('/edit/{id}', function ($id) use ($app, $sync) {
    if (!$app['session']->get('username')) {
        return $app->redirect('/login');
    }

    $bookmark = new Bookmark($sync->get_bookmark($id)); // TODO: Error handling

    return $app['twig']->render('add.tpl', array('bookmark' => $bookmark));
});

// TODO: Filter bookmarks by tag(s)
$app->get('/{tag}', function ($tag) use ($app) {

});

$app->run();

?>
