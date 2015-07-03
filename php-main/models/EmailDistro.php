<?php
	class EmailDistro {
		private $id = "";
		private $name = "";
		private $emails = "";
		
		public function __construct($id = NULL, $name = NULL, $emails = NULL) {
			$this->id = $id;
			$this->name = $name;
			$this->emails = $emails;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getEmails() {
			return $this->emails;
		}
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function setName($name) {
			$this->name = $name;
		}
		
		public function setEmails($emails) {
			$this->emails = $emails;
		}
	}
?>