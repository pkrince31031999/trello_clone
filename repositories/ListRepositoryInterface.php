<?php
  
  interface ListRepositoryInterface{
    public function getAllLists();
    public function getListById($id);
    public function createList(Lists $list);
    public function updateList(Lists $list);
    public function deleteList($id);
  }