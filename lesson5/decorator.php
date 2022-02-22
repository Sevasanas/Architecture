<?php


interface Notifier
{
    public function send(string $message) : string;
}


class BaseNotifier implements Notifier
{
    public function send(string $message): string
    {
        return $message . PHP_EOL;
    }
}


class Decorator implements Notifier
{

    protected $notifier;

    public function __construct(Notifier $notifier)
    {

        $this->notifier = $notifier;
    }

   
    public function send(string $message): string
    {
        return $this->notifier->send($message);
    }
}


class EmailDecorator extends Decorator
{
   
    public function send(string $message): string
    {
        $message = parent::send($message);

        return "Email notification: {$message}";
    }
}

class SmsDecorator extends Decorator
{
    public function send(string $message): string
    {
        $message = parent::send($message);

        return "SMS notification: {$message}";
    }
}

class TelegramDecorator extends Decorator
{
    public function send(string $message): string
    {
        $message = parent::send($message);

        return "Telegram notification: {$message}";
    }
}



function clientCode(Notifier $notifier)
{
    echo "RESULT: " . $notifier->send("Hello!");
}


$baseNotifier = new BaseNotifier();
$emailNotifier = new EmailDecorator($baseNotifier);
echo "Client: I've got a simple component:\n";
clientCode($emailNotifier);
echo "\n\n";
$smsNotifier = new SmsDecorator($baseNotifier);
echo "Client: I've got a simple component:\n";
clientCode($smsNotifier);
$telegramNotifier = new TelegramDecorator($baseNotifier);
echo "Client: I've got a simple component:\n";
clientCode($telegramNotifier);




