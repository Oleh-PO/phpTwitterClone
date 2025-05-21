<?php

require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";


class Feed extends Init
{
	private $many;
	private $upd;
	private $offset;
	private $order;
	private $sort;

	private $userSort 		= "";
	private $userSettings = "";

	function __construct($amount, $offset, $order) {
		parent::__construct();

		global $conn;

		$this->many 	= $amount;
		$this->offset = $offset;
		$this->order	= $order;

		$this->upd 	= $this->offset * $this->many;

		if ($this->order) {
			$this->sort = "ASC";
		} else {
			$this->sort = "DESC";
		}

		if ($this->userId) {//filters post, so user cant see his own posts
			$this->userSort = "WHERE Users.id !=".$this->userId;
		}

		if ($this->getUserId) {//-> only show post from user on users page
			$this->userSort = "WHERE Users.id =".$this->getUserId;
		}

		$sql = "
			SELECT login, content, date, Users.id as user_id, Posts.id
			FROM Posts
			INNER JOIN Users
			ON Posts.user_id = Users.id
			$this->userSort
			ORDER BY date $this->sort
			LIMIT $this->upd, $this->many;
		";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
			}
		}
	}
}
$feed = new feed(8, intval($_GET['offset']), filter_var($_GET['order'], FILTER_VALIDATE_BOOLEAN));
