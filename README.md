# 15 Marketing Sample

That's the execution of sample interview task for 15 Marketing.

## Build image:

`docker build . -t 15marketingbuild `

## Run container from image

`docker run -d -p 8080:8080 --name 15marketingContainer 15marketingbuild`

## Check that container works

`curl --data-binary '@sample/enter.xml' localhost:8080`

## Run PHPUnit tests

`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests`