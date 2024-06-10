<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Описание
Wedding - проекта автоматизация процесс свадебных услуг. И экономия времени и сил человека которым этим занимаются.

## Содержание
- [Установка](#установка)
- [API Маршруты](#APIМаршруты)

## Установка
Пошаговая инструкция по установке вашего проекта:
1. composer install
2. php artisan key:generate
3. php artisan migrate
4. php artisan db:seed

# API Маршруты

## Аутентификация

- **POST** `/send-otp` - Отправка OTP.
- **POST** `/verify-otp` - Проверка кода OTP.
- **POST** `/login` - Вход в систему.
- **POST** `/register` - Регистрация нового пользователя.

## Маршруты, доступные только аутентифицированным пользователям

### Пользователи

- **GET** `/user` - Получение текущего пользователя (middleware: `auth:sanctum`).
- **POST** `/logout` - Выход из системы.

### Планы

- **GET** `/plan` - Получение планов (middleware: `role:user|admin`).

### Гости

- **GET** `/guest` - Получение списка гостей.
- **POST** `/guest` - Добавление нового гостя.
- **PUT** `/guest/{guest}` - Обновление информации о госте.
- **DELETE** `/guest/{guest}` - Удаление гостя.
  (middleware: `role:user|admin`)

### Свадьба

- **GET** `/wedding` - Получение списка свадеб.
- **GET** `/wedding/{wedding}` - Получение информации о конкретной свадьбе.
- **POST** `/wedding` - Создание новой свадьбы.
- **PUT** `/wedding/{wedding}` - Обновление информации о свадьбе.
  (middleware: `role:user|admin`)

#### История

- **GET** `/wedding/history/{wedding}` - Получение истории по свадьбе.
- **GET** `/wedding/history/show/{history}` - Получение конкретной истории.
- **POST** `/wedding/history` - Создание новой записи в истории.
- **PUT** `/wedding/history/{history}` - Обновление записи в истории.
- **DELETE** `/wedding/history/{history}` - Удаление записи в истории.
  (middleware: `plan.access:standard-plan-access`, `role:user|admin`)

#### Комментарии

- **GET** `/wedding/comment/{wedding}` - Получение комментариев по свадьбе.
- **POST** `/wedding/comment` - Добавление комментария.
- **PUT** `/wedding/comment/{comment}` - Обновление комментария.
- **DELETE** `/wedding/comment/{comment}` - Удаление комментария.
  (middleware: `plan.access:premium-plan-access`, `role:user|admin`)

##### Ответы на комментарии

- **GET** `/wedding/comment/replay/{commentReply}` - Получение ответов на комментарий.
- **POST** `/wedding/comment/replay` - Добавление ответа на комментарий.
- **PUT** `/wedding/comment/replay/{commentReply}` - Обновление ответа на комментарий.
- **DELETE** `/wedding/comment/replay/{commentReply}` - Удаление ответа на комментарий.

#### События

- **GET** `/wedding/event/{wedding}` - Получение событий по свадьбе.
- **GET** `/wedding/event/show/{event}` - Получение конкретного события.
- **POST** `/wedding/event` - Создание нового события.
- **PUT** `/wedding/event/{event}` - Обновление события.
- **DELETE** `/wedding/event/{event}` - Удаление события.
  (middleware: `plan.access:premium-plan-access`, `role:user|admin`)

#### Галерея

- **GET** `/wedding/gallery/{wedding}` - Получение галереи по свадьбе.
- **GET** `/wedding/gallery/show/{gallery}` - Получение конкретной галереи.
- **POST** `/wedding/gallery` - Добавление новой галереи.
- **PUT** `/wedding/gallery/{gallery}` - Обновление галереи.
- **DELETE** `/wedding/gallery/{gallery}` - Удаление галереи.
  (middleware: `plan.access:premium-plan-access`, `role:user|admin`)

### Статистика

- **GET** `/statistics/admin` - Получение статистики для администратора.
- **GET** `/statistics/guest-count/{weddingId}` - Подсчет гостей по свадьбе.
- **GET** `/statistics/comment-count/{weddingId}` - Подсчет комментариев по свадьбе.
- **GET** `/statistics/remains-wedding-date/{wedding}` - Оставшееся время до даты свадьбы.
