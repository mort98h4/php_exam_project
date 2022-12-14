<?php

include_once __DIR__ . '/../utils.php';

class User {
    private const NAME_REGEX = '/^[a-zA-ZæøåñçáéíóúàèìòùäëïöüâêîôûÆØÅÑÇÁÉÍÓÚÀÈÌÒÙÄËÏÖÜÂÊÎÔÛ \-]+$/i';
    private const EMAIL_REGEX = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i';
    private const PASSWORD_REGEX = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/i';
    private const ROLE_OPTIONS = [1, 2, 3];

    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private int $role;

    public function setFirstName(string $firstName): bool {
        if (!$this->nameIsValid($firstName)) {
            return false;
        } else {
            $this->firstName = $firstName;
            return true;
        }
    }

    public function setLastName(string $lastName): bool {
        if (!$this->nameIsValid($lastName)) {
            return false;
        } else {
            $this->lastName = $lastName;
            return true;
        }
    }

    public function setEmail(string $email): bool {
        if (!$this->emailIsValid($email)) {
            return false;
        } else {
            $this->email = $email;
            return true;
        }
    }

    public function setPassword(string $password, string $confirmPassword): bool {
        if (!$this->passwordIsValid($password, $confirmPassword)) {
            return false;
        } else {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return true;
        }
    }

    public function setRole(int $role): bool {
        if (!$this->roleIsValid($role)) {
            return false;
        } else {
            $this->role = $role;
            return true;
        }
    }

    public function nameIsValid(string $name): bool {
        return ((strlen($name) >= _STR_MIN_LEN) && (strlen($name) <= _STR_MAX_LEN) && (preg_match(self::NAME_REGEX, $name)));
    }

    public function emailIsValid(string $email): bool {
        return (preg_match(self::EMAIL_REGEX, $email));
    }

    public function passwordIsValid(string $password, string $confirmPassword): bool {
        return (($password === $confirmPassword) && (preg_match(self::PASSWORD_REGEX, $password)));
    }

    public function roleIsValid(int $role): bool {
        return (in_array($role, self::ROLE_OPTIONS));
    }

    public function firstName(): string {
        return (isset($this->firstName) ? $this->firstName : '');
    }

    public function lastName(): string {
        return (isset($this->lastName) ? $this->lastName : '');
    }

    public function email(): string {
        return (isset($this->email) ? $this->email : '');
    }

    public function password(): string {
        return (isset($this->password) ? $this->password : '');
    }

    public function role(): string {
        return (isset($this->role) ? $this->role : '');
    }
}