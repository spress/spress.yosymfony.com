## Spress web page

This is the git repo of Spress site: <http://spress.yosymfony.com>

**How to build?**
This site require Spress 2.0:

```bash
$ curl -LOS https://github.com/spress/Spress/releases/download/v2.0.0-beta/spress.phar
```

Building the site:

```bash
$ git clone https://github.com/yosymfony/Spress.yosymfony.com.git

$ cd Spress.yosymfony.com/

# Get plugins
$ composer.phar update

# Build with Spress
$ spress.phar site:build --server --watch

```
