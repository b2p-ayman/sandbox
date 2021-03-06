# My SF5 tests project

![Symfony workflow](https://github.com/b2p-ayman/sandbox/actions/workflows/symfony.yml/badge.svg)

[![codecov](https://codecov.io/gh/b2p-ayman/sandbox/branch/develop/graph/badge.svg?token=PIBH2BXN49)](https://codecov.io/gh/b2p-ayman/sandbox)

## De la documentation

Plusieurs sujets : 
- [process](./doc/dev_process.md) et [règles de développement](doc/dev_rules.md)
- outils (installation et configuration): [Docker](./doc/tool_Docker.md), [PHP Storm](./doc/tool_PHPStorm.md)
- ...

A voir tous les fichiers [dans le répertoire *doc*](./doc/README.md)

## Common files

`.gitignore` to avoid including anything in the repo

## Docker files

**Note:** before running any Docker command, please copy the *.env.dist* provided file to *.env* and feel free to adapt this file content to your host needs -)

Symfony allows using a *.env.local*

`.dockerignore` to avoid including some files in the Docker layers
`docker-compose.yml` the main file to run all the services
`./docker` all the docker stuff used in the configuration

In PHPStorm, menu File / Settings / Build, create a new Docker configuration named *My Docker** and configured to be used with a Unix socket.

The services' configuration is located in the *.env* file:
- software components version (eg. nginx, MariaDB, ...)
- application versions
- database parameters
- application parameters and configuration

To run all the services:
```shell
# Run this command (to tail the containers log)
docker-compose up

# Or this one (Ctrl+C will not stop the containers)
docker-compose up -d && docker-compose logs -f
```

Then browse:
- `http://localhost:8080` for the PHPMyadmin Web interface
- `http://localhost:8000` or `http://localhost:8000/lucky/number` for the API interface (Symfony 5)
- `http://localhost:8002` for the front end application

**Tip** while browsing `http://localhost:8000/lucky/number`, have a look to the Docker log -)

The Docker configuration starts PHP-FPM and Nginx containers to allow executing the Symfony application of the project (source files located in the *./src* folder). Also, it starts a second Nginx instance to serve the *./src_ui* Html files.

**Note** the front end part of the application is not yet available in this repository...

To stop all the services:
```shell
# Ctrl+C if you started with: docker-compose up

# Else
docker-compose down
```
