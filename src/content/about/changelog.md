---
layout: page-about
title: Changelog
description: The Spress changelog
header: 
  title: Change log
  sub: Release history
menu:
  id: about
  title: Changelog
  order: 2

id_content: changelog
changelog_support: true
---
More information about the [releases](https://github.com/yosymfony/Spress/releases).

# 2.0.0-rc {#2-0-0-rc}
Date: 2015-12-07

* [New] Added MemoryDataSource, a datasource for generating dynamic content.
* [New] Support to sort items at `PaginationGenerator` with attributes `sort_by` and `sort_type. See [#61](https://github.com/spress/Spress/issues/61).
* [New] Added `getGeneratorManager` method to `EnvironmentEvent` for managing generators at plugins.
* [Improved] Improved the way of generating the classname in PluginGenerator.
* [Improved] Minor changes over output styles.
* [Improved] Improved HttpServer with support to load internal resources (used with error page). Added a new hook: `handleOnAfterRequestFunction`. Bootstrap file has been included for using with internal pages like error page.
* [Improved] Minor improvements over the Spress application output.
* [Fixed] Now, `slug` method transform dot characters into dash characters.
* [Fixed] Fixed lifecycle: render phase starts after converter phase has been finished for all items.
* [Fixed] Changed the method `remove` by `removeCollection` in CollectionManager class.
* [Fixed] `PermalinkGenerator` adds an initial slash if the permalink doesn't start with it.
* [Fixed] `MissingAttributeException` and `AttributeValueException` has been moved to `Core\ContentManager\Exception`.
* [Fixed] `ConsoleIO` passed to `spress.io` key (DI container) when `SiteBuildCommand` builds `Spress instance`.
* [Fixed] Updated `spress-installer` version to ~2.0 at `composer.json.twig`.
* [Fixed] Fixed the message of the exception threw when a previous item exists.
* [Deleted] `ConfigValueException` has been deleted.

# 2.0.0-beta {#2-0-0-beta}
Date: 2015-10-15

* [New] Added a new converter for Markdown: ParsedownConverter. This converter is based on [Parsedown by Emanuil Rusev](http://parsedown.org/). Deals with issue [#40](https://github.com/spress/Spress/issues/40).
* [New] Added command plugins: a new kind of plugins witch provides subcommand for `spress` executable. See [#56](https://github.com/spress/Spress/issues/56).
* [New] Added `self-update` command with an alias `selfupdate` for keeping Spress up to date. See [#60](https://github.com/spress/Spress/issues/60).
* [New] Taxonomy generator for grouping content around a set of terms. See [#57](https://github.com/spress/Spress/issues/57).
* [New] Modified RenderizerInterface for throwing a `Yosymfony\Spress\Core\ContentManager\Renderizer\Exception\RenderException` if an error occurred during redering the content. Method affected: `renderBlocks` and `renderPage`.
* [New] Added a new special attributte `avoid_renderizer` for avoiding the renderizer phase over an item.
* [Improved] Additional autoload only be processed if exists a `composer.json` file in the root of the site folder.
* [Fixed] The separator for tags and categories of `new:post` command has been changed from space to comma. See issue [#51](https://github.com/spress/Spress/issues/51).
* [Fixed] New template for spress plugin scaffold (`new:plugin` command) - fixed for 2.0 release. See issue [#55](https://github.com/spress/Spress/issues/55).
* [Fixed] The `setUp` method of `FilesystemDataWriter removes the whole content of the output dir but VCS files. This means that `site:build` command doesn't remove the VCS files.
* [Deleted] Deleted the `site:new` alias for command `new:site`.

# 2.0.0-alpha {#2-0-0-alpha}
Date: 2015-08-12

* [New] Data-sources: (issue [#46](https://github.com/spress/Spress/issues/46)) data sources can load site data from certain locations like filesystem or database.
* [New] Site structure (issue [#41](https://github.com/spress/Spress/issues/41)).
* [New] Data-writer (issue [#44](https://github.com/spress/Spress/issues/44)): The DataWriter's responsibility is to persist the content of the items.
* [New] Collections (issue [#43](https://github.com/spress/Spress/issues/43)): collections allow you to define a new type of document like page or post.
* [New] Generators (issue [#45](https://github.com/spress/Spress/issues/45)): Generators are used for generating new items of content.
* [New] These events `spress.before_convert`, `spress.after_convert` receive a ContentEvent as an argument.
* [New] Renderizer (issue [#48](https://github.com/spress/Spress/issues/48)): Renderizer are responsible for formatting content.
* [New] List of new events: `spress.before_render_blocks`, `spress.after_render_blocks`, `spress.before_render_page`, `spress.after_render_page`. See [#49](https://github.com/spress/Spress/issues/49).
* [New] Established PHP 5.5 as minimum version (see [#42](https://github.com/spress/Spress/issues/42)).
* [New] List of new configuration attributes: `text_extensions`, `attribute_syntax`, `preserve_path_title`, `collections`, `data_sources`.
* [Improved] Updated Symfony componentes to 2.7.
* [Improved] Updated Markdown parser (michelf/php-markdown) from Michel Fortin.
* [Improved] Updated built-in theme Spresso to 2.0.
* [Deleted] Methods `initialize` and `getSupportExtension` of ConverterInterface have been deleted.
* [Deleted] TemplateManager class of plugin API.
* [Deleted] EnviromentEvent class.
* [Deleted] List of deleted events: `spress.after_convert_posts`, `spress.before_render_pagination`, `spress.after_render_pagination `, `spress.before_render`, `spress.after_render`. See [#49](https://github.com/spress/Spress/issues/49).
* [Deleted] List of configuration attributes (config.yml) deleted because they have been marked as deprecated: `baseurl`, `paginate`, `paginate_path`, `limit_posts`, `processable_ext`, `destination`, `posts`, `includes`, `layouts`, `plugins`.

# V1.1.1 {#1-1-1}
Date: 2015-02-25

* [Improved] [Spresso theme](https://github.com/yosymfony/Spress-theme-spresso/releases/tag/v1.1.1) updated to 1.1.1.
* [Improved] Dependencies have been updated.

## V1.1.0 {#1-1-0}
Date: 2015-01-08

* [Fixed] Bug [#30](https://github.com/spress/Spress/issues/30): Adding source parameter to config appears to not do anything.
* [Improved] Support for exceptions during parsing a site with `--server` and `--watch options.
* [Improved] `config.yml` is reloaded when rebuilding the site with watch mode enabled.
* [Improved] Spresso theme updated to 1.1.
* [Improved] Symfony components updated to 2.6.

## V1.1.0-rc {#1-1-0-rc-1}
Date: 2014-12-21

* [New] variable: `server_watch_ext` at global configuration.
* [Fixed] Default value for layout at new:post command assigned to null.
* [Fixed] Fixed questions for tags and categories in new:post command.
* [Fixed] Fixed new:post help message.
* [Fixed] Added validators for command options.
* [Improved] Performance of combination --server and --watch options improved.
* [Improved] Deleted unused variables.

## V1.1.0-beta.2 {#1-1-0-beta-2}
Date: 2014-11-21

* [New] Issue [#17](https://github.com/spress/Spress/issues/17): 
[Twig debug mode](/news/2014/10/28/new-in-spress-1-1-debug-mode/) through configuration.
* [New] Two new scaffolding commands: `new:post` and `new:plugin`.
* [New] Proposal [#22](https://github.com/spress/Spress/issues/22): Namespace "new" in commands for creating stuff.
* [Deprecated] The command `site:new` has been declared deprecated and replaced by `new:site`.

## V1.1.0-beta.1 {#1-1-0-beta-1}
Date: 2014-10-19

* [New] [IO API](/news/2014/05/11/new-in-spress-1-1-io-api/) useful for interacting with the users.
* [New] Proposal [#9](https://github.com/spress/Spress/issues/9): Support for environment configuration files. New key `env` for `config.yml`.
* [New] PR [#12](https://github.com/spress/Spress/issues/12): Added ability to use multiple extensions on layouts.
* [New] Proposal [#15](https://github.com/spress/Spress/issues/15): Built-in server and watch for changes.
* [Fixed] Issue [#10](https://github.com/spress/Spress/issues/10): Classname with typo: EnviromentEvent. This class was replaced by EnvironmentEvent.
* [Fixed] PR [#14](https://github.com/spress/Spress/issues/14): Changed Frontmatter regex pattern to allow for CRLF line endings.
* [Improved] Proposal [#13](https://github.com/spress/Spress/issues/13): Split Spress into Spress Core and its ecosystem.
* [Improved] Replaces all uses of deprecated method mergeWith from ConfigServiceProvider by union method.
* [Improved] Proposal [#11](https://github.com/spress/Spress/issues/11): Improve the plugins manager for writing plugins more easily.
* [Improved] Decoupled options for Plugin Manager.
* [Improved] PSR-4 for classloader.
* [Improved] Symfony components >= 2.4 and < 3 in `composer.json`.
* [Improved] The default value for `url` key at global configuration is empty-string.
* [Improved] Documentation fixes.
* [Deprecated] The configuration options: `baseurl` and `relative_permalinks` has been declared  deprecated.

## v1.0.3 {#1-0-3}
Date: 2014-05-22

* [Fixed] bug [#7](https://github.com/yosymfony/Spress/issues/7): Error with Site Build.
* [Improved] Tested on PHP 5.6 (Travis CI).

## v1.0.2 {#1-0-2}
Date: 2014-03-30

* [Fixed] bug [#6](https://github.com/yosymfony/Spress/issues/6): Twig tags not rendered in posts located at variable `site.posts`.
* [Fixed] bug [#6](https://github.com/yosymfony/Spress/issues/6) with variables `site.categories` and `site.tags`.
* [Improved] Variables site.categories and site.tags have page-identifier as index of array.
* [Improved] Base implementation of ContentItemInterface created at ContentItem. The classes PageItem and PostItem extend from this.

## v1.0.1 {#1-0-1}
Date: 2014-03-08

* [New] events related with pagination phase (issue [#3](https://github.com/yosymfony/Spress/issues/3)): **spress.before_render_pagination** and **spress.after_render_pagination**.
* [Improved] Payload argument of Render method (plugins TemplateManager) is optional.
* [Improved] pagination phase of posts.
* [Fixed] bug [#4](https://github.com/yosymfony/Spress/issues/4): UrlGenerator always has ending slash.
* [Fixed] the class loader path when Spress is installed as package.

## v1.0.0
Date: 2014-02-05

* [New] Added template manager to the API plugins for rendering Twig templates (accessible from spress.start event).
* [Improved] the class loader of the site plugins.
* [Fixed] documentation

## v1.0.0-rc.3
Date: 2014-01-12

* [New] Support to [Composer](https://getcomposer.org/) for spress site plugins.
* [New] Install themes with Composer.
* [New] Generate composer.json in a blank site.
* [Improved] the search of folders that starting with underscore.
* [Fixed] the documentation.
* [Deleted] Spresso theme. Now is a package.
