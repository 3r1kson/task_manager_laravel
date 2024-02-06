TASK MANAGER LARAVEL

Creating new project:
- composer create-project --prefer-dist laravel/laravel app_controle_tarefas "8.5.9"

Inserting new artisan ui package:
- composer require laravel/ui:^3.2

Listing available artisan commands:
- php artisan list

Making scaffold with front-end bootstrap and auth
- php artisan ui bootstrap --auth

Install (npm install) and run bundle (npm run dev) -> based on the config above (bootstrap)
- npm install && npm run dev

Creating a mail sender logic with markdown in the view emails.mensagem-teste
- php artisan make:mail MensagemTesteMail --markdown emails.mensagem-teste

Sending test email using Tinker:
- php artisan tinker
- use App\Mail\MensagemTesteMail;
- Mail::to('email@email.com')->send(new MensagemTesteMail());

Publishing and customizing email template:
- php artisan vendor:publish - select "laravel-mail"

Installation of composer packages (laravel excel):
- composer require maatwebsite/excel=number_version - if there is an error insert --ignore-platform-reqs

Error with ZipStream for PHP 7.4 and Laravel Excel:
- composer require maennchen/zipstream-php:^2.1 --ignore-platform-reqs