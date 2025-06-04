<?php


class feed extends init {
	private $many;
	private $upd;
	private $offset;
	private $order;
	private $sort;

	private $userSort 		= "";


	function __construct($amount, $offset, $order) {
		parent::__construct();

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

		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$this->pullPost($row["id"]);
			}
		}
	}
}
