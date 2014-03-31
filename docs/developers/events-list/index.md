---
layout: page-dev
title: Developers &#8250; Events list
header: { title: Developers, sub: Events list }
description: Events list of Spress livecycle
prettify: true
---
List of Spress events. All argument are located at `Yosymfony\Spress\Plugin\Event`
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
            <td markdown="1">[`EnviromentEvent`](#enviromentevent)</td>
            <td>
                The spress.start is thrown when start to generate a project. With this
                event you can modify the configuration repository, add converters or 
                extends Twig. When this event is thrown, the configuration site
                was loaded.
            </td>
        </tr>
        <tr>
            <td>spress.before_convert</td>
            <td markdown="1">[`ConvertEvent`](#convertevent)</td>
            <td>
                <p>
                    The spress.before_convert is thrown before convert the content
                    of each page.
                </p>
                <p markdown="1">
                    `getContent()` method return the original content in
                    source format.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_convert</td>
            <td markdown="1">[`ConvertEvent`](#convertevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_convert is thrown after convert the content of
                    each page.
                    **If the content don't have Front-matter this event never be
                    dispatcher**.
                </p>
                <p markdown="1">
                    `getContent()` method return the content transformed by
                    converter. In this step Twig tags are not resolved.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_convert_posts</td>
            <td markdown="1">[`AfterConvertPostsEvent`](#afterconvertpostsevent)</td>
            <td>
                The spress.after_convert_posts is thrown after convert all posts.
            </td>
        </tr>
        <tr>
            <td>spress.before_render</td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render is thrown before render the content of
                    each page.
                    **If the content don't have Front-matter this event never be
                    dispatcher**.
                </p>
                <p markdown="1">
                    `getContent()` method return the content transformed by
                    converter. In this step Twig tags are not resolved.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.after_render</td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render is thrown after render the content of
                    each page.
                    **If the content don't have Front-matter this event never be
                    dispatcher**.
                </p>
                <p markdown="1">
                    `getContent()` method return the full content rendered
                    (layout included).
                </p>
                <p markdown="1">
                    If you need to access to the content rendered without layout
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
                    The spress.before_render_pagination is thrown before render the content of
                    each pagination of posts.
                    **This event require to enable pagination of posts**.
                </p>
                <p markdown="1">
                    `getContent()` method return the content of pagination template.
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
                    The spress.after_render_pagination is thrown after render the content of
                    each pagination of posts.
                    **This event require to enable pagination of posts**.
                </p>
                <p markdown="1">
                    `getContent()` method return the full content rendered
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
                The spress.finish is thrown when the site was generated. All files 
                are saved in `_site` folder.
            </td>
        </tr>
    </tbody>
</table>

## EnviromentEvent {#enviromentevent}

This class let you get the configuration repository, add converters and extend
Twig.

#### Get the configuration

Alter the configuration require get the configuration repository.
[ConfigRepository](https://github.com/yosymfony/ConfigServiceProvider#repository) 
contain both site configuration and global configuration merged. 
ConfigRepository have a access array interface.

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $repository = $event->getConfigRepository();
        
        // Get url key:
        $url = $repository['url'];
        
        // Add new key (will be accessible in your template):
        $repository['description_site'] = 'Nice!!'
    });
```

#### Add new converter {#add-new-converter}

Converter can to extend Spress to support new type of content.

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        $repository = $event->addConverter(new MyConverter());
    });
```
[How to create a Converter?](/docs/developers/converters/).

#### Extending Twig

Twig can be exteded with functions, filters and tests.
[See extending Twig](/docs/developers/extending-twig/).

{% verbatim %}
```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        // Template manager to render Twig templates from a string:
        $tm = $event->getTemplateManager();
        $renderHtml = $tm->render('<p>{{ name }}</p>', ['name' => 'Spress']);
    });
```
{% endverbatim %}

#### Informations about paths

```
$subscriber->addEventListener('spress.start', 
    function(EnviromentEvent $event)
    {
        // Get the absolute paths of the site (string):
        $v = $event->getSourceDir();
        
        // Get the absolute paths of posts folder (string):
        $v = $event->getPostsDir();
        
        // Get the absolute paths of generated site folder (string):
        $v = $event->getDestinationDir();
        
        // Get the absolute paths of includes folder (string):
        $v = $event->getIncludesDir();
        
        // Get the absolute paths of layouts folder (string):
        $v = $event->getLayoutsDir();
    });
```

## ContentEvent {#contentevent}

Some Spress events inherit from ContentEvent. This is a event base for events 
related with the content.

```
$subscriber->addEventListener('spress.before_convert', 
    function(ConvertEvent $event)
    {
        // Get the identifier of the page (string):
        $v = $event->getId();
        
        // The page is a posts? (boolean):
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

Information about posts converted like categories and tags.

```
$subscriber->addEventListener('spress.after_convert_posts', 
    function(AfterConvertPostsEvent $event)
    {
        // Get the categories list of all posts (array):
        $v = $event->getCategories();
        
        // Get the tags list of all posts (array):
        $event->getTags();
    });
```

## ConvertEvent {#convertevent}

This event extend from [`ContentEvent`](#contentevent).

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

This event extend from [`ContentEvent`](#contentevent).

{% verbatim %}
```
$subscriber->addEventListener('spress.before_convert', 
    function(RenderEvent $event)
    {
        // Get Twig template rendered:
        $rendered = $event->render('Hi {{ name }}', ['name' => 'Victor']);
        
        // Get the data model used in templates (array):
        $v = $event->getPayload();
        
        // Set a new data model available in templates:
        $event->setPayload(['name' => 'Victor']);
    });
```
{% endverbatim %}

In the case of *spress.before_render_pagination* and *spress.after_render_pagination* events
the RenderEvent argument point to pagination template page.

## FinishEvent {#finishevent}

Information about the site processed.

```
$subscriber->addEventListener('spress.finish', 
    function(FinishEvent $event)
    {
        // Get the results (array):
        $v = $event->getResult();
        $posts = $v['total_post'];
    });
```

The array with results contain the next information:

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
                Others files not procesable that will be copied verbatim to the
                generated site.
            </td>
        </tr>
    </tbody>
</table>