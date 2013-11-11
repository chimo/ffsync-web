<?php
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
    // public function Bookmarks($bkms, $tag) {
    public function Bookmarks($bkms) {
        global $config;

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
    }

    public function filterByTags($tag) {
        $filtered = array();

        foreach ($this as $bookmark)  {
            if (is_array($bookmark->tags)) {
                $common = array_intersect($tag, $bookmark->tags);

                if (count($common) !== 0) {
                    array_push($filtered, $bookmark);
                }
            }
        }

        // FIXME: Should return Bookmarks object
        return $filtered;
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
        $this->keyword = $bkm->keyword;
    }
}
?>
