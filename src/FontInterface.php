<?php

namespace TheDeceased\Table;

interface FontInterface
{
	/**
	 * @param int $size
	 *
	 * @return $this
	 */
	public function setSize($size);

	/**
	 * @param bool $bold
	 *
	 * @return $this
	 */
	public function setBold($bold);

	/**
	 * @param bool $italic
	 *
	 * @return $this
	 */
	public function setItalic($italic);

	/**
	 * @return int
	 */
	public function getSize();

	/**
	 * @return bool
	 */
	public function isBold();

	/**
	 * @return bool
	 */
	public function isItalic();
}