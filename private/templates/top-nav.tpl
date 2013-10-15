<ul class="nav">
    <li><a href="http://chimo.chromic.org/about/">about</a></li>
    <li><a href="http://chimo.chromic.org/">blog</a></li>
    <li><a href="http://sn.chromic.org/">ublog</a></li>
    <li><a href="http://media.chromic.org/">media</a></li>
    <li><a href="http://chimo.chromic.org/code/">code</a></li>
    <li><a href="http://fm.chromic.org/">fm</a></li>
    <li><a href="http://bkm.chromic.org/">bookmarks</a></li>
    {% if username %}
    <li><a href="/logout">logout</a></li>
    {% else %}
    <li><a href="/login">login</a></li>
    {% endif %}
</ul>
