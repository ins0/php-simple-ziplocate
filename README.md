php-ziplocate-api
=================

simple api implementation to get geo coordinates from postcodes

### Install via Composer
In the `require` key of `composer.json` file add the following

    "ins0/google-measurement-php-client": "dev-master"

Run the Composer update command

    $ composer update

### example

    $postcode = \ZipLocate::fromZipCode(80302);
    if( $postcode !== false )
    {
        echo $postcode->getLat();
        echo $postcode->getLng();
        echo $postcode->getZip();
    }