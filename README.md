# AntiplagiatTextChecker

---

Antiplagiat text checker allows you to check your text for plagiarism.
You can use several drivers (every driver required env settings):
1. text.ru
* TEXT_RU_API_KEY=
* TEXT_RU_URL=http://api.text.ru/post
* TEXT_RU_TIMEOUT=10 /* text.ru check text with delay */
2. copyscape.com
* COPYSCAPE_API_KEY=
* COPYSCAPE_URL=https://www.copyscape.com/api/
* COPYSCAPE_USERNAME=
3. content-watch.ru
* CONTENT_WATCH_URL=https://content-watch.ru/public/api/
* CONTENT_WATCH_API_KEY=

## Installation

### Composer

Execute the following command to get the latest version of the package:

```terminal
composer require vyalovalexander/antiplagiat-text-checker
```

## Usage

```php
    require 'vendor/autoload.php';
    use VyalovAlexander\AntiplagiatTextChecker\Checker;
    
    // Loading enviroment variables
    $dotenv = new Dotenv\Dotenv(Path/to/your/.env/file);
    $dotenv->load();
    
    $checker->addDriver('ContentWatch', \VyalovAlexander\AntiplagiatTextChecker\Drivers\ContentWatch\Driver::class)
        ->addDriver('Copyscape', \VyalovAlexander\AntiplagiatTextChecker\Drivers\Copyscape\Driver::class)
        ->addDriver('TextRU', \VyalovAlexander\AntiplagiatTextChecker\Drivers\TextRU\Driver::class);
    
    $result = $checker->useDriver('ContentWatch')->check('Your text for check');
    
    echo $result->getResult(); // uniqueness rate
    echo $result->getError(); // if !$result->isSuccess() show error

    
```  
## Adding your own driver

To add new driver you have to:

1. Create Driver class which should implements DriverInterface or extends AbstractDriver
2. Your driver must return ResultParserInterface or ResultParser
3. After that you can use $checker->addDriver('YouDriverName', 'YourDriver::class')

## License

The ImageDefender library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
