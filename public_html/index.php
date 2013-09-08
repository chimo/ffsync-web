<?php
require_once('../private/config.php');
require_once('../private/lib/firefox-sync-client-php/sync.php');
require_once('../private/ffobjects.php');

$sync = new Firefox_Sync($config['username'], $config['password'], $config['sync_key'], $config['url_base']);
$records = $sync->collection_full('bookmarks'); // TODO: Error handling

//    $data = $sync->delete_item('bookmarks', 'vBUhSNLTvcjh');
// print_r($data);

$bookmarks = new Bookmarks($records);
$bookmarks->html();

?>
