<?php

namespace Bully\Model;

use Bully\Utils\Logger;

class Game
{
    const NUMBER_OF_PLAYERS          = 4;
    const NUMBER_OF_CARDS_PER_PLAYER = 7;

    /**
     * Game's winner
     *
     * @var Player $winner
     */
    private $winner;

    /**
     * List of players
     *
     * @var Player[] $players
     */
    private $players;

    /**
     * Card deck
     *
     * @var Deck $deck
     */
    private $deck;

    /**
     * Revealed card on the table
     *
     * @var Card
     */
    private $topCard;

    /**
     * Game's constructor.
     *
     * - Create new players
     * - Create a new Deck
     */
    public function __construct()
    {
        $this->createPlayers(self::NUMBER_OF_PLAYERS);
        $this->deck = new Deck();
    }

    /**
     * Creates the given amount of players
     *
     * @param $numberOfPlayers
     */
    private function createPlayers(int $numberOfPlayers): void
    {
        for ($i = 0; $i < $numberOfPlayers; $i++) {
            $this->players[] = new Player(sprintf('Player %d', $i));
        }
    }

    /**
     * Starts the game
     *
     * - Shuffle the deck
     * - Draw the top card
     * - Play
     */
    public function start(): void
    {
        Logger::log("Starting game with %s", implode(', ', $this->players));

        $this->distribute();
        $this->drawTopCard();
        $this->play();
        
        Logger::log("%s has won", $this->winner);
    }


    /**
     * Distributes cards to player
     *
     * - It mimics the card distribution when playing card games (1 card to players, one after an other).
     *   It could have been prettier if directly distributed 7 cards to each player without switching players :)
     */
    private function distribute(): void
    {
        $this->deck->shuffle();

        for ($i = 0; $i < self::NUMBER_OF_CARDS_PER_PLAYER; $i++) {
            foreach ($this->players as $player) {
                $this->playerDrawsCardFromDeck($player);
            }
        }

        foreach ($this->players as $player) {
            Logger::log("%s has been dealt: %s", $player, implode(', ', $player->getCards()));
        }
    }

    /**
     * Plays the game
     */
    private function play(): void
    {
        while (!$this->hasWinner()) {
            foreach ($this->players as $player) {

                $card = $player->hasMatchingCard($this->topCard);

                if ($card === false) {
                    $this->playerDrawsCardFromDeck($player, true);
                    continue;
                }

                $this->playerPlaysHand($player, $card);

                if ($this->hasWinner()) {
                    break;
                }
            }
        }
    }

    /**
     * The player draws a card from the deck and adds it to his game.
     *
     * @param Player $player
     * @param bool   $announce If true, it will announce what the player has drawn
     *
     * @return Card|mixed
     */
    private function playerDrawsCardFromDeck(Player $player, bool $announce = false): void
    {
        $card = $this->deck->shiftCard();
        $player->addCard($card);

        if ($announce) {
            Logger::log("%s does not have a suitable card, taking from deck %s", $player, $card);
        }
    }

    /**
     * Returns true if the game has a winner. False otherwise.
     * @return bool
     */
    private function hasWinner(): bool
    {
        return $this->winner instanceof Player;
    }

    /**
     * Defines the top card
     */
    private function drawTopCard(): void
    {
        $this->topCard = $this->deck->shiftCard();
        Logger::Log("Top card is %s", $this->topCard);
    }

    /**
     * Players plays hand
     *
     * @param Player $player
     * @param Card   $card
     */
    private function playerPlaysHand(Player $player, Card $card): void
    {
        Logger::log("%s plays %s", $player, $card);
        $player->dropCard($card);
        $this->topCard = $card;
        $this->winner  = $player->hasCards() ? null : $player;
    }
}