{% extends "base.tpl" %}

{% block content %}
    <form class="login" method="post" action="/login">
        <label>Username:</label>
        <input type="text" name="username" />

        <label>Password:</label>
        <input type="password" name="password" />

        <input type="submit" />
    </form>
{% endblock %}
