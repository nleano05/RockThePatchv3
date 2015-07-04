<?php
    class ErrorReportCategory {
        private $id;
        private $name;
        private $distro;
        private $isDefault;

        public function __construct($id = NULL, $name = NULL, $distro = NULL, $isDefault = NULL) {
            $this->id = $id;
            $this->name = $name;
            $this->distro = $distro;
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


        public function getDistro() {
            return $this->distro;
        }


        public function setDistro($emailDistro) {
            $this->distro = $emailDistro;
        }


        public function isDefault() {
            return $this->isDefault;
        }


        public function setIsDefault($isDefault) {
            $this->isDefault = $isDefault;
        }
    }