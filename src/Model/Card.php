<?php

namespace Bully\Model;

class Card
{
    /**
     * All available card values
     */
    const AVAILABLE_VALUES = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

    /**
     * All available card suits.
     * Associative array:
     *  [key]: A letter to identify the suit
     *  value: The HTML entity to display the symbol
     */
    const AVAILABLE_SUITS = ['H' => '&hearts;', 'D' => '&diams;', 'S' => '&spades;', 'C' => '&clubs;'];

    /**
     * Suits defining the red color
     */
    const RED_COLORS = ['D', 'H'];

    /**
     * Card's value.
     *
     * @var string $value
     */
    private $value;

    /**
     * Card's color
     *
     * @var string $color
     */
    private $color;

    /**
     * Card's constructor.
     *
     * @param string $value
     * @param string $color
     */
    public function __construct(string $value, string $color)
    {
        if (!$this->isColorValid($color) || !$this->isValueValid($value)) {
            throw new \LogicException('The value or/and the color of the card is/are not valid');
        }

        $this->value = $value;
        $this->color = $color;
    }

    /**
     * Returns a combination of the card value+color
     *
     * @return string
     */
    public function __toString(): string
    {
        return html_entity_decode(self::AVAILABLE_SUITS[$this->color]) . $this->value;
    }

    /**
     * Returns a combination of the card value+color
     *
     * @return string
     */
    public function getKey(): string
    {

        return $this->value . $this->color;
    }

    /**
     * Returns the card's value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Returns the card's color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Returns true if the card has the same color of the given card. False otherwise.
     *
     * @param string $color
     *
     * @return bool
     */
    public function isSameColor(string $color): bool
    {
        $bothRed   = $this->isRed($this->color) && $this->isRed($color);
        $bothBlack = $this->isBlack($this->color) && $this->isBlack($color);

        return $bothRed || $bothBlack;
    }

    /**
     * Returns true if the given color is red. False otherwise.
     *
     * @param string $color
     *
     * @return bool
     */
    private function isRed(string $color): bool
    {
        return in_array($color, self::RED_COLORS);
    }

    /**
     * Returns true if the given color is black. False otherwise.
     *
     * @param string $color
     *
     * @return bool
     */
    private function isBlack(string $color): bool
    {
        return !$this->isRed($color);
    }

    /**
     * Returns true if the card's value is the same as the given one. False otherwise.
     *
     * @param string $value
     *
     * @return bool
     */
    public function isSameValue(string $value): bool
    {
        return $this->value === $value;
    }

    /**
     * Returns true if the given color exists. False otherwise.
     *
     * @param string $color
     *
     * @return bool
     */
    private function isColorValid(string $color): bool
    {
        return array_key_exists($color, self::AVAILABLE_SUITS);
    }

    /**
     * Returns true if the given value exists. False otherwise.
     *
     * @param string $value
     *
     * @return bool
     */
    private function isValueValid(string $value): bool
    {
        return in_array($value, self::AVAILABLE_VALUES);
    }
}