## Spress web page

This is the git repo of Spress site: <http://spress.yosymfony.com>

## How to build?

This site requires Spress >= 2.2:

```bash
$ git clone https://github.com/yosymfony/Spress.yosymfony.com.git

$ cd Spress.yosymfony.com/

# Get plugins
$ spress.phar update:plugin

# Build the site
$ spress.phar site:build --server --watch
```
