<p align="center">
<img src="info/logo.jpg">
</p>

## Steppoll

Кароч изи пакет

## Установка из composer

```  
composer require slavawins/steppoll
```

Опубликовать js файлы, вью и необходимые для работы пакета.
Вызывать команду:

```
php artisan vendor:publish --provider="Steppoll\Providers\SteppollServiceProvider"
``` 

В роутере routes/web.php добавить

 ```
    \Steppoll\Library\SteppollRoute::routes();
 ```

После этого у вас появится папка app/Pols и первый пример MyExamplePoll.php.
<BR> Перейдите по адресу на вашем сайте и пройдите первый опрос:

 ```
 /pols/MyExamplePoll
 ``` 


 

Там всё само валидируется, и по итогу будет вызван метод  в MyExamplePoll->Complited
 ```
public function Complited(?User $user, array $data)
{
log::info("Complited!");

        return redirect()->route("home")->withErrors($user->name . ' OK!');
    }
 ``` 
У StepPoll нет контроллеров которые нужно создавать. Вы просто запускате тест и получаете валидрованую готовую форму пользователя


## Поправь у себя
Нужно будет поправить здесь: \resources\views\step-poll\page.blade.php
<BR> Это шаблон вывода опроса в твоем проекте.
 ```
 @extends('layouts.center-mini')
 ``` 
Сорян, использую свои layouts, а под твой проект это не настраивал. Возможно тебе надо будет написать  
<BR> @extends('layouts.app')
<BR> или
<BR> @extends('layouts.container')
