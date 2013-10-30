{% extends "base.tpl" %}

{% block content %}
    <form class="login" method="post" action="/add">
        <label>URL:</label>
        <input type="text" name="bmkUri" {% if bookmark.uri is defined %}value="{{ bookmark.uri  }}" {% endif %} />

        <label>Title:</label>
        <input type="text" name="title" {% if bookmark.title is defined %} value="{{ bookmark.title }}" {% endif %} />

        <label>Description:</label>
        <textarea name="description">{% if bookmark.description is defined %}{{ bookmark.description }}{% endif %}</textarea>

        <label>Tags:</label>
        <input type="text" name="tags" {% if bookmark.tags is defined %} value="{% for tag in bookmark.tags %}{{ tag|join(',') }} {% endfor %}" {% endif %} />

        <label>Keyword:</label>
        <input type= "text" name="keyword" {% if bookmark.keyword is defined %} value="{{ bookmark.keyword }}" {% endif %} />

        {% if bookmark.id is defined %}
        <input type="hidden" name="id" value="{{ bookmark.id }}" />
        {% endif %}

        <input type="submit" />
    </form>
{% endblock %}
