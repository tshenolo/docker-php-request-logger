# Docker PHP Request Logger

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Ubuntu](https://img.shields.io/badge/Ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

This repository contains a PHP script that logs all incoming HTTP requests along with their headers and request data ($_REQUEST). This can be useful for debugging or monitoring purposes in web applications.

## Getting Started

To use this request logger, follow these steps:

1. Clone this repository to your local machine:

    ```bash
    git clone https://github.com/tshenolo/docker-php-request-logger.git
    ```

2. Navigate into the cloned directory:

    ```bash
    cd docker-php-request-logger
    ```

3. Build the Docker image using the provided Dockerfile:

    ```bash
    docker build -t request-logger .
    ```

4. Run the Docker container:

    ```bash
    docker run -d -p 8080:80 request-logger
    ```

    This will start the PHP script inside a Docker container accessible at http://localhost:8080/.

Optional:
5. Interact with the container's shell:
    ```bash
    docker exec -it <container_id_or_name> /bin/bash
    ```

6. Stop container:
    ```bash
    docker stop <container_id_or_name> 
    ```

7. Remove image
    ```bash
    docker rmi -f <image_id_or_name> 
    ```

## Usage

Once the Docker container is running, you can send HTTP requests to the server, and the script will log them along with the headers and request data to a file named `request_log.txt` inside the container.


### Examples:

```bash
curl -X GET \
-H "Content-Type: application/json" \
-H "Authorization: Bearer my_token" \
http://localhost:8080/index.php?key1=value1&key2=value2
```

```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"key1": "value1", "key2": "value2"}' \
  http://localhost:8080/index.php
```

## Contributing

If you have suggestions or improvements, feel free to open an issue or create a pull request. Contributions are welcome!

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Thank you for the Support
- ⭐ Give this repo a ⭐ star ⭐ at the top of the page
- 🐦 Follow me on twitter [twitter](https://twitter.com/tshenolo)
- 📺 Subscribe to my [Youtube channel](https://www.youtube.com/@tshenolo?sub_confirmation=1)