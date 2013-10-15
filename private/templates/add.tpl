{% extends "base.tpl" %}

{% block content %}
    <form class="login" method="post" action="/add">
        <label>URL:</label>
        <input type="text" name="bmkUri" />

        <label>Title:</label>
        <input type="text" name="title" />

        <label>Description:</label>
        <textarea name="description"></textarea>

        <label>Tags:</label>
        <input type="text" name="tags" />

        <label>Keyword:</label>
        <input type= "text" name="keyword" />

        <input type="submit" />
    </form>
{% endblock %}
