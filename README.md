# Granule - A WordPress Starter Theme.

It's the code I use to start all of my [Pro Theme Design](https://prothemedesign.com) themes.

The theme was initially based on Darren Hoyts Gravy theme, but has evolved over many years of developing themes for wordpress.com. It now takes inspiration from [_s](https://github.com/automattic/_s) as being a simple theme to use as a starting point for creating new themes.

Things to note:

* It is not a theme framework or a parent theme.
* The theme code does not care about backwards compatibility. There's no need since the theme is not a parent theme.
* The code always supports the latest version of WordPress, bckwards compatability is not considered.
* [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/) should be followed. I do this locally using [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer), with the [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards).
* Docblocks are used extensively so that I can generate code documentation. This is a relatively recent addition and something I am iterating on.
* Accessibility is baked in (following the [WordPress.org standards](https://make.wordpress.org/themes/handbook/review/accessibility/)). However I am sure it's not perfect and is something I am keen to improve.

## Example Themes

Below is a selection of the recent themes that Granule was used to create:

* [Label](https://prothemedesign.com/theme/label/)
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

### About the __sass Framework

Granule usese an external SASS library. This means the SASS is easily reusable - however it's entirely optional. If you don't want to use it then you can use your normal library/ process. This is the joy of using a starter theme.

If you want to use the Granule SASS library then I recommend the following process:

* Grab the [Granule SASS library](https://github.com/binarymoon/__sass)
* Place the Granule SASS library in the 'themes' directory (Granule theme is setup to use this location)

Many of the library properties are stored in variables in the __sass/lib/variables directory. These can be overriden in the granule/assets/sass/lib/_variables.scss

## License

GPL2
