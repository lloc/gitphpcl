# gitphpcl

Generate your changelog from git with PHP

First, add *gitphpcl* as a dev-dependency with Composer:

`composer require --dev lloc/gitphpcl`

Tag your releases like 

`git tag v1.0`

You can now create your Changelog with the command

`vendor/lloc/gitphpcl/changeog -f Changelog.md`

or 

`vendor/lloc/gitphpcl/changeog -f Changelog.md -p path/to/another/repository `

You should check (and correct) the output anyway. There is no guarantee that all commit messages are meaningful.

