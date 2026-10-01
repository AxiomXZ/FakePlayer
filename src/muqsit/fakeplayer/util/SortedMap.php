<?php

declare(strict_types=1);

namespace muqsit\fakeplayer\util;

/**
 * @template TKey of string|int
 * @template TVal of mixed
 */
final class SortedMap{

	/** @var array<TKey, TVal> */
	private array $entries = [];

	/** @var array<TKey, int> */
	private array $key_scores = [];

	public function __construct(){
	}

	/**
	 * @param TKey $key
	 * @return bool
	 */
	public function contains(string|int $key) : bool{
		return isset($this->entries[$key]);
	}

	/**
	 * @param TKey $key
	 * @param TVal $value
	 * @param int $score
	 */
	public function set(string|int $key, mixed $value, int $score) : void{
		$this->entries[$key] = $value;
		$this->key_scores[$key] = $score;
		asort($this->key_scores);
	}

	/**
	 * @param TKey $key
	 */
	public function remove(string|int $key) : void{
		unset($this->entries[$key], $this->key_scores[$key]);
	}

	/**
	 * @return array<TKey, TVal>
	 */
	public function getAll() : array{
		$result = [];
		foreach($this->key_scores as $key => $_){
			$result[$key] = $this->entries[$key];
		}
		return $result;
	}
}
