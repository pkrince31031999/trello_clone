<?php
  
  interface ListRepositoryInterface{
    public function getAllLists();
    public function getListById($id);
    public function createList($data);
    public function updateList($id, $data);
    public function deleteList($id);
  }