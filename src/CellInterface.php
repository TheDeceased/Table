<?php

namespace TheDeceased\Table;

interface CellInterface
{
	/**
	 * @return string
	 */
	public function value();

	/**
	 * @return int
	 */
	public function colspan();

	/**
	 * @return int
	 */
	public function rowspan();

	/**
	 * @return FontInterface
	 */
	public function getFont();

	/**
	 * @return string
	 */
	public function borders();

	/**
	 * @return bool
	 */
	public function isVisible();
}