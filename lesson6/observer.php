<?php

class Applicant implements SplObserver
{
    protected $name;
    protected $workExperience;
    protected $email;

    public function __construct($name, $workExperience, $email)
    {
        $this->name = $name;
        $this->workExperience = $workExperience;
        $this->email = $email;
    }

    public function update(SplSubject $subject)
    {
        echo "Отправить новую вакансию '{$subject->getVacancies()}' на $this->email <br>";
    }
}

class NewVacancy implements SplSubject
{
    private $observers;
    private $newVacancy;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function getVacancies()
    {
        return $this->newVacancy;
    }

    public function setVacancies(string $vacancy)
    {
        $this->newVacancy = $vacancy;
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

$applicant1 = new Applicant('John', '10', 'test@test.test');
$applicant2 = new Applicant('Mike', '20', 'test2@test2.test');

$newVacancy = new NewVacancy();
$newVacancy->attach($applicant1);
$newVacancy->attach($applicant2);

$newVacancy->setVacancies('super web developer');
$newVacancy->notify();