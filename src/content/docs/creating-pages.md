---
layout: page-doc
title: Creating pages
header:
  title: Creating pages
menu:
  id: doc 1.0
  title: Creating pages
  order: 7
prettify: true
---
With the below example, you can see various type of pages:

```
.
|- index.html      # http://yoursite.com/
|- docs-site
| |- index.html    # http://yoursite.com/docs-site
|- about
| |- index.md      # http://yoursite.com/about
| |- app-list.html # http://yoursite.com/about/app-list.html
|- my-news.html    # http://yoursite.com/my-news.html
```

The `index.html` file in your site root, by convection, is your homepage unless
your server was configured to look other default filename.

Pages with [friendly-URL](http://en.wikipedia.org/wiki/Clean_URL) (clean URL) 
can be created with a directory name that represent your frienly-URL and create 
a `index.html` page inside with the content. `docs-site` and `about` are 
examples of this type of URLs.