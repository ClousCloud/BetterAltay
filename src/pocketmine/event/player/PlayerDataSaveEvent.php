<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\event\player;

use pocketmine\event\Cancellable;
use pocketmine\event\Event;
use pocketmine\player\IPlayer;;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\Server;

/**
 * Called when a player's data is about to be saved to disk.
 */
class PlayerDataSaveEvent extends Event implements Cancellable{
	/** @var CompoundTag */
	protected $data;
	/** @var string */
	protected $playerName;

	public function __construct(CompoundTag $nbt, string $playerName){
		$this->data = $nbt;
		$this->playerName = $playerName;
	}

	/**
	 * Returns the data to be written to disk as a CompoundTag
	 */
	public function getSaveData() : CompoundTag{
		return $this->data;
	}

	public function setSaveData(CompoundTag $data) : void{
		$this->data = $data;
	}

	/**
	 * Returns the username of the player whose data is being saved. This is not necessarily an online player.
	 */
	public function getPlayerName() : string{
		return $this->playerName;
	}

	/**
	 * Returns the player whose data is being saved. This may be a Player or an OfflinePlayer.
	 * @return IPlayer (Player or OfflinePlayer)
	 */
	public function getPlayer() : IPlayer{
		return Server::getInstance()->getOfflinePlayer($this->playerName);
	}
}