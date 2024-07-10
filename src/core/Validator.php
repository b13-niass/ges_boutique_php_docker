<?php

namespace Boutique\Core;

use Boutique\App\App;

class Validator
{
    protected static $errors = [];

    public static function validate(array $data, array $rules): int
    {
        self::$errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (self::hasError($field)) {
                    continue;
                }

                switch ($rule) {
                    case 'required':
                        if (self::isEmpty($data[$field] ?? null)) {
                            self::$errors[$field] = "Le champs {$field} est requis.";
                        }
                        break;

                    case 'email':
                        if (!self::isEmail($data[$field] ?? '')) {
                            self::$errors[$field] = "Le champs {$field} doit être un email valide.";
                        }
                        break;

                    case 'unique':
                        if (!self::isUnique($field, $data[$field] ?? '')) {
                            self::$errors[$field] = "le champ {$field} doit être unique.";
                        }
                        break;

                    case 'phone':
                        if (!self::isPhone($data[$field] ?? '')) {
                            self::$errors[$field] = "le champ {$field} doit être valide";
                        }
                        break;
                    case 'number':
                        if (!self::isNumeric($data[$field] ?? '')) {
                            self::$errors[$field] = "le champ {$field} doit être un nombre positif";
                        }
                        break;
                    default:
                        throw new \Exception("cette règle n'existe pas: {$rule}");
                }
            }
        }

        return count(self::$errors);
    }

    protected static function hasError(string $field): bool
    {
        return isset(self::$errors[$field]);
    }

    public static function getErrors(): array
    {
        return self::$errors;
    }

    protected static function isEmpty($value): bool
    {
        return empty($value);
    }

    protected static function isEmail(string $value): bool
    {
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        return preg_match($pattern, $value) === 1;
    }

    protected static function isPhone(string $value): bool
    {
        $pattern = "/^(77|76)\d{7}$/";
        return preg_match($pattern, $value) === 1;
    }

    protected static function isUnique(string $field, $value): bool
    {
        $client = App::getInstance()->getModel('Client');
        if ($client->find(["{$field}" => $value])) {
            return false;
        }
        return true;
    }

    public static function isNumeric($value)
    {
        return is_numeric($value) && $value > 0;
    }

    // public static function isStockValide(string $field, $value)
    // {
    //     $article = App::getInstance()->getModel('Article');
    //     $qte = $article->find(["reference" => $field])->qte;

    //     if ($qte < $value) {
    //         return false;
    //     }
    //     return true;
    // }
}
