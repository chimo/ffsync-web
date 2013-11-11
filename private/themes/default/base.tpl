<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        <link rel="stylesheet" href="/css/styles.css" />
        <title>{% block title %}ffsync-web{% endblock %}</title>
        {% endblock %}
    </head>
    <body>
        <header>
            <h1><a href="/">ffsync-web</a></h1>

            {% include 'top-nav.tpl' %}
        </header>
        <main>
            <div id="content">
                {% for message in app.session.getFlashBag.get('message') %}
                    <div class="flash-message">
                    {{ message }}
                    </div>
                {% endfor %}

                {% block content %}{% endblock %}
            </div>
        </main>
        <footer>
            <div id="footer">
                Powered by <a href="http://docs.services.mozilla.com/howtos/run-sync.html">Firefox Sync Server</a> and <a href="https://github.com/chimo/ffsync-web">ffsync-web</a>
            </div>
        </footer>
    </body>
</html>
