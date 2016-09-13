# Granule - A WordPress Starter Theme.

It's the code I use to start all of my [Pro Theme Design](https://prothemedesign.com) themes.

The theme was initially based on Darren Hoyts Gravy theme, but has evolved over many years of developing themes for wordpress.com. It now takes inspiration from [_s](https://github.com/automattic/_s) as being a simple theme to use as a starting point for creating new themes.

Things to note:

* It is not a theme framework or a parent theme.
* The theme code does not care about backwards compatibility. There's no need since the theme is not a parent theme.
* The code always supports the latest version of WordPress.
* [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/) should be followed. I do this locally using [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer).
* Docblocks are used extensively so that I can generate code documentation. This is a relatively recent addition and something I am iterating on.

## Example Themes

Below is a selection of the recent themes that Granule was used to create:

* [Carmack](https://prothemedesign.com/theme/carmack/)
* [Romero](https://prothemedesign.com/theme/romero/)
* [Passenger](https://prothemedesign.com/theme/passenger/)
* [Monet](https://prothemedesign.com/theme/monet/)

## Features

* Supports most major WordPress functionality (Custom header, Site Logo etc)
* Supports most Jetpack functionality (Featured Content, Infinite Scroll, Portfolios, Social Menus - and more) - see [jetpack.php for more](https://github.com/BinaryMoon/granule/blob/master/granule/inc/jetpack.php).
* Follows the [wordpress.com theme developer guidelines](https://developer.wordpress.com/themes/).
* Pure CSS dropdown menu (with a smattering of js for compatability).
* SVG Icons
* SASS styles
* Boilerplate Customizer code

## Using Granule

To use the theme as a starter theme I recommend checking out all of the files and then placing both the __sass and granule directories into your wp-content/themes folder. You can then either hack away on granule, or create a copy of the granule folder and use that to create your themes. Either way you will need to do a case sensitive search and replace on all instances of the name granule.

### About the __sass Directory

The __sass directory is used as a global library for setting website and WordPress default properties. I use the same library in all Pro Theme Design themes (older themes use something similar made in LESS). I keep the SASS library out of the theme so that themes can share the same code (DRY) and I can edit the library and update all themes at once.

Many of the library properties are stored in variables in the __sass/lib/variables directory. These can be overriden in the granule/assets/sass/lib/_variables.scss

## License

GPL2
