Github Changelog
============

Quick and dirty script to generate a markdown changelog by release using Github's API and git log.

## Usage
Download the gh-changelog.php file and put it in your project directory. (You may want to add it to `.gitignore`)

From the command line, in your Github project directory, run:

`php gh-changelog.php`

It will **overwrite** your existing `CHANGELOG.md`, unless you have specified a different output file name.
