{% extends 'templates/default.html.twig' %}
{% block content %}
<section class="clearfix">
    <div class="header row">
        <div class="col-md-7">
            <h2 class="LastEpTitle"><i class="fa fa-pencil" aria-hidden="true"></i><br/>
                Les derniers épisodes</h2>
            <img src="images/spera.png">
        </div>
        <div class="col-md-5">
            <h2 class="RecentCom"><i class="fa fa-commenting" aria-hidden="true"></i><br/>
                Commentaires récents</h2>
            <img src="images/spera.png">
        </div>
    </div>
    <div id="ColumnLeft" class="col-md-8">

        {% for articles in articles %}
        <div id="box_episode">

            <h2>.: {{articles.id}} :. {{articles.titre}}</h2>
            <em class="sousNote"><i class="fa fa-calendar dateAjout" aria-hidden="true"></i> {{articles.dateAjout}}</em>
            <p>{{  articles.getExtrait()|raw }} </p>
        </div>
        {% endfor %}
    </div>
    <div id="Column-right" class="col-md-4">
        {% for commentaire in commentaire %}
        <div id="box_episode">
            {{ commentaire.getComment()|raw }}
        </div>

        {% endfor %}

        <div class="footer-com"></div>
    </div>
</section>
{% endblock %}
