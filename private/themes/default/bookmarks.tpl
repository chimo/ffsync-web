{% extends "base.tpl" %}

{% block content %}

<dl>
{% for bookmark in bookmarks %}
    <dt class="title"><a href="{{ bookmark.uri }}">{{ bookmark.title }}</a></dt>
    <dd style="overflow: hidden;" class="details">
        <dl>
        {% if bookmark.description %}
            <dt class="description">Description</dt>
            <dd class="description">
                {{ bookmark.description }}
            </dd>
        {% endif %}
            <dt class="url">URL</dt>
            <dd class="url"><a href="{{ bookmark.uri }}">{{ bookmark.uri }}</a></dd>
        {% if bookmark.keyword %}
            <dt class="keyword"></dt>
            <dd class="keyword">{{ bookmark.keyword }}</dd>
        {% endif %}
        {% if bookmark.tags|length > 0 %}
            <dt class="tags"></dt>
            {% for tag in bookmark.tags %}
            <dd class="tag"><a href="?tag={{ tag|url_encode }}">{{ tag }}</a></dd>
            {% endfor %}
        {% endif %}
        </dl>
        {% if app.session.get('username') %}
        <ul class="actions">
            <li>
                <a class="share" href="/share/{{ bookmark.id }}">share</a>
            </li>
            <li>
                <a class="edit" href="/edit/{{ bookmark.id }}">edit</a>
            </li>
            <li>
                <a class="delete" href="/delete/{{ bookmark.id }}">delete</a>
            </li>
        </ul>
        {% endif %}
    </dd>
{% endfor %}
</dl>

{% endblock %}
