<?php

namespace Boutique\Core;

use Boutique\App\App;
use Boutique\Core\Impl\IValidator;

class Validator implements IValidator
{
    private array $errors = [];

    const RULES = [
        'required' => 'isEmpty',
        'email' => 'isEmail',
        'phone' => 'isPhone',
        'number' => 'isNumeric',
        'uniqueclient' => 'isUnique'
    ];

    public function validate($data, $rules)
    {
        $this->errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (isset(self::RULES[$rule])) {
                    $method = self::RULES[$rule];
                    if ($this->$method($data[$field] ?? null, $field) === false) {
                        if ($rule == 'required') {
                            $this->errors[$field] = "Le champ {$field} est requis.";
                        }
                        if ($rule == 'email') {
                            $this->errors[$field] = "L'email n'est pas valide.";
                        }
                        if ($rule == 'phone') {
                            $this->errors[$field] = "Le téléphone doit être du type {77/76}0000000.";
                        }
                        if ($rule == 'number') {
                            $this->errors[$field] = "Le champ n'est pas un nombre valide.";
                        }
                        if ($rule == 'uniqueclient') {
                            $this->errors[$field] = "Le champ {$field} n'est pas unique.";
                        }
                        if ($rule == 'smallerThanRestant') {
                            $this->errors[$field] = "Le {$field} doit être < au montant restant.";
                        }
                        break;
                    }
                } else {
                    throw new \Exception("Cette règle n'existe pas: {$rule}");
                }
            }
        }

        return $this->errors;
    }

    public function isEmpty($value)
    {
        return !empty($value);
    }

    public function isEmail($value)
    {
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        return preg_match($pattern, $value) === 1;
    }

    public function isPhone($value)
    {
        $pattern = "/^(77|76)\d{7}$/";
        return preg_match($pattern, $value) === 1;
    }

    public function isNumeric($value)
    {
        return is_numeric($value) && $value > 0;
    }

    public function isUnique($value, $field)
    {
        $client = App::getInstance()->getModel('Client');
        return !$client->find(["{$field}" => $value]);
    }

}
