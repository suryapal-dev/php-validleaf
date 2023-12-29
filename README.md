# ValidLeaf (PHP)

ValidLeaf is a PHP package designed for validating input based on its type. This package is tailored for PHP projects and is built using PHP.

## Package testing enviroment

### Prerequisites

Ensure you have Docker installed on your machine.

### Building the Docker Environment

Run the following commands to build and run the Docker environment for ValidLeaf:

```bash
cd path_to_the_package
docker build -t php-validleaf-env .
docker run -it --rm -v $(pwd):/app php-validleaf-env sh
```

### Test Package

Run the following command in the image started terminal

```bash
composer test
```

## Available Methods

1. `isEmail` - Validates whether the given input is Email.
1. `isURL` - Validates whether the given input is URL.

## Usage

![ValiLeaf Code Usage](https://github.com/suryapal-dev/dummy-assets/blob/main/ray-so-export.png?raw=true)