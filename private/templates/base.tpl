<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        <link rel="stylesheet" href="/css/styles.css" />
        <title>{% block title %}Chimo's Bookmarks{% endblock %}</title>
        {% endblock %}
    </head>
    <body>
        <h1>Chimo's Bookmarks</h1>

        {% include 'top-nav.tpl' %}
        <div id="content">
            {% for message in app.session.getFlashBag.get('message') %}
                <div class="flash-message">
                {{ message }}
                </div>
            {% endfor %}

            {% block content %}{% endblock %}
        </div>
        <div id="footer">
            Powered by <a href="http://docs.services.mozilla.com/howtos/run-sync.html">Firefox Sync Server</a> and <a href="https://github.com/chimo/ffsync-web">ffsync-web</a>
        </div>
    </body>
</html>
