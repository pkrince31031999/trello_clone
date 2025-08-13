<?php

interface ActivityRepositoryInterface
{
    public function createActivity($activityData);
    public function getActivityByCardId();
}