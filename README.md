## Spress web page

This is the git repo of Spress site: <http://spress.yosymfony.com>

## How to build?

This site require Spress 2.0:

```bash
$ git clone https://github.com/yosymfony/Spress.yosymfony.com.git

$ cd Spress.yosymfony.com/

# Get plugins
$ composer.phar update

# Build with Spress
$ spress.phar site:build --server --watch

```
