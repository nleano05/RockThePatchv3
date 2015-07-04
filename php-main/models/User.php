<?php
    class User{
		private $id;
		private $firstName;
		private $lastName;
		private $userName;
		private $email;	
		private $password;
		private $securityQuestion;
		private $securityQuestionAnswer;
		private $emailBlasts;
		private $textBlasts;
		private $cell;
		private $role;
		private $lastLoginAttempt;
		private $friendStatus;	
		
		public function __construct(
			$id = NULL, 
			$firstName = NULL, 
			$lastName = NULL, 
			$userName = NULL, 
			$email = NULL,
			$password = NULL,
			$securityQuestion = NULL,
			$securityQuestionAnswer = NULL,
			$emailBlasts = NULL, 
			$textBlasts = NULL, 
			$cell = NULL,
			$role = NULL,
			$lastLoginAttempt = NULL,
			$friendStatus = NULL) {
				$this->id = $id;
				$this->firstName = $firstName;
				$this->lastName = $lastName;
				$this->userName = $userName;
				$this->email = $email;
				$this->password = $password;
				$this->securityQuestion = $securityQuestion;
				$this->securityQuestionAnswer = $securityQuestionAnswer;
				$this->emailBlasts = $emailBlasts;
				$this->textBlasts = $textBlasts;
				$this->cell = $cell;
				$this->role = $role;
				$this->lastLoginAttempt = $lastLoginAttempt;
				$this->friendStatus = $friendStatus;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getFirstName() {
			return $this->firstName;
		}
		
		public function getLastName() {
			return $this->lastName;
		}
		
		public function getUserName() {
			return $this->userName;
		}
		
		public function getEmail() {
			return $this->email;
		}
		
		public function getPassword() {
			return $this->password;
		}
		
		public function getSecurityQuestion() {
			return $this->securityQuestion;
		}
		
		public function getSecurityQuestionAnswer() {
			return $this->securityQuestionAnswer;
		}
		
		public function getEmailBlasts() {
			return $this->emailBlasts;
		}
		
		public function getTextBlasts() {
			return $this->textBlasts;
		}
		
		public function getCell() {
			return $this->cell;
		}
		
		public function getRole() {
			return $this->role;
		}
		
		public function getLastLoginAttempt() {
			return $this->lastLoginAttempt;
		}
		
		public function getFriendStatus() {
			return $this->friendStatus;
		}

        public function setId($id) {
            $this->id = $id;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
        }

        public function setUserName($userName) {
            $this->userName = $userName;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function setSecurityQuestion($securityQuestion) {
            $this->securityQuestion = $securityQuestion;
        }

        public function setSecurityQuestionAnswer($securityQuestionAnswer) {
            $this->securityQuestionAnswer = $securityQuestionAnswer;
        }

        public function setEmailBlasts($emailBlasts) {
            $this->emailBlasts = $emailBlasts;
        }

        public function setTextBlasts($textBlasts) {
            $this->textBlasts = $textBlasts;
        }

        public function setCell($cell) {
            $this->cell = $cell;
        }

        public function setRole($role) {
            $this->role = $role;
        }

        public function setLastLoginAttempt($lastLoginAttempt) {
            $this->lastLoginAttempt = $lastLoginAttempt;
        }

        public function setFriendStatus($friendStatus) {
            $this->friendStatus = $friendStatus;
        }
	}