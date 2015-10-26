---
layout: page-dev
title: Developers &#8250; Events list
header: { title: Developers, sub: Events list }
description: Events list of Spress livecycle
prettify: true
---
List of Spress events. Even's arguments are located at `Yosymfony\Spress\Core\Plugin\Event`
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
                The spress.start is thrown when start to generate a project. With this
                event you can:

                <ul>
                    <li>modify the configuration values.</li>
                    <li>add data sources.</li>
                    <li>change the data writer.</li>
                    <li>add converters.</li>
                    <li>extend Twig (default renderizer).</li>
                    <li>get an access to IO API.</li>
                </ul>

                When this event is thrown, the configuration of site was loaded.
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
            <td>
                spress.before_render_blocks
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render_blocks is thrown before render content
                    without layouts.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.after_render_blocks
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render_blocks is thrown after render content
                    without layouts.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.before_render_page
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.before_render_page is thrown before render with
                    layouts.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                spress.after_render_page
                <span class="label label-success">New in 2.0.0</span>
            </td>
            <td markdown="1">[`RenderEvent`](#renderevent)</td>
            <td>
                <p markdown="1">
                    The spress.after_render_page is thrown after render content
                    with layouts.
                </p>
            </td>
        </tr>
        <tr>
            <td>spress.finish</td>
            <td markdown="1">[`FinishEvent`](#finishevent)</td>
            <td markdown="1">
                The spress.finish is thrown when the site was generated. All files 
                are saved in `builder` folder.
            </td>
        </tr>
    </tbody>
</table>

## EnvironmentEvent {#environmentevent}

This class lets you:

<ul>
    <li>modify the configuration values.</li>
    <li>add data sources.</li>
    <li>change the data writer.</li>
    <li>add converters.</li>
    <li>extend Twig (default renderizer).</li>
    <li>get an access to IO API.</li>
</ul>

#### Modifying condiguration values

If you want to alter site's configuration you neew to get the configuration values
using `getConfigValues` method (returns an array). The method `setConfigValues`
lets you save your changes:

<script src="https://gist.github.com/yosymfony/253512c1446696375d06.js"></script>

#### Adds new converter {#adds-new-converter}

Converter can extend Spress to support a new markup language.

<script src="https://gist.github.com/yosymfony/b8dad1fd5563bb99da3f.js"></script>

More details about [how to create a Converter](/docs/2.0/developers/converters/).

#### Extending Twig {#extending-twig}

Twig can be extened with functions, filters and tests.
[See extending Twig](/docs/2.0/developers/extending-twig/).

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

#### Informations about paths {#path-info}

```
$subscriber->addEventListener('spress.start', 
    function(EnvironmentEvent $event)
    {
        // Get the absolute path of the site (string):
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

## ConvertEvent {#convertevent}

This event extends from [`ContentEvent`](#contentevent).

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

This event extends from [`ContentEvent`](#contentevent).

{% verbatim %}
```
$subscriber->addEventListener('spress.before_render_blocks', 
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

### BeforeRenderBlocks {#before-render-blocks}

### AfterRenderBlocks {#after-render-blocks}

### BeforeRenderPage {#before-render-page}

### AfterRenderPage {#after-render-page}

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

The array with results contains following information:

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
                Number of pages found in your site.
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
