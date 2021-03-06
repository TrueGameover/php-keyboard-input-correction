<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 03.12.2018
 * Time: 19:20
 */

namespace KeyboardInputCorrection\dictionaries;

/**
 * Class Dictionary
 * All languages matrixes should be written here
 * @package KeyboardInputCorrection\dictionaries
 */
class LayoutDictionary {

    public static function en_ru(): array {

        return ['q' => 'й',
            'w' => 'ц',
            'e' => 'у',
            'r' => 'к',
            't' => 'е',
            'y' => 'н',
            'u' => 'г',
            'i' => 'ш',
            'o' => 'щ',
            'p' => 'з',
            '[' => 'х',
            ']' => 'ъ',
            'a' => 'ф',
            's' => 'ы',
            'd' => 'в',
            'f' => 'а',
            'g' => 'п',
            'h' => 'р',
            'j' => 'о',
            'k' => 'л',
            'l' => 'д',
            ';' => 'ж',
            '\'' => 'э',
            'z' => 'я',
            'x' => 'ч',
            'c' => 'с',
            'v' => 'м',
            'b' => 'и',
            'n' => 'т',
            'm' => 'ь',
            ',' => 'б',
            '.' => 'ю',
            '/' => '.',
            '`' => 'ё',
            '~' => 'Ё',
            '@' => '"',
            '#' => '№',
            '$' => ';',
            '^' => ':',
            '&' => '?',
            '|' => '/',
            ':' => 'Ж',
            '"' => 'Э',
            '<' => 'Б',
            '>' => 'Ю',
            '?' => ',',

        ];
    }
}