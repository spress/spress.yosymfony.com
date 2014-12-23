---
layout: page-about
title: A PHP Static site generator
header: { title: About, sub: Spress  }
---
<p class="lead">Spress is a blog-aware application that transform your plain 
text files in static sites.</p>
The generated site doesn't require
a database engine, only need a web server. The pages can be 
written in Markdown, Twig or plain HTML. The posts can be
paginated and uses custom permalinks.

<p class="lead" markdown="1">
Spress can be extended with [plugins and amazing themes](<{{site.url}}/add-ons/>) that
let you write a site in a few minutes.
</p>

### The advantage of using Spress:

* 100% scalable.
* Easy deploy to your server.
* Low cost hosting.
* Easy maintenance.

### Spress is powered by open source

Spress is [open source](<{{ site.author.github }}>) and is powered by it. Spress using great components like
[Silex](http://silex.sensiolabs.org/), or [Twig](http://twig.sensiolabs.org/) and at last but not least PHP.

### Meet the contributors

<div class="row">
	<div class="col-md-6">
		<ul class="list-group">
		{% for contributor in site.github.contributors %}
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-2">
						<img src="{{contributor.avatar_url}}" width="50" alt="{{contributor.login}}">
					</div>
					<div class="col-md-8">
						<p><a href="{{contributor.html_url}}">{{ contributor.login }}</a></p>
						<p>Contributions: {{ contributor.contributions }}</p>
					</div>
				</div>
			</li>
		{% endfor %}
		</ul>
	</div>
</div>