# Test Cases
Test cases using curl to send requests to the PHP script:

## GET Request with Query Parameters:
```bash
curl -X GET "http://localhost:8080/index.php?key1=value1&key2=value2"
```

## GET Request with Custom Headers:
```bash
curl -X GET \
  -H "Authorization: Bearer my_token" \
  -H "Custom-Header: Value" \
  "http://localhost:8080/index.php?key1=value1&key2=value2"
```

## POST Request with JSON Body:
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"key1": "value1", "key2": "value2"}' \
  "http://localhost:8080/index.php"
```

## POST Request with Form Data:
```bash
curl -X POST \
  -d "key1=value1&key2=value2" \
  "http://localhost:8080/index.php"
```

## GET Request with Query Parameters and Custom Headers:
```bash
curl -X GET \
  -H "Authorization: Bearer my_token" \
  -H "Custom-Header: Value" \
  "http://localhost:8080/index.php?key1=value1&key2=value2"
```

These test cases cover various scenarios including GET and POST requests, passing query parameters, sending JSON data, and including custom headers. You can adjust the request data and headers according to your specific requirements and expected behavior of the PHP script





