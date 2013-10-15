<?php
require_once 'lib/Twig/Autoloader.php';

/**
 * A collection of Bookmark objects
 *
 * It currently also takes care of printing the HTML
 *
 * @see Bookmark
 */
class Bookmarks extends ArrayObject {
    /**
     *  Creates a collection of Bookmark objects from Mozilla Bookmarks
     *
     *  @param Array $bkms Array of Mozilla Bookmarks
     */

    public function Bookmarks($bkms) {
        global $config;

        $bkms = array_reverse($bkms); // Most recent first

        if (count($config['include']) > 0) {
            foreach ($bkms as $bkm) {
                if ($bkm->type === 'bookmark' && count(array_intersect($bkm->tags, $config['include'])) > 0 && count(array_intersect($bkm->tags, $config['exclude'])) === 0) {
                    $this->append(new Bookmark($bkm));
                }
            }
        } else {
            foreach ($bkms as $bkm) {
                if ($bkm->type === 'bookmark' && count(array_intersect($bkm->tags, $config['exclude'])) === 0) {
                    $this->append(new Bookmark($bkm));
                }
            }
        }

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem('../private/templates');

        $twig = new Twig_Environment($loader, array(
            'cache' => '../private/templates/cache'
        ));

        $this->template = $twig->loadTemplate('bookmarks.tpl');
    }

    /**
     * Prints Bookmarks HTML
     */
    public function html() {
        echo $this->template->render(array(
                'bookmarks' => $this
            )
        );
    }
}

/**
 * Represents a 'Bookmark' object
 *
 * It's currently pretty much the same as the Mozilla object.
 * We may add additional things to it later
 *
 * @link http://docs.services.mozilla.com/sync/objectformats.html#bookmarks Mozilla's Bookmark Object Format
 */
class Bookmark {

    public function Bookmark($bkm) {
        $this->uri = $bkm->bmkUri;
        $this->title = $bkm->title;
        $this->id = $bkm->id;
        $this->tags = $bkm->tags;
        $this->description = $bkm->description;
    }
}
?>