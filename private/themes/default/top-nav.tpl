<nav>
    <ul class="nav">
        {% if app.session.get('username') %}
        <li><a href="/logout">logout</a></li>
        {% else %}
        <li><a href="/login">login</a></li>
        {% endif %}
    </ul>
</nav>
