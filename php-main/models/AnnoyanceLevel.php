<?php
    class AnnoyanceLevel {
        private $id;
        private $name;
        private $level;
        private $isDefault;

        public function __construct($id = NULL, $name = NULL, $level = NULL, $isDefault = NULL) {
            $this->id = $id;
            $this->name = $name;
            $this->level = $level;
            $this->isDefault = $isDefault;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getName() {
            return $this->name;
        }


        public function setName($name) {
            $this->name = $name;
        }


        public function getLevel() {
            return $this->level;
        }


        public function setLevel($level) {
            $this->level = $level;
        }


        public function isDefault() {
            return $this->isDefault;
        }


        public function setIsDefault($isDefault) {
            $this->isDefault = $isDefault;
        }
    }