#!/bin/bash

# sudo mkdir ../public/swagger

sudo php ../vendor/bin/openapi --bootstrap ./swagger-constants.php --output ../public/swagger ./swagger-v1.php ../app/Http/Controllers

