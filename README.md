php-ziplocate-api
=================

simple api implementation to get geo coordinates from postcodes


example
=================

    $postcode = \ZipLocate::fromZipCode(80302);
    if( $postcode !== false )
    {
        echo $postcode->getLat();
        echo $postcode->getLng();
        echo $postcode->getZip();
    }