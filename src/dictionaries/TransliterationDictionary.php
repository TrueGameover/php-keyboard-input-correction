<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 19:46
 */

namespace KeyboardInputCorrection\dictionaries;

class TransliterationDictionary {

    public static function transliteration_ru_en_iso_9_1995_system_b(): array {

        return ['ци' => 'ci',
            'це' => 'ce',
            'цэ' => 'ce`',
            'цё' => 'cyo',
            'цы' => 'cy`',
            'цю' => 'cyu',
            'ця' => 'cya',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'x',
            'ц' => 'cz',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shh',
            'ъ' => '``',
            'ы' => 'y`',
            'ь' => '`',
            'э' => 'e`',
            'ю' => 'yu',
            'я' => 'ya',
            '№' => '#'

        ];
    }

    public static function transliteration_en_ru_iso_9_1995_system_b(): array {

        return ['shh' => 'щ',
            'yo' => 'ё',
            'ch' => 'ч',
            'sh' => 'ш',
            'cz' => 'ц',
            'zh' => 'ж',
            '``' => 'ъ',
            'yu' => 'ю',
            'ya' => 'я',
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г',
            'd' => 'д',
            'e' => 'е',
            'z' => 'з',
            'i' => 'и',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'x' => 'х',
            'c' => 'ц',
            'y`' => 'ы',
            '`' => 'ь',
            'e`' => 'э',
            '#' => '№',

        ];
    }
}