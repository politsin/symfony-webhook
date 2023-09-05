# Symfony Webhook to Elastic
Перекладываем сообщения из вебхука в еластик-серч с помощью симфони-вебхук.

* Адрес вебхука:
  https://example.com/webhook/tg
* Новый вебхук добавляем тут:
  https://github.com/politsin/symfony-webhook/blob/master/app/config/packages/webhook.yaml#L5
* При получении входящих обращений на вебхук они отправляются в очередь MESSENGER_TRANSPORT_DSN (очередь у меня в редисе, потому что там удобнее всего отлаживать, потом логичнее перенести в ребит)
  https://github.com/politsin/symfony-webhook/blob/master/app/src/Webhook/TgWebhookParser.php#L52
* Команда ./run.php разбирает очередь из редиса, перекладывает сообщения в еластик и выводит инфу в косоль
  https://github.com/politsin/symfony-webhook/blob/master/app/src/Webhook/TgEvent.php#L45

## .env:
```config
APP_ENV=dev
APP_DEBUG=true
APP_SECRET=
MESSENGER_TRANSPORT_DSN=redis://example.com:6379/\$webhook:tg
MESSENGER_TRANSPORT_PASS=
MESSENGER_TRANSPORT_DBINDEX=0

ELASTIC_URL=https://example.com:9300
ELASTIC_INDEX=
ELASTIC_USER=
ELASTIC_PASS=
```


## Links
- https://symfony.com/components/Webhook
- https://github.com/symfony/webhook
- https://www.google.com/search?q=symfony+MailerWebhookParser
- https://symfony.com/blog/new-in-symfony-6-3-webhook-and-remoteevent-components
- https://symfony.com/blog/new-in-symfony-6-3-webhook-integration-with-mailer-and-notifier
- https://jolicode.com/blog/symfony-webhook-remoteevent-or-how-to-simplify-external-event-management
- https://www.dev-notes.ru/articles/symfony/new-in-symfony-6-3-webhook-integration-with-mailer-and-notifier/
- https://speakerdeck.com/fabpot/symfonycon-2022-keynote-webhooks?slide=12
