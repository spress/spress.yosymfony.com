---
layout: page-doc
title: Pagination
header: { title: Pagination }
prettify: true
---
The posts can be organized in pages and will be access
with URLs like `http://yourdomain.com/blog/page2/`. Each page will display a set
of posts.

To **enable posts pagination** add a new line to your site configuration file:

```
# config.yml

paginate: 5
```

The value is the number of posts per page. You may also specify the location of
the pages. Add a new line to your site configuration file:

```
paginate_path: 'blog/page:num'
```

The above code will generate each page with a URL like `http://yourdomain/blog/page2/`. 
The `:num` placeholder will be replaced with the number of page starting with 2. 
To access to page one, use `http://yourdomain.com/blog/`.

Files generated:

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Page</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>/blog/index.html</td>
        </tr>
        <tr>
            <td>2</td>
            <td>/blog/page2/index.html</td>
        </tr>
        <tr>
            <td>n</td>
            <td markdown="1">/blog/page**n**/index.html</td>
        </tr>
    </tbody>
</table>

<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
        <div class="col-md-1">
            <i class="fa fa-exclamation-triangle fa-3x color-red"></i>
        </div>
        <div class="col-md-11">
            <p markdown="1">
                Pagination only work with posts.
            </p>
        </div>
    </div>
  </div>
</div>

## Page template
Determine the content of each pagination page. This file should be located at 
the root of `paginate_path` and its filename should be `index.html`.

Example of page template (file located at `/blog/index.html`):

{% verbatim %}
```
---
layout: default
---
{% if paginator %}
    {% for post in paginator.posts %}
        <!--
            Render your post data.
            The best way is to use "include" statement
        -->
    {% endfor %}
    
    {% if paginator.total_pages > 1 %}
    	<ul class="pagination">
    		{% if paginator.previous_page %}
            <li>
                <a class="prev" href="/{%if paginator.previous_page > 1 %}page{{ paginator.previous_page }}/{% endif %}">
                    &laquo; Newer
                </a>
            </li>
    		{% endif %}
    
    		{% for page in (1..paginator.total_pages) %}
    			{% if page == paginator.page %}
    				<li>
    				    <span class="active">{{ page }}</span>
    				</li>
    			{% else %}
    				<li>
    				    <a href="/{%if page > 1 %}page{{ page }}/{% endif %}">
    				        {{ page }}
    				    </a>
    				</li>
    			{% endif %}
    		{% endfor %}
    
    		{% if paginator.next_page %}
    			<li>
    			    <a href="/page{{ paginator.next_page }}/">
    			        Older &raquo;
    			    </a>
    			</li>
    		{% endif %}
    	</ul>
    {% endif %}
{% else %}
    <p>No post has been written.</p>
{% endif %}
```
{% endverbatim %}
More about [paginator variables](/docs/variables/#paginator-variables).