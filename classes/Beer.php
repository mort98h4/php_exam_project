<?php

include_once __DIR__ . '/../utils.php';

class Beer {
    private const MAX_IBU = 182;
    private const MAX_EBC = 150;
    private const MIN_VOL = 0;
    private const IMG_REGEX = '/^(([0-9a-f]{32})*\\.(jpg|jpeg||png))$/i';
    private const TAPWALL_MIN = 0;
    private const TAPWALL_MAX = 29;
    private const IS_ACTIVE_OPTIONS = [0, 1];
    private const MIN_PRICE = 0;
    private const MAX_DESCRIPTION = 400;

    private int $breweryId;
    private string $style;
    private string $name;
    private int $IBU;
    private int $EBC;
    private string $volume;
    private string $description;
    private string $image;
    private int $createdBy;
    private int $createdAt;
    private string $updatedAt;
    private int $isActive;
    private int $tapwallNo;
    private float $price;

    public function setBrewery(int $id): bool {
        if (!$this->idIsValid($id)) {
            return false;
        } else {
            $this->breweryId = $id;
            return true;
        }
    }

    public function setStyle(string $style): bool {
        if (!$this->strIsValid($style)) {
            return false;
        } else {
            $this->style = $style;
            return true;
        }
    }

    public function setName(string $name): bool {
        if (!$this->strIsValid($name)) {
            return false;
        } else {
            $this->name = $name;
            return true;
        }
    }

    public function setIBU(int $IBU): bool {
        if (!$this->ibuIsValid($IBU)) {
            return false;
        } else {
            $this->IBU = $IBU;
            return true;
        }
    } 

    public function setEBC(int $EBC): bool {
        if (!$this->ebcIsValid($EBC)) {
            return false;
        } else {
            $this->EBC = $EBC;
            return true;
        }
    }

    public function setVolume(string $volume): bool {
        if (!$this->volIsValid($volume)) {
            return false;
        } else {
            $this->volume = $volume;
            return true;
        }
    }

    public function setDescription(string $description): bool {
        if (!$this->descriptionIsValid($description)) {
            return false;
        } else {
            $this->description = $description;
            return true;
        }
    }

    public function setImageStr(string $imageStr): bool {
        if (!$this->imageStrIsValid($imageStr)) {
            return false;
        } else {
            $this->image = $imageStr;
            return true;
        }
    }

    public function setCreatedBy(int $id): bool {
        if (!$this->idIsValid($id)) {
            return false;
        } else {
            $this->createdBy = $id;
            return true;
        }
    }

    public function setCreatedAt(int $timestamp): bool {
        if (!$this->createdAtIsValid($timestamp)) {
            return false;
        } else {
            $this->createdAt = $timestamp;
            return true;
        }
    }

    public function setUpdatedAt(string $timestamp): bool {
        if (!$this->updatedAtIsValid($timestamp)) {
            return false;
        } else {
            $this->updatedAt = $timestamp;
            return true;
        }
    }

    public function setIsActive(int $bool): bool {
        if (!$this->isActiveIsValid($bool)) {
            return false;
        } else {
            $this->isActive = $bool;
            return true;
        }
    }

    public function setTapwallNo(int $no): bool {
        if (!$this->tapwallNoIsValid($no)) {
            return false;
        } else {
            $this->tapwallNo = $no;
            return true;
        }
    }

    public function setPrice(string $price): bool {
        if (!$this->priceIsValid($price)) {
            return false;
        } else {
            $this->price = $price;
            return true;
        }
    }

    public function strIsValid(string $string): bool {
        return ((strlen($string) >= _STR_MIN_LEN) && (strlen($string) <= _STR_MAX_LEN));
    }

    public function ibuIsValid(int $IBU): bool {
        return (($IBU >= 0) && ($IBU <= self::MAX_IBU));
    }

    public function ebcIsValid(int $EBC): bool {
        return (($EBC >= 0) && ($EBC <= self::MAX_EBC));
    }

    public function volIsValid(string $volume): bool {
        $floatVolume = floatval($volume);
        return ((is_numeric($volume)) && ($floatVolume >= floatval(self::MIN_VOL)));
    }

    public function descriptionIsValid(string $description): bool {
        return ((strlen($description) >= 0) && (strlen($description) <= self::MAX_DESCRIPTION));
    }

    public function imageStrIsValid(string $imageStr): bool {
        return (preg_match(self::IMG_REGEX, $imageStr));
    }

    public function idIsValid(int $id): bool {
        return ((is_numeric($id)) && ($id > 0));
    }

    public function createdAtIsValid(int $timestamp): bool {
        return ((is_numeric($timestamp)) && ($timestamp > 0) && $timestamp <= time());
    }

    public function updatedAtIsValid(string $timestamp): bool {
        if ($timestamp === '') {
            return true;
        } else {
            $timestamp = intval($timestamp);
            return ((is_numeric($timestamp)) && ($timestamp > $this->createdAt) && ($timestamp <= time()));
        }
    }

    public function isActiveIsValid(int $bool): bool {
        return ((is_numeric($bool)) && (in_array($bool, self::IS_ACTIVE_OPTIONS)));
    }

    public function tapwallNoIsValid(int $no): bool {
        return ((is_numeric($no)) && ($no >= self::TAPWALL_MIN) && ($no <= self::TAPWALL_MAX));
    }

    public function priceIsValid(string $price): bool {
        return ((is_numeric($price)) && ($price > self::MIN_PRICE));
    }

    public function breweryId(): string {
        return (isset($this->breweryId) ? $this->breweryId : '');
    }

    public function style(): string {
        return (isset($this->style) ? $this->style : '');
    }

    public function name(): string {
        return (isset($this->name) ? $this->name : '');
    }

    public function IBU(): string {
        return (isset($this->IBU) ? $this->IBU : '');
    }

    public function EBC(): string {
        return (isset($this->EBC) ? $this->EBC : '');
    }

    public function volume(): string {
        return (isset($this->volume) ? $this->volume : '');
    }

    public function description(): string {
        return (isset($this->description) ? $this->description : '');
    }

    public function image(): string {
        return (isset($this->image) ? $this->image : '');
    }

    public function createdBy(): string {
        return (isset($this->createdBy) ? $this->createdBy : '');
    }

    public function createdAt(): string {
        return (isset($this->createdAt) ? $this->createdAt : '');
    }

    public function updatedAt(): string {
        return (isset($this->updatedAt) ? $this->updatedAt : '');
    }

    public function isActive(): string {
        return (isset($this->isActive) ? $this->isActive : '');
    }

    public function tapwallNo(): string {
        return (isset($this->tapwallNo) ? $this->tapwallNo : '');
    }

    public function price(): string {
        return (isset($this->price) ? $this->price : '');
    }
}