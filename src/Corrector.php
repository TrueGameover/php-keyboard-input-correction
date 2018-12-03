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
     * @param int $targetLanguage
     * @param string $encode
     * @return bool
     * @throws \InvalidArgumentException
     */
    abstract public function validate(string $input, int $targetLanguage = self::LANGUAGE_RU, string $encode = self::DEFAULT_ENCODE): bool;

    /**
     * @param string $input
     * @param int $targetLanguage
     * @param string $encode
     * @return string
     * @throws \InvalidArgumentException
     * @throws CorrectorException
     */
    abstract public function correct(string $input, int $targetLanguage = self::LANGUAGE_RU, string $encode = self::DEFAULT_ENCODE): string;

    /**
     * Convert $input to utf8
     * @param string $input
     * @param string $sourceEncode
     * @return string source encode
     */
    protected function prepare(string $input, string $sourceEncode = self::DEFAULT_ENCODE): string {

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

        $ok = true;

        if( !array_key_exists($char, $conversionTable) ) {

            if( $this->throwUnknownSymbols ) {

                throw new UnsupportedSymbolException($char);
            }

            $ok = false;
        }

        return $ok ? $conversionTable[$char] : $char;
    }
}