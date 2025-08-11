<?php
 interface CardRepositoryInterface {
     public function getAllCards();
     public function getCardById($id);
     public function createCard($data);
     public function updateCard($id, $data);
     public function deleteCard($id);
 }