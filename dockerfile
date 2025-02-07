# -----------------------------
# Етап 1: Збірка статичних ресурсів (Node)
# -----------------------------
    FROM node:18-alpine AS builder

    WORKDIR /app
    
    # Копіюємо package.json та package-lock.json для встановлення залежностей
    COPY package*.json ./
    RUN npm install
    
    # Копіюємо весь код проекту
    COPY . .
    
    # Запускаємо збірку (переконайтеся, що в package.json є скрипт "build": "webpack --mode production")
    RUN npm run build
    
    # -----------------------------
    # Етап 2: Runtime-середовище (PHP + Apache)
    # -----------------------------
    FROM php:8.0-apache

    RUN docker-php-ext-install mysqli pdo pdo_mysql
    RUN docker-php-ext-enable mysqli

    
    RUN a2enmod rewrite
    
    WORKDIR /var/www/html
    
    # Копіюємо результати збірки Node (наприклад, у папку dist)
    COPY --from=builder /app/dist/ ./dist/
    
    # Копіюємо PHP-код, HTML, css, images та інші необхідні файли
    COPY --from=builder /app/index.php ./
    COPY --from=builder /app/php/ ./php/
    COPY --from=builder /app/html/ ./html/
    COPY --from=builder /app/css/ ./css/
    COPY --from=builder /app/scss/ ./scss/
    COPY --from=builder /app/images/ ./images/
    
    EXPOSE 80
    CMD ["apache2-foreground"]
    