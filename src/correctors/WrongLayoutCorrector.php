<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 03.12.2018
 * Time: 15:02
 */

namespace KeyboardInputCorrection\correctors;

use KeyboardInputCorrection\Corrector;
use KeyboardInputCorrection\exceptions\CorrectorException;

class WrongLayoutCorrector extends Corrector {

    /**
     * @param string $input
     * @param int $language
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validate(string $input, int $language = self::LANGUAGE_RU): bool {

        switch($language) {

            case self::LANGUAGE_RU:
                return preg_match('/([а-яА-Я@\.$+-*!#%\^&()=/\\<>?]+)/ui', $this->prepare($input)) === 1;
                break;
        }

        return false;
    }

    /**
     * @param string $input
     * @param int $language
     * @return string
     * @throws \KeyboardInputCorrection\exceptions\UnsupportedSymbolException
     * @throws \InvalidArgumentException
     * @throws CorrectorException
     */
    public function correct(string $input, int $language = self::LANGUAGE_RU): string {

        if( !$this->validate($input, $language) ) {

            $table = $this->getConversionTable(self::LANGUAGE_EN, self::LANGUAGE_RU);
            $input = $this->prepare($input, $sourceEncode);
            $size = mb_strlen($input, self::DEFAULT_ENCODE);
            $result = '';

            for( $i = 0; $i < $size; $i++ ) {

                $char = mb_convert_case(mb_substr($input, $i, 1, self::DEFAULT_ENCODE), MB_CASE_LOWER, self::DEFAULT_ENCODE);

                if( $char ) {

                    $result .= $this->processChar($table, $char);
                }
            }

            return $this->finish($result, $sourceEncode);
        }

        return $input;
    }

    protected function getConversionTable(int $fromLanguage, int $toLanguage): array {

        switch($fromLanguage) {

            case self::LANGUAGE_EN:
                switch($toLanguage) {

                    case self::LANGUAGE_RU:
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
                            'd' => 'а',
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
                        break;
                }
                break;
        }

        return [];
    }
}