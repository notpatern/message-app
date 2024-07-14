<?php
    
namespace App\Handler;

class Group{

    public $users;

    public function __construct(array $users){
        $this->users = $users;
    }

    public function sendMessage(UserInterface $from, $msg){
        foreach ($this->users as $user) {
            if (!($user == $from)){
                $user->send($msg);
            }
        }
    }

    public function addUser(UserInterface $newUser){
        $this->users[] = $newUser;
    }

    public function removeUser(UserInterface $userToRemove)
    {
        unset($this->users[array_search($userToRemove, $this->users)]);
    }
}