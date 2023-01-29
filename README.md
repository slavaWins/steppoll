<p align="center">
<img src="info/logo.jpg">
</p>
 
## Steppoll
Кароч изи пакет 
   

## Установка из composer

```  
composer require slavawins/steppoll
```

 Опубликовать js файлы, вью и миграции необходимые для работы пакета.
Вызывать команду:
```
php artisan vendor:publish --provider="Steppoll\Providers\SteppollServiceProvider"
``` 

 В роутере routes/web.php удалить:
 добавить
 ```
    \Steppoll\Library\SteppollRoute::routes();
 ```

Выполнить миграцию
 ```
    php artisan migrate 
 ``` 
