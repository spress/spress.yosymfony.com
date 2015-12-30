---
layout: page-dev
title: Developers &#8250; Events list
description: Events list of Spress livecycle
header:
  title: Events list
  sub: Developers
menu:
  id: dev 1.0
  title: Events list
  order: 3
prettify: true
---
List of Spress events. All arguments are located at `Yosymfony\Spress\Plugin\Event`
namespace. All events inherits from 
[Symfony\Component\EventDispatcher\Event][Symfony dispatch event].
[Symfony dispatch event]: http://symfony.com/doc/current/components/event_dispatcher/introduction.html#creating-and-dispatching-an-event

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Event name</th>
            <th>Argument</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>spress.start</td>
            <td markdown="1">[`EnvironmentEvent`](#environmentevent)</td>
            <td>
                The spress.start is thrown when project generation begins. With this
                event you can modify the configuration repository, add converters or 
                extend Twig. When this event is thrown, the site configuration 
                was loaded.
            </td>
        </tr>
        <tr>
            <td>spress.before_convert</td>
            <td markdown="1">[`ConvertEvent`](#convertevent)</td>
            <td>
                <p>
                    The spress.before_convert is thrown before converting the content
                    of each page.
                </p>
                <p markdown="1">
                    `getContent()` method returns the original content in
                    source format.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_convert</td>
            <td markdown="1">[`ConvertEvent`](#convertevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_convert is thrown after converting the content of
                    each page.
                    **If the content doesn't have Front-matter, this event will never be
                    dispatched**.
                </p>
                <p markdown="1">
                    `getContent()` method returns the content transformed by
                    converter. In this step Twig tags are not resolved.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_convert_posts</td>
            <td markdown="1">[`AfterConvertPostsEvent`](#afterconvertpostsevent)</td>
            <td>
                The spress.after_convert_posts is thrown after converting all posts.
            </td>
        </tr>
        <tr>
            <td>spress.before_render</td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render is thrown before rendering the content of
                    each page.
                    **If the content doesn't have Front-matter this event will never be
                    dispatched**.
                </p>
                <p markdown="1">
                    `getContent()` method returns the content transformed by
                    converter. In this step Twig tags are not resolved.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_render</td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render is thrown after rendering the content of
                    each page.
                    **If the content doesn't have Front-matter this event will never be
                    dispatched**.
                </p>
                <p markdown="1">
                    `getContent()` method return the fully rendered content 
                    (layout included).
                </p>
                <p markdown="1">
                    If you need to access to the rendered content without layout
                    you can to use `page.content` from the payload.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.before_render_pagination
                <span class="label label-success">New in 1.0.1</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render_pagination is thrown before rendering the content of
                    each page of post pagination.
                    **This event won't fire unless you enable pagination of posts**.
                </p>
                <p markdown="1">
                    `getContent()` method returns the content of pagination template.
                    In this step Twig tags are not resolved.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.after_render_pagination
                <span class="label label-success">New in 1.0.1</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render_pagination is thrown after rendering the content of
                    each pagination of posts.
                    **This event won't fire unless you enable pagination of posts**.
                </p>
                <p markdown="1">
                    `getContent()` method returns the full content rendered
                    (layout included).
                </p>
                <p markdown="1">
                    If you need to access to the pagination template content rendered
                    without layout you can to use `page.content` from the payload.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.finish</td>
            <td markdown="1">[`FinishEvent`](#finishevent)</td>
            <td markdown="1">
                The spress.finish is thrown after the site was generated. All files 
                are saved in `_site` folder.
            </td>
        </tr>
    </tbody>
</table>

## EnvironmentEvent {#environmentevent}

This class lets you get the configuration repository, add converters and extend
Twig.

#### Get the configuration {#get-configuration}

You have to load configuration repository to be able to alter the configuration.
[ConfigRepository](https://github.com/yosymfony/Config-loader#repository) 
contains both site configuration and global configuration merged. 
ConfigRepository have an array access interface.

```
$subscriber->addEventListener('spress.start', 
    function(EnvironmentEvent $event)
    {
        $repository = $event->getConfigRepository();
        
        // Get url key:
        $url = $repository['url'];
        
        // Add new key (will be accessible in your template):
        $repository['description_site'] = 'Nice!!'
    });
```

#### Add new converter {#add-new-converter}

Converter can extend Spress to support new type of content.

```
$subscriber->addEventListener('spress.start', 
    function(EnvironmentEvent $event)
    {
        $repository = $event->addConverter(new MyConverter());
    });
```
[How to create a Converter?](/docs/1.0/developers/converters/).

#### Extending Twig {#extending-twig}

Twig can be extened with functions, filters and tests.
[See extending Twig](/docs/1.0/developers/extending-twig/).

{% verbatim %}
```
$subscriber->addEventListener('spress.start', 
    function(EnvironmentEvent $event)
    {
        // Template manager to render Twig templates from a string:
        $tm = $event->getTemplateManager();
        $renderHtml = $tm->render('<p>{{ name }}</p>', ['name' => 'Spress']);
    });
```
{% endverbatim %}

#### Information about paths {#path-info}

```
$subscriber->addEventListener('spress.start', 
    function(EnvironmentEvent $event)
    {
        // Get the absolute paths of the site (string):
        $v = $event->getSourceDir();
        
        // Get the absolute path of posts folder (string):
        $v = $event->getPostsDir();
        
        // Get the absolute path of generated site folder (string):
        $v = $event->getDestinationDir();
        
        // Get the absolute path of includes folder (string):
        $v = $event->getIncludesDir();
        
        // Get the absolute path of layouts folder (string):
        $v = $event->getLayoutsDir();
    });
```

## ContentEvent {#contentevent}

Some Spress events inherits from ContentEvent. This is an base event for events 
related with the content.

```
$subscriber->addEventListener('spress.before_convert', 
    function(ConvertEvent $event)
    {
        // Get the identifier of the page (string):
        $v = $event->getId();
        
        // The page is a post? (boolean):
        $v = $event->isPost();
        
        // Get the content without Front-matter (string):
        $v = $event->getContent();
        
        // Set the content of the page:
        $event->setContent('New content');
        
        // Get source relative path to the site, filename included (string):
        $v = $event->getRelativePath();
    });
```

## AfterConvertPostsEvent {#afterconvertpostsevent}

Information about converted posts - like categories and tags.

```
$subscriber->addEventListener('spress.after_convert_posts', 
    function(AfterConvertPostsEvent $event)
    {
        // Get the category list of all posts (array):
        $v = $event->getCategories();
        
        // Get the tag list of all posts (array):
        $event->getTags();
    });
```

## ConvertEvent {#convertevent}

This event extends [`ContentEvent`](#contentevent).

```
$subscriber->addEventListener('spress.before_convert', 
    function(ConvertEvent $event)
    {
        // Get the Front-matter of the page (array):
        $v = $event->getFrontmatter();
        
        // Set the Front-matter of the page:
        $event->setFrontmatter(['title' => 'My posts']);
    });
```

## RenderEvent {#renderevent}

This event extends [`ContentEvent`](#contentevent).

{% verbatim %}
```
$subscriber->addEventListener('spress.before_render', 
    function(RenderEvent $event)
    {
        // Get rendered Twig template:
        $rendered = $event->render('Hi {{ name }}', ['name' => 'Victor']);
        
        // Get the data model used in templates (array):
        $v = $event->getPayload();
        
        // Set a new data model available in templates:
        $event->setPayload(['name' => 'Victor']);
    });
```
{% endverbatim %}

In the case of *spress.before_render_pagination* and *spress.after_render_pagination* events
the RenderEvent argument points to pagination template page.

## FinishEvent {#finishevent}

Information about the processed site.

```
$subscriber->addEventListener('spress.finish', 
    function(FinishEvent $event)
    {
        // Get the results (array):
        $v = $event->getResult();
        $posts = $v['total_post'];
    });
```

The array with results contains the following information:

<table class="table">
    <thead>
        <tr>
            <th class="col-sm-2">Key</th>
            <th>Type</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>total_post</td>
            <td>int</td>
            <td>
                Number of posts found at posts directory.
            </td>
        </tr>
        <tr>
            <td>processed_post</td>
            <td>int</td>
            <td>
                Number of posts with Front-matter.
            </td>
        </tr>
        <tr>
            <td>drafts_post</td>
            <td>int</td>
            <td>
                Number of draft posts.
            </td>
        </tr>
        <tr>
            <td>total_pages</td>
            <td>int</td>
            <td>
                Number of pages found at your site.
            </td>
        </tr>
        <tr>
            <td>processed_pages</td>
            <td>int</td>
            <td>
                Number of pages with Front-matter.
            </td>
        </tr>
        <tr>
            <td>other_resources</td>
            <td>int</td>
            <td>
                Others files not processable that will be copied verbatim to the
                generated site.
            </td>
        </tr>
    </tbody>
</table>
