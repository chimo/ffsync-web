{% extends "base.tpl" %}

{% block content %}

<dl>
{% for bookmark in bookmarks %}
    <dt><a href="{{ bookmark.uri }}">{{ bookmark.title }}</a></dt>
    <dd style="overflow: hidden;">
        <dl>
        {% if bookmark.description %}
            <dt class="description">Description</dt>
            <dd class="description">
                {{ bookmark.description }}
            </dd>
        {% endif %}
            <dt class="url">URL</dt>
            <dd class="url"><a href="{{ bookmark.uri }}">{{ bookmark.uri }}</a></dd>
        {% if bookmark.tags|length > 0 %}
            <dt class="tags"></dt>
            {% for tag in bookmark.tags %}
            <dd class="tag"><a href="?tag={{ tag|url_encode }}">{{ tag }}</a></dd>
            {% endfor %}
        {% endif %}
        </dl>
        {% if username %}
        <ul style="clear: both;"><li><a href="/delete/{{ bookmark.id }}">delete</a></li></ul>
        {% endif %}
    </dd>
{% endfor %}
</dl>

{% endblock %}
