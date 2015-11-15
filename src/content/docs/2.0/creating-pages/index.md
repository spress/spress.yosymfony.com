---
layout: page-doc-2.0
title: Creating pages
header: { title: Creating pages   }
prettify: true
---
Below, you can see various types of pages:

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

The `index.html` file in your site root, by convention, is your home page, unless
your server was configured to look for other default file (this is a web server configuration,
not Spress config variable).

Pages with [friendly-URLs](http://en.wikipedia.org/wiki/Clean_URL) (clean URL) 
can be created by following a following pattern:

1. create a directory with a name that represents your friendly-URL
2. add `index.html` file inside with the page content

In the above example `docs-site` and `about` are following this pattern
to get this type of URLs.
