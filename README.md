# OroTest

Finder Bundle
It find the keywords from list of files which are present on uploads/files folder.

Installation Steps

1) add "symfony/finder": "^2.8" in your composer.json file under "require"

2) composer require montubrainvire/OroTest register bundle in AppKernel.php

new TestBundle\AcmeTestBundle(),

Now you can search the keywords from the list of files from your browser. open your browser and type

http://localhost/YOUR-PROJECT-NAME/web/app_dev.php/default/index
