# Shortener Link Application


To run this project, follow the steps below:

1. **Run Docker Compose:**

  ```bash
  docker compose up
  ```

2. **Run Initialize Data:**

```bash
docker exec shortener_container  php "/var/www/html/importDatabase.php"
```

## PostMan Collection
Find the Postman Collection file at `shortener.postman_collection.json` to test the API.
