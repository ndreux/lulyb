<?php

namespace Bully\Model;

class Player
{
    /**
     * Player's name
     *
     * @var string name
     */
    private $name;

    /**
     * Player's cards
     *
     * @var Card[] $cards
     */
    private $cards;

    /**
     * Player's constructor.
     *
     * @param string $name
     */
    public function __construct(String $name)
    {
        $this->name  = $name;
        $this->cards = [];
    }

    /**
     * Returns the player's name
     *
     * @return String Player's name
     */
    public function __toString(): String
    {
        return $this->name;
    }

    /**
     * Returns the player's cards
     *
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Adds the given card to the player hand
     *
     * The card is indexed by the combination of its value + color
     *
     * @param Card $card
     */
    public function addCard(Card $card): void
    {
        $this->cards[$card->getKey()] = $card;
    }

    /**
     * Removes the given card from the player's hand
     *
     * @param Card $card
     */
    public function dropCard(Card $card): void
    {
        $cardKey = $card->getKey();
        if (array_key_exists($cardKey, $this->cards)) {
            unset($this->cards[$cardKey]);
        }
    }

    /**
     * Returns true if the player still has cards left. False otherwise.
     *
     * @return bool
     */
    public function hasCards(): bool
    {
        return count($this->cards) > 0;
    }

    /**
     * Returns true if the player has a card matching the color or the value of the given card. False otherwise.
     *
     * @param Card $refCard
     *
     * @return Card|false
     */
    public function hasMatchingCard(Card $refCard)
    {
        foreach ($this->cards as $card) {

            $sameColor = $card->isSameColor($refCard->getColor());
            $sameValue = $card->isSameValue($refCard->getValue());

            if ($sameColor || $sameValue) {
                return $card;
            }
        }

        return false;
    }
}