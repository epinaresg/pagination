<?php

namespace Pagination;

class Pagination {

	private $totalRows;

	private $perPage;
	private $currentPage;

	private $numLinks;

	private $baseUrl;

	private $urlFriendly;

	public function __construct() {
		$this->perPage = 10;
		$this->currentPage = 1;
		$this->numLinks = 2;

		$this->urlFriendly = true;
	}

	public function setPerPage($perPage) {
		$this->perPage = $perPage;
	}

	public function setTotalRows($totalRows) {
		$this->totalRows = $totalRows;
	}

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
	}

	public function setBaseUrl($baseUrl) {
		$this->baseUrl = $baseUrl;
	}

	public function setNumberOfLinks($numLinks) {
		$this->numLinks = $numLinks;
	}

	public function setUrlFriendly($urlFriendly) {
		$this->urlFriendly = $urlFriendly;
	}

	private function setNumberOfPages() {

		$this->numPages = 0;
		if ($this->totalRows > 0) {
			$this->numPages = ceil($this->totalRows / $this->perPage);
		}
	}

	public function generatePagination() {

		$HTML = '';

		$this->setNumberOfPages();

		if ($this->numPages > 0) {

			$links = $this->generateLinks();

			$HTML .= $links['left'];
			$HTML .= '<a><strong> ' . $this->currentPage . ' </strong></a>';
			$HTML .= $links['right'];

		}

		return $HTML;
	}

	private function generateLinks() {

		$currentPage = (int) $this->currentPage;
		$numLinks = $this->numLinks;

		$htmlLeft = '';
		$htmlRight = '';

		for ($i = 1, $x = ($currentPage - $numLinks); $i <= $numLinks; $i++, $x++) {

			$page = $x;

			if ((int) $page > 0) {
				$htmlLeft .= $this->buidLink($page);
			}

			$page = $currentPage + $i;
			if ((int) $page <= $this->numPages) {
				$htmlRight .= $this->buidLink($page);
			}

		}

		if (!empty($htmlLeft)) {
			$htmlLeft = $this->buidLink(1, '<<') . $this->buidLink($currentPage - 1, '<') . $htmlLeft;
		}

		if (!empty($htmlRight)) {
			$htmlRight = $htmlRight . $this->buidLink($currentPage + 1, '>') . $this->buidLink($this->numPages, '>>');
		}

		return ['left' => $htmlLeft, 'right' => $htmlRight];
	}

	private function buidLink($page, $value = false, $identifier = false, $class = false) {

		if ($this->urlFriendly) {
			$pageUrl = $this->baseUrl . $page;
		} else {
			$pageUrl = $this->baseUrl . '?page=' . $page;
		}

		$linkValue = $page;
		if ($value) {
			$linkValue = $value;
		}

		$linkIdentifier = '';
		if ($identifier) {
			$linkIdentifier = 'id="' . $identifier . '"';
		}

		$linkClass = '';
		if ($class) {
			$linkClass = 'class="' . $class . '"';
		}
		return '<a ' . $linkIdentifier . ' ' . $linkClass . '  href="' . $pageUrl . '">' . $linkValue . '</a>';

	}

}
