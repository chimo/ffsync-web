<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        <link rel="stylesheet" href="css/styles.css" />
        <title>{% block title %}Chimo's Bookmarks{% endblock %}</title>
        {% endblock %}
    </head>
    <body>
        <h1>Chimo's Bookmarks</h1>

        {% include 'top-nav.tpl' %}
        <div id="content">
            {% block content %}{% endblock %}
        </div>
    </body>
</html>
