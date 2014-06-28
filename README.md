Github Changelog
============

Quick and dirty script to generate a markdown changelog by release using Github's API and git log. It contacts the GH API to get a list of your releases, and then executes a `git log` command to look for any commit logs with a specified phrase, for example `fix`, `resolve`, `closes`, `closed`, or `#changelog`.

See the [EXAMPLE-OUTPUT.md](https://github.com/snipe/gh-changelog/blob/master/EXAMPLE-OUTPUT.md) for an example of the output it generates.

## Customizing

You can configure what terms you want to look for in the commit logs, based on your own workflow. For example, if you always use a tag like `#changelog` in the commits you'd like to have in the changelog, you could omit the other phrases.

The `$string` variable contains a simple set of words you want to search on. The search is insensitive (per the `-i` in the grep string when executing the `git log` command in the script.) To add or remove phrases to look for, just modify this variable so that your words are pipe-delmimited.

`$string = 'fix|resolve|closes|closed|#changelog';`

## Usage
Download the `gh-changelog.php` file and put it in your project directory. (You may want to add it to `.gitignore` for housekeeping, and to be sure it won't get deployed to the server with the rest of your versioned code.)

Modify the `$gh_user` and `$gh_repo` variables to match the GH user and repo you'd like to run a changelog on.

From the command line, while within your Github project directory on your local machine, run:

`php gh-changelog.php`

It will **overwrite** your existing `CHANGELOG.md`, unless you have specified a different output file name.

## Excluding Commits

If you have a habit of generating some sweary commits, or you want to exclude commits that contain specific keywords, the `$omit` variable is for you. Just like `$string`, you can use a single word, or pipe-delimited words.