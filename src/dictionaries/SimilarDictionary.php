<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 19:45
 */

namespace KeyboardInputCorrection\dictionaries;

class SimilarDictionary {

    public static function for_ru(): array {

        return ['A' => 'А',
            'B' => 'В',
            'C' => 'С',
            'E' => 'Е',
            'H' => 'Н',
            'K' => 'К',
            'M' => 'М',
            'O' => 'О',
            'P' => 'Р',
            'T' => 'Т',
            'X' => 'Х',
            'a' => 'а',
            'c' => 'с',
            'e' => 'е',
            'o' => 'о',
            'p' => 'р',
            'x' => 'х',
            'k' => 'к',

        ];
    }

    public static function for_en(): array {

        return ['А' => 'A',
            'В' => 'B',
            'С' => 'C',
            'Е' => 'E',
            'Н' => 'H',
            'К' => 'K',
            'М' => 'M',
            'О' => 'O',
            'Р' => 'P',
            'Т' => 'T',
            'Х' => 'X',
            'а' => 'a',
            'с' => 'c',
            'е' => 'e',
            'о' => 'o',
            'р' => 'p',
            'х' => 'x',
            'к' => 'k'
        ];
    }
}