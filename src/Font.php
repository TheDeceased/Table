<?php

namespace TheDeceased\Table;

class Font implements FontInterface
{
	/** @var int */
	private $size;
	/** @var bool */
	private $bold;
	/** @var bool */
	private $italic;

	/**
	 * @param array $fontData
	 *
	 * @return FontInterface
	 */
	public static function createFromArray($fontData)
	{
		$font = new self();
		if (!empty($fontData['size'])) {
			$font->setSize((int)$fontData['size']);
		}
		if (!empty($fontData['bold'])) {
			$font->setBold((bool)$fontData['bold']);
		}
		if (!empty($fontData['italic'])) {
			$font->setItalic((bool)$fontData['italic']);
		}
		return $font;
	}

	function __construct($size = 10, $bold = false, $italic = false)
	{
		$this->size = $size;
		$this->bold = $bold;
		$this->italic = $italic;
	}

	public function getSize()
	{
		return $this->size;
	}

	public function isBold()
	{
		return $this->bold;
	}

	public function isItalic()
	{
		return $this->italic;
	}

	/**
	 * @param int $size
	 *
	 * @return int
	 */
	public function setSize($size)
	{
		$this->size = $size;
		return $this;
	}

	/**
	 * @param bool $bold
	 *
	 * @return bool
	 */
	public function setBold($bold)
	{
		$this->bold = $bold;
		return $this;
	}

	/**
	 * @param bool $italic
	 *
	 * @return $this
	 */
	public function setItalic($italic)
	{
		$this->italic = $italic;
		return $this;
	}
}