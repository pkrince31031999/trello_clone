<?php
interface UserRepositoryInterface {
    public function getAll();
    public function findById($id);
    public function create(User $user);
    public function update(User $user);
    public function delete($id);
}
