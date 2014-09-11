<?php namespace Cribbb\Domain\Model;

interface Identifier
{
    /**
     * Generate a new Identifier
     *
     * @return Identifier
     */
    public static function generate();

    /**
     * Creates an Identifier from a string
     *
     * @param $string
     * @return Identifier
     */
    public static function fromString($string);

    /**
     * Determine equality with another Identifier
     *
     * @param Identifier $other
     * @return bool
     */
    public function equals(Identifier $other);

    /**
     * Return the Identifier as a string
     *
     * @return string
     */
    public function toString();
}
