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
     * @param int $targetLanguage
     * @param string $encode
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validate(string $input, int $targetLanguage = self::LANGUAGE_RU, string $encode = self::DEFAULT_ENCODE): bool {

        switch($targetLanguage) {

            case self::LANGUAGE_RU:
                //                return preg_match('/([а-яА-Я@\.$+-*!#%\^&()=\\/\\<>?]+)/ui', $this->prepare($input)) === 1;
                return preg_match('/([а-я]+)/ui', $this->prepare($input, $encode)) === 1;
                break;
        }

        return false;
    }

    /**
     * @param string $input
     * @param int $targetLanguage
     * @param string $encode
     * @return string
     * @throws \KeyboardInputCorrection\exceptions\UnsupportedSymbolException
     * @throws \InvalidArgumentException
     * @throws CorrectorException
     */
    public function correct(string $input, int $targetLanguage = self::LANGUAGE_RU, string $encode = self::DEFAULT_ENCODE): string {

        if( !$this->validate($input, $targetLanguage) ) {

            $table = $this->getConversionTable(self::LANGUAGE_EN, $targetLanguage);
            $input = $this->prepare($input, $encode);
            $size = mb_strlen($input, $encode);
            $result = '';

            for( $i = 0; $i < $size; $i++ ) {

                $char = mb_convert_case(mb_substr($input, $i, 1, $encode), MB_CASE_LOWER, $encode);

                if( $char ) {

                    $result .= $this->processChar($table, $char);
                }
            }

            return $this->finish($result, $encode);
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
                        break;
                }
                break;
        }

        return [];
    }
}