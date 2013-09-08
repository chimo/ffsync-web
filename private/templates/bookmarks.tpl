{% extends "base.tpl" %}

{% block content %}
<dl>
{% for bookmark in bookmarks %}
    {#- Dumb twig whitespace -#}
    <dt><a href="{{ bookmark.uri }}">{{ bookmark.title }}</a></dt>
    <dd style="overflow: hidden;">
        <dl>
        {% if bookmark.description %}
            {#- Dumb twig whitespace -#}
            <dt class="description">Description</dt>
            <dd class="description">{{ bookmark.description }}</dd>
        {% endif %}
            {#- Dumb twig whitespace -#}
            <dt class="url">URL</dt>
            <dd class="url"><a href="{{ bookmark.uri }}">{{ bookmark.uri }}</a></dd>
        {% if bookmark.tags|length > 0 %}
            {#- Dumb twig whitespace -#}
            <dt class="tags"></dt>
            {% for tag in bookmark.tags %}
            {#- Dumb twig whitespace -#}
            <dd class="tag">{{ tag }}</dd>
            {% endfor %}
            {#- Dumb twig whitespace -#}
        {% endif %}
        {#- Dumb twig whitespace -#}
        </dl>
    </dd>
{% endfor %}
{#- Dumb twig whitespace -#}
</dl>

{% endblock %}
