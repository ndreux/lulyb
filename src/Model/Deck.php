<?php

namespace Bully\Model;

class Deck
{
    /**
     * @var Card[]
     */
    private $cards;

    /**
     * Deck constructor.
     */
    public function __construct()
    {
        $this->buildDeck();
    }

    /**
     * Returns the deck's cards
     *
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Create the 52 cards
     */
    private function buildDeck(): void
    {
        foreach (Card::AVAILABLE_VALUES as $value) {
            foreach (array_keys(Card::AVAILABLE_SUITS) as $color) {
                $this->cards[] = new Card($value, $color);
            }
        }
    }

    /**
     * Shuffle the cards
     */
    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    /**
     * Remove the first card from the deck
     *
     * @return Card
     */
    public function shiftCard(): Card
    {
        return array_shift($this->cards);
    }
}