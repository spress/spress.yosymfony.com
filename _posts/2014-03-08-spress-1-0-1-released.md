---
layout: blog/post
title: Spress 1.0.1 released
description: Second release of 1.0 branch with two fixed bug and new events related with posts pagination
categories: [releases]
tags: ['1.0']
---
After a month since the first stable version of Spress, [v1.0.1](<{{ site.url }}/about/changelog/#1-0-1>) 
is available with two minor fixed bugs and two new events related 
with the posts pagination: `spress.before_render_pagination` and 
`spress.after_render_pagination`. This events allow you to take
the control of what happen both before and after of render each
pagination template. The events receive an [RenderEvent](<{{ site.url }}/docs/developers/events-list/#renderevent>)
object as an argument each. An example of how to iterate over the posts of the current page:

--more Read more--

```
public function onBeforeRenderPagination(RenderEvent $event)
{
    $payload = $event->getPayload();
    
    foreach($payload['paginator']['posts'] as $index => $postPage)
    {
        if(preg_match($this->patternsHtml, $postPage['content'], $matches))
        {
            // Do something
            
            // ...
            
            // save your changes
            $event->setPayload($payload);
        }
    }
}
```

### How to update?

**Using Composer:**

```
$ cd /your-spress-folder
$ php composer.phar update
```

**From ZIP file:**
you can get the a ZIP file from [Spress download page](<{{ site.url }}/download>).