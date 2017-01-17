# xbxcj
### Installation
You can directly download this from github.
     OR
can install it using composer by:

    $ composer require xbxcj/vdo=dev-master

### Quick Start and Examples
For getting url for streaming in json format:
Create a php file in the root directory of project

```php
require __DIR__ . '/vendor/autoload.php';
use \Xbxcj\vdo;
$vdo = new vdo;
$drive_link = 'https://drive.google.com/open?id=0B9MrTPFsRfUgUDBKdTg5Y0taQ3M';
$vdo->getLink($drive_link);
echo $vdo->getSources();
```

Working example [here](https://github.com/vk1994/xbxcj/blob/master/test.php).
