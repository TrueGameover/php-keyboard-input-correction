<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 03.12.2018
 * Time: 14:56
 */

namespace KeyboardInputCorrection;

use KeyboardInputCorrection\exceptions\CorrectorException;
use KeyboardInputCorrection\exceptions\UnsupportedSymbolException;

abstract class Corrector {

    const DEFAULT_ENCODE = 'utf-8';
    const LANGUAGE_RU = 0;
    const LANGUAGE_EN = 1;
    protected $throwUnknownSymbols;

    public function __construct($throwUnsupportedSymbols = false) {

        $this->throwUnknownSymbols = $throwUnsupportedSymbols;
    }

    /**
     * @param string $input
     * @param int $language
     * @return bool
     * @throws \InvalidArgumentException
     */
    abstract public function validate(string $input, int $language = self::LANGUAGE_RU): bool;

    /**
     * @param string $input
     * @param int $language
     * @return string
     * @throws \InvalidArgumentException
     * @throws CorrectorException
     */
    abstract public function correct(string $input, int $language = self::LANGUAGE_RU): string;

    /**
     * Convert $input to utf8
     * @param string $input
     * @param string $sourceEncode
     * @return string source encode
     */
    protected function prepare(string $input, string &$sourceEncode = ''): string {

        $sourceEncode = mb_detect_encoding($input);

        return mb_convert_encoding($input, 'utf-8', $sourceEncode);
    }

    /**
     * Convert $input to $sourceEncode encode
     * @param string $input
     * @param string $sourceEncode
     * @return string
     */
    protected function finish(string $input, string $sourceEncode): string {

        if( empty($sourceEncode) ) {

            throw new \InvalidArgumentException('source encode is empty');
        }

        return mb_convert_encoding($input, $sourceEncode, 'utf-8');
    }

    /**
     * Throws only if throwUnknownSymbols == true
     * @param array $conversionTable
     * @param string $char
     * @return string
     * @throws UnsupportedSymbolException
     */
    protected function processChar(array &$conversionTable, string $char): string {

        if( !array_key_exists($char, $conversionTable) ) {

            if( $this->throwUnknownSymbols ) {

                throw new UnsupportedSymbolException($char);
            }

            $char = '';
        }

        return !empty($char) ? $conversionTable[$char] : $char;
    }
}