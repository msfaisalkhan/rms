## Installation
There are two ways to install RawPHP:

* The first way, (recommended) is to use [Composer](https://getcomposer.org/) to install RawPHP.
Navigate to the folder in your computer where you wish to install RawPHP, then run the below code in your command line
```
$ composer create-project --prefer-dist partner/rawphp
```

* The second way (only use this if the first method doesn't work for you) is to clone `https://github.com/rawphp-framework/rawphp.git` into your local machine, then CD into it and run `composer install` in your command line. If you don't have composer already installed in your system, do download and installed  [Composer](https://getcomposer.org/) . 


## Usage

There are two ways to run 

### Running your app
After RawPHP has installed, you can run it by using the built-in PHP server. Navigate to the root folder and run the below command:
```
$ php -S localhost:8000 -t public

```
Going to http://localhost:8000/ will now display your default Homepage.

### Wamp, LAMP or XAMP server
Otherwise, you can just put it in your wamp/www or xxamp htdocs folder and access it by visiting the url on your browser `localhost/your-rawphp-folder/public`
## License

The RawPHP Framework is licensed under the MIT license. See [License File](LICENSE.md) for more information.
