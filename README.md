# Granule - A WordPress Starter Theme.

Granule is the theme I use as the starter theme for all of my [Pro Theme Design](https://prothemedesign.com) themes.

The theme was initially based on Darren Hoyts Gravy theme, but has evolved over many years of developing themes for wordpress.com. It now takes inspiration from [_s](https://github.com/automattic/_s) and is a simple starting point for creating new WordPress themes.

Things to note:

* It is not a theme framework or a parent theme.
* The theme code does not care about backwards compatibility. There's no need since the theme is not a parent theme.
* Granule always supports the latest version of WordPress.
* [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/) should be followed. I do this locally using [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer), with the [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards).
* Docblocks are used extensively. Eventually I want to auto generate documentation using these comments.
* Accessibility is baked in (following the [WordPress.org standards](https://make.wordpress.org/themes/handbook/review/accessibility/)). However I am sure it's not perfect and is something I am keen to improve - would love pull requests to help here :)

## Example Themes

Below is a selection of the recent themes that Granule was used to create:

* [Label](https://prothemedesign.com/theme/label/)
* [Carmack](https://prothemedesign.com/theme/carmack/)
* [Romero](https://prothemedesign.com/theme/romero/)
* [Passenger](https://prothemedesign.com/theme/passenger/)
* [Monet](https://prothemedesign.com/theme/monet/)

## Features

* Supports most major WordPress functionality (Custom header, Site Logo etc)
* Supports most Jetpack functionality (Featured Content, Infinite Scroll, Portfolios, Social Menus, Content Options - and more) - see [jetpack.php for more](https://github.com/BinaryMoon/granule/blob/master/granule/inc/jetpack.php).
* Follows the [wordpress.com theme developer guidelines](https://developer.wordpress.com/themes/).
* Pure CSS dropdown menu (with a smattering of js for compatibility).
* SVG Icons
* SASS styles
* Boilerplate Customizer code

## Using Granule

To use the theme as a starter theme I recommend checking out all of the files and then placing both the __sass and granule directories into your wp-content/themes folder. You can then either hack away on granule, or create a copy of the granule folder and use that to create your themes. Either way you will need to do a case sensitive search and replace on all instances of the name granule.

### About the __sass Framework

Granule uses an external SASS library. This means the SASS is easily reusable - however it's entirely optional. If you don't want to use it then you can use your normal library/ process. This is one of the joys of using a starter theme.

If you want to use the Granule SASS library then I recommend the following process:

* Grab the [Granule SASS library](https://github.com/binarymoon/__sass)
* Place the Granule SASS library in the 'wp-content/themes' directory (Granule theme is setup to use this location)

Many of the library properties are stored in variables in the __sass/lib/variables directory. These can be overriden in the granule/assets/sass/lib/_variables.scss

## License

GPL2
